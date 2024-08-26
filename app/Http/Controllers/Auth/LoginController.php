<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/home';

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

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        
        // $user = Auth::user();
        $roleName = $user->role->name;

        switch ($roleName) {
            case 'admin':
                return redirect()->route('admin.dataMaster.show');
            case 'direktur keuangan':
                return redirect()->route('admin.bayar');
            case 'direktur operasional':
                return redirect()->route('admin.sewa');
            case 'project manager':
                return redirect()->route('admin.pengembalian.approval');
            case 'penyewa':
                return redirect()->route('penyewa.dashboard');
        }

        // return redirect()->route('home'); 
    }
}
