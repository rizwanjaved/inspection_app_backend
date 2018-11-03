<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Appointment;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appointments = Appointment::all();
        // Show the page
        return view('admin.appointments.index', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $carTypes = DB::table('car_types')->pluck('type', 'id');
        $groups = Sentinel::getRoleRepository()->where('slug','=','user')->get();
        // $users = User::all();
        // foreach($users as $user) {

        // }
        $role = Sentinel::findRoleById(2);
        $users = $role->users->pluck('first_name' , 'id');
        return view('admin.cars.create', compact('carTypes', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->Validate($request,[
        'car_no' => 'required|min:3|unique:cars',
        'model' => 'required',
        'car_type_id' => 'required',
        'owner_id' => 'required',
        ]);
        $car = new Car($request->all());//->except('image','links'));
        // foreach <img> in the submited message
        if ($car->save()) {
            return redirect('admin/cars')->with('success', trans('car Successfully created'));
        } else {
            return Redirect::route('admin/cars')->withInput()->with('error', trans('general.error.wrong'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Channel $channel)
    {
        return view('admin.channels.show', compact('channel'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Channel $channel)
    {
        $links ="";
        foreach($channel->links as $key => $value){
           $links= $links.','.$value->url;
        }
        $categories = Category::pluck('name', 'id');
        $regions = Region::pluck('name', 'id');
        return view('admin.channels.edit', compact('channel', 'categories', 'regions', 'links'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Channel $channel)
    {
          $this->Validate($request,[
        'title' => 'required|min:3',
        'links' => 'required',
        'category_id' => 'required',
        'region_id' => 'required',
        ]);
        $message=$request->get('content');
        libxml_use_internal_errors(true);
        $dom = new DomDocument();
        $dom->loadHtml($message, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $channel->content = $dom->saveHTML();
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->extension()?: 'png';
            $picture = str_random(10) . '.' . $extension;
            $destinationPath = public_path() . '/uploads/channels/';
            $file->move($destinationPath, $picture);
            if(file_exists(public_path() . '/uploads/channels/'.$channel->image)) {
                unlink(public_path('/uploads/channels/'.$channel->image));
            }
            $channel->image = $picture;
        }

        if ($channel->update($request->except('content','image','_method', 'links'))) {
            $channel->updatelinks(explode(',',$request->links), $channel);
            return redirect('admin/channel')->with('success', trans('Channel Successfully Updated'));
        } else {
            return Redirect::route('admin/channel')->withInput()->with('error', trans('general.error.wrong'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Channel $channel)
    {
        if(file_exists(public_path() . '/uploads/channels/'.$channel->image)) {
                unlink(public_path('/uploads/channels/'.$channel->image));
        }
        try {
            $channel->delete();
            return Redirect::route('admin.channel.index')->with('success', trans('Channel was successfully deleted.'));
        } catch (GroupNotFoundException $e) {
            // Redirect to the group management page
            return Redirect::route('admin.channel.index')->with('error',trans('general.error.wrong'));
        }
    }
}
