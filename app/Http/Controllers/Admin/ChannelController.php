<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Channel;
use App\Category;
use App\Region;
use App\Link;
use App\Http\Requests;
use Response;
use Sentinel;
use Intervention\Image\Facades\Image;
use DOMDocument;
use Validator;
use Redirect;


class ChannelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $channels = Channel::all();
        // Show the page
        return view('admin.channels.index', compact('channels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::pluck('name', 'id');
        $regions = Region::pluck('name', 'id');
        return view('admin.channels.create', compact('categories', 'regions'));
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
        'title' => 'required|min:3',
        'links' => 'required',
        'category_id' => 'required',
        'region_id' => 'required',
        'image' => 'required',
        ]);
        $channel = new Channel($request->except('image','links'));
        $message=$request->get('content');
        $dom = new DomDocument();
        $dom->loadHtml($message, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        // foreach <img> in the submited message
        foreach($images as $img){

            $src = $img->getAttribute('src');
            // if the img source is 'data-url'
            if(preg_match('/data:image/', $src)){
                // get the mimetype
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimetype = $groups['mime'];
                // Generating a random filename
                $filename = uniqid();
                $filepath = "uploads/channel/$filename.$mimetype";
                // @see http://image.intervention.io/api/
                $image = Image::make($src)
                    // resize if required
                    /* ->resize(300, 200) */
                    ->encode($mimetype, 100)  // encode file to the specified mimetype
                    ->save(public_path($filepath));
                $new_src = asset($filepath);
                $img->removeAttribute('src');
                $img->setAttribute('src', $new_src);
            } // <!--endif
        } // <!-
        $channel->content = $dom->saveHTML();

        $picture = "";

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->extension()?: 'png';
            $picture = str_random(10) . '.' . $extension;
            $destinationPath = public_path() . '/uploads/channels/';
            $file->move($destinationPath, $picture);
            $channel->image = $picture;

        }
        // $channel->user_id = Sentinel::getUser()->id;
        $channel->save();

        
        if ($channel->id) {
            $channel->addlinksToChannel(explode(',',$request->links), $channel->id);
            return redirect('admin/channel')->with('success', trans('Channel Successfully created'));
        } else {
            return Redirect::route('admin/channel')->withInput()->with('error', trans('general.error.wrong'));
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
