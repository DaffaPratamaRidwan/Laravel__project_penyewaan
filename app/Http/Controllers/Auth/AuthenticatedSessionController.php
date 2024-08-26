<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        
        $user = Auth::user();

        if ($user->role->name == 'admin') {
            return redirect()->intended(route('admin.dataMaster.show'));
        } elseif ($user->role->name == 'penyewa') {
            return redirect()->intended(route('penyewa.dashboard'));
        } elseif ($user->role->name == 'direktur keuangan') {
            return redirect()->intended(route('admin.bayar'));
        } elseif ($user->role->name == 'direktur operasional') {
            return redirect()->intended(route('admin.sewa'));
        } elseif ($user->role->name == 'project manager') {
            return redirect()->intended(route('admin.pengembalian.approval'));
        }

        
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
