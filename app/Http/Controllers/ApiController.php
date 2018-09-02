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

use App\Categories;

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
    public function getCategories() {
        $categories = Category::all();
          return response()->json([
            'success'      => true,
            'categories' => $categories,
            'message' => 'The Api is working',
            'code'       => 200,
        ],200);
    }
}
