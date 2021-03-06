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

use App\Appointment;
use App\Inspection;
use App\Car;
use App\Registration;
use App\Contravention;

use Redirect;
use View;
use Mail;
use Reminder;
use Sentinel;
use URL;
use File;

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
use App\Gallery;


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
                $user->role = $user->getRoles()->pluck('name', 'id')->first();
                return response()->json([
                    'success' => true,
                    'access_token' => $accessToken,
                    'user' => $user,
                    'user_role' => $user->role ,
                    'user_car' => $user->car,
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
            'email' => 'required|email', 
            'password' => 'required', 
            'confirm_password' => 'required|same:password', 
        ]);
        $validator->after(function($validator) use ($request){
            if ($this->validateUserEmail($request->email)) {
                $validator->errors()->add('email', 'The email is already taken');
            }
        });
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
    /*******************s */
    public function validateEmail(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'email' => 'required|email|exists:users', 
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'success' => false,
                'message' => 'email not found',
                'error'=>$validator->errors()
            ], 401);            
        }
        $user = Sentinel::findByCredentials(['email' => $request->get('email')]);
        $accessToken=  $user->createToken('parentalControl')->accessToken; 
        return response()->json([
          'success' => true,
          'user' => $user,
          'access_token' => $accessToken,
          'message' => 'email exists'
      ], 200); 
    } 
    // *************inspector********************//
    public function getAllAppointments(Request $request) {
        $user = Auth::user();
        $appointments =  Appointment::with('car')->orderBy('booking_date', 'asc')->where('checked_by', null)->get();
        return response()->json([
                'success' => true,
                'user' => $user,
                'appointments' => $appointments,
                'message' => 'new profile is created'
            ], 200); 
    }

     public function getAppointmentDetails(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'appointment_id' => 'required|exists:appointments,id', 
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'success' => false,
                'message' => 'not validated',
                'error'=>$validator->errors()
            ], 401);            
        }
        $appointment =  Appointment::find($request->appointment_id)->with('car')->first();
        return response()->json([
                'success' => true,
                'appointment' => $appointment,
                'message' => 'new profile is created'
            ], 200); 
    }


    public function postAppointment(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'car_id'    => 'required', 
            'submitted_by'  => 'required|unique:appointments,submitted_by', 
            'submitted_date'    => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'success' => false,
                'message' => 'not validated',
                'error'=>$validator->errors()
            ], 401);            
        }
        $data = [];
        $data = $request->all();
        $data['submitted_date'] = (new Carbon($request->submitted_date))->toDateTimeString();
        $data['booking_date'] = $this->getBookingTime($request->submitted_date);
        $appointment = Appointment::create($data);
        if($appointment) {
            return response()->json([
                    'success' => true,
                    'Appointment' => $appointment,
                    'message' => 'new profile is created'
                ], 200); 
        } else {
            $this->requestNotCompleted();
        }
    }
    
    public function viewAppointment(Request $request) {
        $user_id = Auth::user()->id;
        $appointment =  Appointment::where('submitted_by', $user_id)->with('car')->first();
        if($appointment) {
            return response()->json([
                    'success' => true,
                    'appointment' => $appointment,
                    'message' => 'new profile is created'
                ], 200); 
        } else {
            $this->requestNotCompleted();
        }
    }
     // 
    public function cancelAppointment(Request $request) {
        $user_id = Auth::user()->id;
        $appointment =  Appointment::where('submitted_by', $user_id)->where('checked_by', null)->with('car')->first();
        if($appointment && $appointment->delete()) {
            return response()->json([
                    'success' => true,
                    'message' => 'new profile is created'
                ], 200); 
        } else {
            return $this->requestNotCompleted();
        }
    }

    public function postInspection(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'appointment_id' => 'required|exists:appointments,id|unique:inspections,appointment_id', 
            'result'    => 'required', 
            'car_id'    => 'required', 
            'inspected_by' => 'required', 
            'inspection_date' => 'required|date', 
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'success' => false,
                'message' => 'not validated',
                'error'=>$validator->errors()
            ], 401);            
        }
        $inspection = Inspection::create($request->all());
        $appointment = Appointment::find($request->appointment_id);
        $appointment->checked_by = $request->inspected_by;
        if($inspection) {
            $appointment->save();
            return response()->json([
                    'success' => true,
                    'inspection' => $inspection,
                    'message' => 'new profile is created'
                ], 200); 
        } else {
            $this->requestNotCompleted();
        }
    }
    // 
     public function viewInspection(Request $request) {
        $user = Auth::user();
        $car_id = $user->car ? $user->car->id : null;
        if($car_id == null) {
            return $this->requestNotCompleted();
        }
        $inspection =  Inspection::where('car_id', $car_id)->with('car')->first();
        if($inspection) {
            return response()->json([
                    'success' => true,
                    'inspection' => $inspection,
                    'message' => 'new profile is created'
                ], 200); 
        } else {
            return $this->requestNotCompleted();
        }
    }

    public function registration(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'car_id'    => 'required|unique:registrations,car_id', 
            'registration_date'   => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'success' => false,
                'message' => 'not validated',
                'error'=>$validator->errors()
            ], 401);            
        }
        $registration = registration::create($request->all());
        if($registration) {
            return response()->json([
                    'success' => true,
                    'message' => 'new profile is created'
                ], 200); 
        } else {
            $this->requestNotCompleted();
        }
    }

     public function getAllContraventions(Request $request) {
        $user = Auth::user();
        $contraventions = Contravention::with('type')->where('car_owner_id', $user->id)->where('status', 0)->get();
        return response()->json([
                'success' => true,
                'contraventions' => $contraventions,
                'message' => 'new profile is created'
            ], 200); 
    }

    public function addContravention(Request $request) {
        $validator = Validator::make($request->all(), [ 
            'contravention_id'    => 'required', 
            'submitted_date'  => 'required', 
        ]);
        if ($validator->fails()) { 
            return response()->json([
                'success' => false,
                'message' => 'not validated',
                'error'=>$validator->errors()
            ], 401);            
        }
        $contravention = contravention::find($request->contravention_id);
        $contravention->submitted_date = $request->submitted_date;
        $contravention->description = $request->description;
        $contravention->status = true;
        if($contravention->save()) {
            return response()->json([
                    'success' => true,
                    'message' => 'new profile is created'
                ], 200); 
        } else {
            $this->requestNotCompleted();
        }
    }
    
    /**************************************** */
   
    /************ *************/
    public function forgotPassword(Request $request)
    {   
        $user = Auth::user();
        $data = new stdClass();
        $activation = Activation::completed($user);
        if(!$user || !$activation) {
            return response()->json([
                'success' => false,
                'message' => 'user Not Found or not activated'
            ], 401); 
        }
        try {
            $reminder = Reminder::exists($user) ?: Reminder::create($user);
            $data->user_name = $user->first_name .' ' .$user->last_name;
            $data->forgotPasswordUrl = URL::route('forgot-password-confirm', [$user->id, $reminder->code, 'api']);
            Mail::to($user->email)
                ->send(new ForgotPassword($data));
                return response()->json([
                    'success' => true,
                    'user' => $user,
                    'message' => 'password rest email is sent'
                ], 200); 
        } catch (UserNotFoundException $e) {
            return response()->json([
                'success' => false,
                'user' => $user,
                'message' => 'password rest email is not sent'
            ], 401); 
        }
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

    public function getBookingTime($current_sub_date) {
        $count = Appointment::count();
        if($count == 0) {
            $d = new Carbon($current_sub_date);
            $d->hour = 6;
            $d->minute = 0;
            $d->second = 0;
            return $d->addDay()->toDateTimeString();
        } else {
            $d = (new Carbon($current_sub_date))->addDay();
            $date = $d->toDateString();
            $lastAppointment =  Appointment::OrderBy('booking_date', 'desc')->first();
            $dd = new Carbon($lastAppointment->booking_date);
            if($dd->hour >= 16 || ($dd->hour == 15 && $dd->minute + 10 >= 59) || !$lastAppointment) {
                dd($lastAppointment);
                $dd->hour = 6;
                $dd->minute = 0;
                $dd->second = 0;
                return $dd->addDay()->toDateTimeString();
            } else{
                return $dd->addMinutes(10)->toDateTimeString();
            }
        }
    }

}