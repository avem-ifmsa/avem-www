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
            $user = $member->user;
            if ($user && $user->verified)
                $this->addMemberToList($mc, $member);
        });

        Member::updated(function($member) use ($mc) {
            $user = $member->user;
            if ($user && $user->verified)
                $this->updateMemberInfo($mc, $user->email, $member);
        });

        Member::deleted(function($member) use ($mc) {
            $user = $member->user;
            if ($user && $user->verified)
                $this->removeMemberFromList($mc, $user->email);
        });

        User::created(function($user) use ($mc) {
            $member = $user->member;
            if ($member && $user->verified)
                $this->addMemberToList($mc, $member);
        });

        User::updated(function($user) use ($mc) {
            $wasVerified = $user->getOriginal('verified');
            if ($user->isDirty('verified')) {
                if ($wasVerified && !$user->verified) {
                    $oldEmail = $user->getOriginal('email');
                    $this->removeMemberFromList($mc, $oldEmail);
                } else if (!$wasVerified && $user->verified) {
                    if ($member = $user->member)
                        $this->addMemberToList($mc, $member);
                }
            } else if ($user->isDirty('email')) {
                $oldEmail = $user->getOriginal('email');
                if ($member = $user->member) {
                    if ($wasVerified)
                        $this->removeMemberFromList($mc, $oldEmail);
                    if ($user->verified)
                        $this->addMemberToList($mc, $member);
                }
            }
        });

        User::deleted(function($user) use ($mc) {
            $member = $user->member;
            if ($member && $user->verified)
                $this->removeMemberFromList($mc, $member);
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
