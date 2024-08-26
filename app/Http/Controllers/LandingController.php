<?php

namespace App\Http\Controllers;

use App\Models\AlatBerat;
use App\Models\Sewa;
use App\Models\SewaDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;


class LandingController extends Controller
{

    public function landing()
    {
        $alatBerats = AlatBerat::all();
        return view('auth.landing', compact('alatBerats'));
    }


}
