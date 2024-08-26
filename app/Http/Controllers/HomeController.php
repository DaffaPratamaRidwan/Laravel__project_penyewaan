<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
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
    }
}