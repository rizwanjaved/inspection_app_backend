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
use Validator;
use Redirect;



class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $events = Event::all();
        // Show the page
        return view('admin.events.index', compact('events'));
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
        $this->Validate($request,[
            'title' => 'required|min:3',
            'dates' => 'required',
            'channels' => 'required',
            'event_type' => 'required',
            'event_status' => 'required',
        ]);
        $dates = explode('-', $request->dates);
        $event = new Event($request->except('channels', 'dates'));
        $event->time_from = Carbon::parse(trim($dates[0]))->toDateTimeString();
        $event->time_to = Carbon::parse(trim($dates[1]))->toDateTimeString();
        if($event->save()) {
            $event->attachChannels($request->channels);
            return redirect('admin/event')->with('success', trans('Event Successfully Added'));
        } else {
            return Redirect::route('admin/event')->withInput()->with('error', trans('blog/message.error.create'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
         return view('admin.events.show', compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
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
        $selectedChannels = [];
        foreach($event->channels as $ch){
            $selectedChannels[] = $ch->id; 
        }
        return view('admin.events.edit', compact('channels', 'eventTypes', 'eventStatus', 'event','selectedChannels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
         $this->Validate($request,[
            'title' => 'required|min:5',
            'dates' => 'required',
            'channels' => 'required',
            'event_type' => 'required',
            'event_status' => 'required',
        ]);
        $dates = explode('-', $request->dates);
        $event->title = $request->title;
        $event->event_type= $request->event_type;
        $event->event_status= $request->event_status;
        $event->time_from = Carbon::parse(trim($dates[0]))->toDateTimeString();
        $event->time_to = Carbon::parse(trim($dates[1]))->toDateTimeString();
        if($event->save()) {
            $event->updateChannels($request->channels, $event);
            return redirect('admin/event')->with('success', trans('Event Successfully Updated'));
        } else {
            return Redirect::route('admin/event')->withInput()->with('error', trans('general.error.wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy( Event $event)
    {
        //
         try {
            $event->detachAllChannels();
            $event->delete();
            return Redirect::route('admin.event.index')->with('success', trans('Event was successfully deleted.'));
        } catch (GroupNotFoundException $e) {
            // Redirect to the group management page
            return Redirect::route('admin.event.index')->with('error', trans('general.error.wrong'));
        }
    }
}
