<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\User;
use App\Models\Kelas;
use Illuminate\Support\Facades\Log;
use App\Models\Siswa;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Halaman utama siswa
    public function index()
    {
        $kelas = Kelas::all(); // Mengambil semua kelas
        return view('auth.register', compact('kelas'));
    }

    public function storeRegister(Request $request)
    {
        // Validasi input
    $request->validate([
        'username' => 'required|string|max:255|unique:users,username',
        'email' => 'required|string|max:20',
        'kelas_id' => 'required|exists:kelas,id',
        'gender' => 'required|in:Laki-laki,Perempuan',
        'password' => 'required|string|max:255',
        'role' => 'required',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
    ]);
    

    // Simpan siswa sebagai user dengan role siswa dan kelas_id
    $user = User::create([
        'username' => $request->username,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
        'kelas_id' => $request->kelas_id,
    ]);

    $file = $request->file('foto');
    $filename = time() . '_' . $file->getClientOriginalName();
    $file->move(public_path('images/admin_photos'), $filename);
    $user->foto = 'images/admin_photos/' . $filename;

    $user->save();    
    
    // Simpan data siswa dengan user_id terkait
    Siswa::create([
        'user_id' => $user->id,
        'gender' => $request->gender,
    ]);
    
    return redirect('/login')->with('success', 'Data berhasil ditambahkan');
    }


}
