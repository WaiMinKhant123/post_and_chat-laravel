<?php

namespace App\Http\Controllers\Auth;
use App\Models\User; 
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth; 

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/post';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function credentials(Request $request)
    {
        $credentials = $request->only($this->username(), 'password');
        $user = User::where($this->username(), $request->input($this->username()))->first();

        if ($user && $user->isBanned()) {
            throw ValidationException::withMessages([
                $this->username() => ['Your account has been banned.'],
            ]);
        }

        return $credentials;
    }

    protected function authenticated(Request $request, $user)
    {
        // Redirect to the profile page instead of the default $redirectTo
        return redirect()->route('post.index'); // Make sure 'profile' is your route name
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
