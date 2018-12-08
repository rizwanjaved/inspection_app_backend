<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Car;
use App\Contravention;
use App\User;
use App\Http\Requests;
use Response;
use Sentinel;
use Intervention\Image\Facades\Image;
use DOMDocument;
use Validator;
use Redirect;
use Illuminate\Support\Facades\DB;

class ContraventionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contraventions = Contravention::with('type', 'car')->get();
        // dd(empty($cars));
        return view('admin.contraventions.index', compact('contraventions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {  
        $contravention_types = DB::table('contravention_types')->pluck('text', 'id');
        $types = DB::table('contravention_types')->get();
        $cars = Car::all()->pluck('car_no', 'id');
        return view('admin.contraventions.create', compact('contravention_types', 'cars', 'types'));
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
        'car_id' => 'required|',
        'due_date' => 'required',
        'contravention_type' => 'required'
        ]);
        $details = DB::table('contravention_types')->find($request->contravention_type);
        $car = Car::find($request->car_id);
        $data = [];
        $data = $request->all();
        $data['status'] = false;
        $data['fee'] = $details->amount;
        $data['car_owner_id'] = $car->owner->id;
        $contravention = new Contravention($data);//->except('image','links'));
        // foreach <img> in the submited message
        if ($contravention->save()) {
            return redirect('admin/contraventions')->with('success', trans('contravention Successfully created'));
        } else {
            return Redirect::route('admin/contraventions')->withInput()->with('error', trans('general.error.wrong'));
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
