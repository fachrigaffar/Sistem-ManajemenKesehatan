<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Route;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected function redirectTo()
    {
        $user = Auth::user();
        if ($user) {
            return match ($user->role) {
                'dokter' => '/dokter',
                'pasien' => '/pasien',
                default => '/',
            };
        }
        return '/';

    }
    // Post-logout redirection
    protected function loggedOut(Request $request)
    {
        $user = Auth::user(); // User is null after logout, so we need to get role before logout
        $role = $request->session()->get('role'); // Store role in session before logout

        return redirect (match ($role) {
            'dokter' => '/dokter',
            'pasien' => '/pasien',
            default => '/',
        })->with('status', 'You have been logged out successfully.');
    }
    
    public function logout(Request $request)
    {
        $request->session()->put('user_role', Auth::user()->role); // Store role before logout
        $this->guard()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request)) {
            return $response;
        }

        return $request->wantsJson()
            ? new \Illuminate\Http\JsonResponse([], 204)
            : redirect('/');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}
