<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Validation\Rule;
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

use Redirect;
use View;
use Mail;
use Reminder;
use Sentinel;
use URL;

use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Activation;
use Intervention\Image\Facades\Image;



use\App\Http\Controllers\JoshController;
use App\Http\Requests\ConfirmPasswordRequest;
use Illuminate\Support\Facades\Log;
use App\Http\Requests\UserRequest;
use App\Http\Requests\ForgotRequest;
use stdClass;
use App\Mail\ForgotPassword;
use App\Mail\Register;
use App\Mail\ActivationCode;

use App\Profile;


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
    public function signup(Request $request){
        //  $this->Validate($request,[
        // 'firstName' => 'required',
        // 'lastName' => 'required',
        // 'email' => 'required|email|exists:users',
        // 'password' => 'required',
        // ]);
          $validator = Validator::make($request->all(), [
            'email' => 'required|unique:users|email',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            // dd('asdasd');
             return response()->json([
            'success'      => true,
            'vods' => $vods,
            'message' => 'The Api is working',
            'code'       => 200,
        ],200);
            
            return redirect('post/create')
                        ->withErrors($validator)
                        ->withInput();
        }
    }
    // 
    public function login(Request $request) { 
         $validator = Validator::make($request->all(), [ 
            'email' => 'required|email', 
            'password' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json([
            'success' => false,
            'message' => 'not validated',
            'error'=>$validator->errors()
            ], 401);            
        }
        try {
            if($user = Sentinel::authenticate($request->only(['email', 'password']), $request->get('remember-me', false))) { 
                $accessToken = $user->createToken('parentalControl')->accessToken; 
                return response()->json([
                    'success' => true,
                    'access_token' => $accessToken,
                    'user' => $user,
                    'message' => 'authenticated'
                ], 200); 
            } else {
                return response()->json(
                [
                'success' => false,
                'message' => 'unauthenticated',
                'error'=>'Unauthorised'
                ], 401); 
            }
        }
        catch (NotActivatedException $e) {
            return response()->json(
                [
                'success' => false,
                'message' => trans('auth/message.account_not_activated'),
                'error'=>'Unauthorised'
                ], 401); 
        } 
    }
    /****************************************** */
    public function register(Request $request) { 
        $validator = Validator::make($request->all(), [ 
            'first_name' => 'required', 
            'last_name' => 'required', 
            'email' => 'required|email|unique:users', 
            'password' => 'required', 
            'confirm_password' => 'required|same:password', 
        ]);
        if ($validator->fails()) { 
            return response()->json([
            'success' => false,
            'message' => 'not validated',
            'error'=>$validator->errors()
            ], 401);            
        }
        $input = $request->all(); 
        $input['password'] = Hash::make($request->password); 
        unset( $input['confirm_password']);
        $user = User::create($input);
        if($user) {
            Activation::create($user);
            $key = $this->random_key(6);
            DB::table('activations')
                ->where('user_id', $user->id)
                ->update(['code' => $key]);
             $data=[
                    'user_name' => $user->first_name .' '. $user->last_name,
                    // 'activationUrl' => URL::route('activate', [$user->id, Activation::create($user)->code]),
                    'activationCode' => $key,
                    ];
                    // Send the activation code through email
                    Mail::to($user->email)
                        ->send(new ActivationCode($data));
            $accessToken=  $user->createToken('parentalControl')->accessToken; 
            return response()->json([
                'success' => true,
                'access_token' => $accessToken,
                // 'user' => $user,
                'message' => 'activation email sent'
            ], 200); 
        } else {
             return response()->json([
            'success' => false,
            'message' => 'unable to Create User',
            'error'=> "user not Created",
            ], 401);            
        }
    }
    /***************************************/
    public function userActivation (Request $request) {
        $validator = Validator::make($request->all(), [ 
            'activation_code' => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'success' => false,
                'message' => 'not validated',
                'error'=>$validator->errors()
            ], 401);            
        }
        $user = Auth::user();
        // dd($user);
        if (Activation::complete($user, $request->activation_code)) {
              return response()->json([
                'success' => true,
                'user' => $user,
                'message' => 'user activated'
            ], 200); 
        } else {
             return response()->json([
                'success' => false,
                'message' => 'unable to activated users',
                'error'=> 'activation code not valid or expired'
            ], 401);          
        }
    } 
    /**************************************** */
    public function addChildProfile(Request $request) 
    { 
        $user = Auth::user();
        $validator = Validator::make($request->all(), [ 
            'name' => 'required|unique:profiles', 
            'age_group' => 'required', 
            'image' => 'required|image', 
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'success' => false,
                'message' => 'not validated',
                'error'=>$validator->errors()
            ], 401);            
        }
        $profile = new Profile($request->except('image'));
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $extension = $file->extension()?: 'png';
            $picture = str_random(10) . '.' . $extension;
            $destinationPath = public_path() . '/uploads/profiles/';
            $file->move($destinationPath, $picture);
            $profile->image = url('uploads/profiles/').'/'.$picture;
        }
        $profile->parent_id = $user->id;
        if($profile->save()) {
            return response()->json([
                'success' => true,
                'user' => $user,
                'profile' => $profile,
                'message' => 'new profile is created'
            ], 200); 
        } else {
            $this->requestNotCompleted();
        }
    } 
    public function getProfiles(Request $request) 
    { 
        $user = Auth::user();
        return response()->json([
            'success' => true,
            'user' => $user,
            'profiless' => $user->profiles,
            'message' => 'all profiles'
        ], 200); 
    } 
    
    //*************************///// 
    public function random_key($size) {
	$alpha_key = '';
	$keys = range('A', 'Z');
	for ($i = 0; $i < 2; $i++) {
		$alpha_key .= $keys[array_rand($keys)];
	}
	$length = $size - 2;
	$key = '';
	$keys = range(0, 9);
	for ($i = 0; $i < $length; $i++) {
		$key .= $keys[array_rand($keys)];
	}
	return $alpha_key . $key;
    }
    public function requestNotCompleted() {
        return response()->json([
            'success' => false,
            'message' => 'unable to complete request',
            'error'=> 'request not completed'
        ], 401);   
    }

}