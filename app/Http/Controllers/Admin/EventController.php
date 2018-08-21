<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Channel;
use App\Category;
use App\Region;
use App\Event;
use App\Vod;
use App\Link;
use App\Http\Requests;
use Response;
use Sentinel;
use Intervention\Image\Facades\Image;
use DOMDocument;
use Carbon\Carbon;


class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $vods = Vod::all();
        // Show the page
        return view('admin.vod.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $eventTypes = [
            'footbat' =>'Footbal', 
            'cricket' =>'Cricket'
        ];
        $eventStatus = [
            'live' => 'Live',
            'upcoming' => 'Upcoming',
            'postponed' => "Postponed"
        ];
        $channels = Channel::all();
        return view('admin.events.create', compact('eventTypes', 'eventStatus','channels'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $dates = explode('-', $request->dates);
        $event = new Event($request->except('channels', 'dates'));
        $event->time_from = Carbon::parse(trim($dates[0]))->toDateTimeString();
        $event->time_to = Carbon::parse(trim($dates[1]))->toDateTimeString();
        $event->save();
        $event->attachChannels($request->channels);
        if($event->id) {
            return redirect('admin/channel')->with('success', trans('blog/message.success.create'));
        } else {
            return Redirect::route('admin/channel')->withInput()->with('error', trans('blog/message.error.create'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
