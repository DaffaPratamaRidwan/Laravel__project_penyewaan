<?php

namespace App\Http\Controllers;

use App\Models\AlatBerat;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //--------------------penyewa---------------------------
    public function penyewaDashboard()
    {
        $alatBerats = AlatBerat::all();
        return view('penyewa.dashboard', compact('alatBerats'));
    }

    public function show($id)
    {
        $alatBerat = AlatBerat::findOrFail($id);
        return view('penyewa.show', compact('alatBerat'));
    }

    //---------------------admin-----------------------------
    public function adminDashboard()
    {
        $alatBerats = AlatBerat::all();
        return view('admin.dashboard', compact('alatBerats'));
    }

    public function edit($id)
    {
        $alatBerat = AlatBerat::findOrFail($id);
        return view('admin.edit', compact('alatBerat'));
    }

    public function update(Request $request, $id)
    {
        $alatBerat = AlatBerat::findOrFail($id);
        // Lakukan validasi dan simpan perubahan
        $alatBerat->update($request->all());
    
        return redirect()->route('admin.dashboard')->with('success', 'Alat Berat berhasil diperbarui.');
    }
    
    public function destroy($id)
    {
        $alatBerat = AlatBerat::findOrFail($id);
        $alatBerat->delete();
    
        return redirect()->route('admin.dashboard')->with('success', 'Alat Berat berhasil dihapus.');
    }
}

