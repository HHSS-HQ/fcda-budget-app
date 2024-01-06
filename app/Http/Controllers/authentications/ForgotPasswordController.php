<?php 
  
namespace App\Http\Controllers\authentications; 
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use App\Models\User; 
use Mail; 
use Hash;
use Illuminate\Support\Str;
use Inertia\Inertia;
use App\Jobs\SendPasswordResetEmail;
// use Illuminate\Foundation\Auth\SendsPasswordResetEmails;

class ForgotPasswordController extends Controller
{
    // use SendsPasswordResetEmails;
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showForgetPasswordForm()
      {
         return view('content.authentications.auth-forgot-password-basic');
      }

    //   public function showResetPasswordForm()
    //   {
    //      return view('content.authentications.auth-reset-password');
    //   }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
    //   public function sendResetLinkEmail(Request $request)
    //   {
    //       $request->validate([
    //           'email' => 'required|email|exists:users',
    //       ]);
  
    //       $token = Str::random(64);
  
    //       DB::table('password_resets')->insert([
    //           'email' => $request->email, 
    //           'token' => $token, 
    //           'created_at' => Carbon::now()
    //         ]);
  
    //       Mail::send('email.password-reset', ['token' => $token], function($message) use($request){
    //           $message->to($request->email);
    //           $message->subject('Reset Password');
    //       });
  
    //       return back()->with('success', 'We have e-mailed your password reset link!');
    //   }




   

public function sendResetLinkEmail(Request $request)
{
    $request->validate([
        'email' => 'required|email|exists:users',
    ]);

    $token = Str::random(64);

    DB::table('password_resets')->insert([
        'email' => $request->email, 
        'token' => $token, 
        'created_at' => now(),
    ]);

    // Dispatch the job to send the password reset email
    dispatch(new SendPasswordResetEmail($request->email, $token));

    return back()->with('success', 'We have queued your password reset email!');
}


      /**
       * Write code on Method
       *
       * @return response()
       */
      public function showResetPasswordForm($token) { 
         return view('content.authentications.auth-password-reset', ['token' => $token]);
        //  return view('content.authentications.auth-reset-password');
      }
  
      /**
       * Write code on Method
       *
       * @return response()
       */
      public function submitResetPasswordForm(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:users',
              'password' => 'required|string|min:3|confirmed',
              'password_confirmation' => 'required'
          ]);
  
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $user = User::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return redirect('/login')->with('success', 'Your password has been changed!');
      }
}