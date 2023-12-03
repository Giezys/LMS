<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use LMS\Modules\Core\Services\Verification\MasterVerifier;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->intended('/admin/dashboard');
            } elseif ($user->role === 'trainer') {
                return redirect()->intended('/trainer/dashboard');
            }else {
                return redirect()->intended('/member/dashboard');
            }
        }
            return back()->withErrors(['email' => 'Invalid credentials']);
    }

    
    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /*public function validateLogin(Request $request)
    {

        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required|captcha'
        ]);
    }*/

    public function validateLogin(Request $request)
    {
        app(MasterVerifier::class)->verify($request->all());
    }
}
