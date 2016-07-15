<?php

namespace App\Providers;

use App\User;
use App\Member;
use Mailchimp\Mailchimp;
use Illuminate\Support\ServiceProvider;

class MailchimpServiceProvider extends ServiceProvider
{
    public function __construct()
    {
        $this->listId = config('avem.mailchimp.member_list_id');
    }

    private function getMemberIdFromEmail($email)
    {
        return md5($email);
    }

    private function addMemberToList(Mailchimp $mc, Member $member)
    {
        return $mc->post('lists/'.$this->listId.'/members', [
            'email_address' => $member->email,
            'status' => 'subscribed',
            'merge_fields' => [
                'FNAME' => $member->first_name,
                'LNAME' => $member->last_name,
                'NSOCIO' => $member->id,
            ],
        ]);
    }

    private function updateMemberInfo(Mailchimp $mc, $email, Member $member)
    {
        $memberId = $this->getMemberIdFromEmail($email);
        return $mc->put('lists/'.$this->listId.'/members/'.$memberId, [
            'status' => 'subscribed',
            'merge_fields' => [
                'FNAME' => $member->first_name,
                'LNAME' => $member->last_name,
                'NSOCIO' => $member->id,
            ],
        ]);
    }

    private function removeMemberFromList(Mailchimp $mc, $email)
    {
        $memberId = $this->getMemberIdFromEmail($email);
        $mc->delete('lists/'.$this->listId.'/members/'.$memberId);
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot(Mailchimp $mc)
    {
        Member::created(function($member) use ($mc) {
            if (!$member->email) return;
            $this->addMemberToList($mc, $member);
        });

        Member::updated(function($member) use ($mc){
            if ($email = $member->email)
                $this->updateMemberInfo($mc, $email, $member);
        });

        User::updated(function($user) use ($mc) {
            if (!$user->member) return;
            if (!$user->isDirty('email')) return;
            $email = $user->getOriginal('email');
            $this->removeMemberFromList($mc, $email);
            $this->addMemberToList($mc, $user->member);
        });

        Member::deleted(function($member) use ($mc) {
            if (!$member->email) return;
            $this->removeMemberFromList($mc, $member->email);
        });

        User::deleted(function($user) use ($mc) {
            if (!$user->member) return;
            $this->removeMemberFromList($mc, $user->email);
        });
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
