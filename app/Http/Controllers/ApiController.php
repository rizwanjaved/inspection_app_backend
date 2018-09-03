<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use App\User;
use App\Route;
use App\Stop;
use App\Roles;
use App\PreAbsent;
use App\Attendence;
use App\StudentAttendence;
use App\AttendenceStatus;
use Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

use App\Category;
use App\Channel;
use App\Region;
use App\Event;
use App\Link;
use App\Vod;
use App\VodCategory;

class ApiController extends Controller
{
    //
    public function index(){
        return response()->json([
            'success'      => true,
            'message' => 'The Api is working',
            'code'       => 200,
        ],200);
    }
    public function getAllCategories() {
        $categories = Category::all();
          return response()->json([
            'success'      => true,
            'categories' => $categories,
            'message' => 'The Api is working',
            'code'       => 200,
        ],200);
    }
    public function getAllRegions() {
        $categories = Region::all();
          return response()->json([
            'success'      => true,
            'categories' => $categories,
            'message' => 'The Api is working',
            'code'       => 200,
        ],200);
    }
    public function getAllChannels() {
        $categories = Channel::all();
          return response()->json([
            'success'      => true,
            'categories' => $categories,
            'message' => 'The Api is working',
            'code'       => 200,
        ],200);
    }
    public function getAllEvents(){
      $events = Event::all();
          return response()->json([
            'success'      => true,
            'events' => $events,
            'message' => 'The Api is working',
            'code'       => 200,
        ],200);
    }      
    public function getAllVodCategories(){
       $vodCategories = VodCategory::all();
          return response()->json([
            'success'      => true,
            'vodCategories' => $vodCategories,
            'message' => 'The Api is working',
            'code'       => 200,
        ],200);
    }  
    public function getAllVods(){
        $vods = Vod::all();
          return response()->json([
            'success'      => true,
            'vods' => $vods,
            'message' => 'The Api is working',
            'code'       => 200,
        ],200);
    }
}
