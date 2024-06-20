<?php

    namespace App\Http\Controllers\Admin;

    use App\Http\Controllers\Controller;
    use App\Http\Requests\Admin\AdminHandleLoginRequest;
    use App\Http\Requests\Admin\AdminResetPasswordRequest;
    use App\Http\Requests\Admin\AdminSendResetRequest;
    use App\Mail\AdminSendResetLinkMail;
    use App\Models\Admin;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Auth;
    use Illuminate\Support\Facades\Mail;
    use Illuminate\Support\Facades\RateLimiter;
    use Illuminate\Support\Str;
    use Illuminate\Validation\ValidationException;
    use RealRashid\SweetAlert\Facades\Alert;

    class AdminAuthController extends Controller
    {
        //Login Move to Blade
        public function login()
        {
            return view('admin.Auth.login');
        }

        //Login Function
        public function handleLogin( AdminHandleLoginRequest $request )
        {
            $request->authenticate();
            toast(__('You have  been login successfully!') , 'success');

            return redirect()->route('admin.dashboard');
        }

        //Logout Function
        public function logout( Request $request ): RedirectResponse
        {
            Auth::guard('admin')->logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

//            toast('Your have been logout successfully!' , 'success');


            return redirect()->route('admin.login');
        }

        //Forgot Password
        public function forgotPassword()
        {
            return view('admin.Auth.forgot-password');
        }

        public function sendResetLink( AdminSendResetRequest $request )
        {
            $token = Str::random(64);

            $admin = Admin::where('email' , $request->email)->first();

            $admin->remember_token = $token;
            toast(__('Your Link has been sent successfully!') , 'success');


            $admin->save();

            Mail::to($request->email)->send(new AdminSendResetLinkMail($token , $request->email));

            return redirect()->back()->with('success' , trans('A mail has been sent to your email address. Please check !'));
        }

        public function resetPassword( $token )
        {
            return view('admin.Auth.reset-password' , compact('token'));
        }

        public function handleResetPassword( AdminResetPasswordRequest $request )
        {
            $admin = Admin::where([ 'email' => $request->email , 'remember_token' => $request->token ])->first();

            if ( !$admin) {

                return back()->with('error' , 'Invalid token');

            } else {

                $admin->password = bcrypt($request->password);

                $admin->remember_token = null;

                toast(__('Your password as been changed successfully!') , 'success');

                $admin->save();

                return redirect()->route('admin.login')->with('success' , trans('Password changed successfully'));
            }
        }

    }
