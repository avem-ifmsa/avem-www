<?php

namespace App\Http\Controllers\Admin;

use App\Activity;
use App\MbMember;
use App\ActivityTag;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ActivityRequest;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $activities = Activity::all();
        return view('admin.manage.activities.index', compact('activities'));
    }

    private function organizerList()
    {
        return MbMember::active()->get()->reduce(function($list, $mbMember) {
            if ($member = $mbMember->member)
                $list[$member->id] = $member->full_name.' ('.$member->id.')';
            return $list;
        }, []);
    }

    private function tagList()
    {
        return ActivityTag::all()->pluck('name', 'id')->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = $this->tagList();
        $organizers = $this->organizerList();
        return view('admin.manage.activities.create',
                    compact('organizers', 'tags'));
    }

    private function createActivity(ActivityRequest $request)
    {
        $activity = Activity::create($request->all());
        $this->syncTags($activity, $request->input('tag_list', []));
        $this->syncOrganizers($activity, $request->input('organizer_list', []));
        return $activity;
    }

    private function syncTags(Activity $activity, array $tagList)
    {
        $activity->tags()->sync($tagList);
    }

    private function syncOrganizers(Activity $activity, array $organizerList)
    {
        $activity->organizers()->sync($organizerList);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ActivityRequest $request)
    {
        $activity = $this->createActivity($request);
        flash()->success(trans('admin.manage.activities.create.successMessage'));
        return redirect()->route('admin.manage.activities.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Activity $activity)
    {
        $tags = $this->tagList();
        $organizers = $this->organizerList();
        return view('admin.manage.activities.edit',
                    compact('activity', 'organizers', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Activity $activity, ActivityRequest $request)
    {
        $activity->update($request->all());
        $this->syncTags($activity, $request->input('tag_list', []));
        $this->syncOrganizers($activity, $request->input('organizer_list', []));

        flash()->success(trans('admin.manage.activities.edit.successMessage'));
        return redirect()->route('admin.manage.activities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Activity $activity)
    {
        $activity->delete();
        flash()->success(trans('admin.manage.activities.delete.successMessage'));
        return redirect()->route('admin.manage.activities.index');
    }
}
