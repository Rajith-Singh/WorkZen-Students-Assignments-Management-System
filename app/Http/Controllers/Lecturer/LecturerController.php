<?php

namespace App\Http\Controllers\Lecturer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Lecturer;
use App\Models\VerifyLecturer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class LecturerController extends Controller
{
    function check(Request $request){
        //Validate Inputs
        $request->validate([
           'email'=>'required|email|exists:lecturers,email',
           'password'=>'required|min:5|max:30'
        ],[
            'email.exists'=>'This email is not exists in lecturers table'
        ]);

        $creds = $request->only('email','password');

        if( Auth::guard('lecturer')->attempt($creds) ){
            return redirect()->route('lecturer.home');
        }else{
            return redirect()->route('lecturer.login')->with('fail','Incorrect credentials');
        }
   }

    function logout(){
        Auth::guard('lecturer')->logout();
        return redirect('/');
    }

    function create(Request $request){
        //Validate Input
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:lecturers,email',
            'password'=>'required|min:5|max:30',
            'cpassword'=>'required|min:5|max:30|same:password'
        ]);

        $user = new Lecturer();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = \Hash::make($request->password);
        $save = $user->save();
        $last_id = $user->id;

        $token = $last_id.hash('sha256', \Str::random(120));
        $verifyURL = route('lecturer.verify',['token'=>$token,'service'=>'Email_verification']);

        VerifyLecturer::create([
            'lecturer_id'=>$last_id,
            'token'=>$token,
        ]);

        $message = 'Dear <b>'.$request->name.'</b>';
        $message.= 'Thanks for signing up, we just need you to verify your email address to complete setting up your account.';

        $mail_data = [
            'recipient'=>$request->email,
            'fromEmail'=>$request->email,
            'fromName'=>$request->name,
            'subject'=>'Email Verification',
            'body'=>$message,
            'actionLink'=>$verifyURL,
        ];

        \Mail::send('email-template', $mail_data, function($message) use ($mail_data){
                   $message->to($mail_data['recipient'])
                           ->from($mail_data['fromEmail'], $mail_data['fromName'])
                           ->subject($mail_data['subject']);
        });

        if( $save ){
            return redirect()->back()->with('success','Registered successfully');
        }else{
            return redirect()->back()->with('fail','Something went wrong, failed to register');
        }
    }

    public function verify(Request $request){
        $token = $request->token;
        $verifyLecturer = VerifyLecturer::where('token', $token)->first();
        if(!is_null($verifyLecturer)){
            $lecturer = $verifyLecturer->lecturer;

            if(!$lecturer->email_verified){
                $verifyLecturer->lecturer->email_verified = 1;
                $verifyLecturer->lecturer->save();

                return redirect()->route('lecturer.login')->with('info','Your email is verified successfully. You can now login')->with('verifiedEmail', $lecturer->email);
            }else{
                 return redirect()->route('lecturer.login')->with('info','Your email is already verified. You can now login')->with('verifiedEmail', $lecturer->email);
            }
        }
    }

    public function showForgotForm(){
        return view('dashboard.lecturer.forgot');
    }

    public function sendResetLink(Request $request){
        $request->validate([
            'email'=>'required|email|exists:lecturers,email'
        ]);

        $token = \Str::random(64);
         \DB::table('password_resets')->insert([
               'email'=>$request->email,
               'token'=>$token,
               'created_at'=>Carbon::now(),
         ]);

         $action_link = route('lecturer.reset.password.form',['token'=>$token,'email'=>$request->email]);
         $body = "We are received a request to reset the password for <b>Your app Name </b> account associated with ".$request->email.". You can reset your password by clicking the link below";

        \Mail::send('email-forgot',['action_link'=>$action_link,'body'=>$body], function($message) use ($request){
              $message->from('noreply@example.com','Your App Name');
              $message->to($request->email,'Your name')
                      ->subject('Reset Password');
        });

        return back()->with('success', 'We have e-mailed your password reset link!');
        }

    public function showResetForm(Request $request, $token = null){
        return view('dashboard.lecturer.reset')->with(['token'=>$token,'email'=>$request->email]);
    }

    public function resetPassword(Request $request){
        $request->validate([
            'email'=>'required|email|exists:lecturers,email',
            'password'=>'required|min:5|confirmed',
            'password_confirmation'=>'required',
        ]);

        $check_token = \DB::table('password_resets')->where([
            'email'=>$request->email,
            'token'=>$request->token,
        ])->first();

        if(!$check_token){
            return back()->withInput()->with('fail', 'Invalid token');
        }else{

            Lecturer::where('email', $request->email)->update([
                'password'=>\Hash::make($request->password)
            ]);

            \DB::table('password_resets')->where([
                'email'=>$request->email
            ])->delete();

            return redirect()->route('lecturer.login')->with('info', 'Your password has been changed! You can login with new password')->with('verifiedEmail', $request->email);

        }
    }

}
