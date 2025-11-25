<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Routing\Controller; // Pastikan ini benar
use Illuminate\Http\Request;
use App\Models\Customer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Kreait\Firebase\Factory;

class CustomerAuthController extends Controller
{

    // ... (Semua fungsi Anda yang lain: showLoginForm, profile, dll. tetap di sini) ...
    // ... (Saya akan singkat agar fokus ke perbaikan) ...

    public function showLoginForm(){ return view('auth.customer.login'); }
    public function showRegisterForm(){ return view('auth.customer.register'); }
    public function showForgotPasswordForm(){ return view('auth.customer.forgot-password'); }
    public function logout(Request $request){ Auth::guard('customer')->logout(); /*...*/ return redirect('/'); }
    public function profile(){ $customer = Auth::guard('customer')->user(); return view('auth.customer.profile', compact('customer')); }
    public function updateProfile(Request $request){ /*...*/ }
    public function changePassword(Request $request){ /*...*/ }
    public function exportData(){ return redirect()->route('auth.profile')->with('success', 'Fitur Ekspor Data sedang dalam pengembangan.'); }
    public function deleteAccount(){ return redirect()->route('auth.profile')->with('success', 'Fitur Hapus Akun sedang dalam pengembangan.'); }
    public function login(Request $request){ /*...*/ }
    public function register(Request $request){ /*...*/ }
    public function sendResetLink(Request $request){ /*...*/ }


    /*
    |--------------------------------------------------------------------------
    | FUNGSI FIREBASE (YANG KITA PERBAIKI)
    |--------------------------------------------------------------------------
    */

    public function firebaseLogin(Request $request)
    {
        $serviceAccountPath = base_path(env('FIREBASE_CREDENTIALS'));
        $firebase = (new Factory)->withServiceAccount($serviceAccountPath);
        
        $auth = $firebase->createAuth();
        $token = $request->input('token');

        try {
            $verifiedIdToken = $auth->verifyIdToken($token);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false, 
                'message' => 'Token tidak valid: ' . $e->getMessage()
            ], 401);
        }

        $uid = $verifiedIdToken->claims()->get('sub');
        $firebaseUser = $auth->getUser($uid);
        $email = $firebaseUser->email;

        $customer = Customer::where('firebase_uid', $uid)->orWhere('email', $email)->first();

        if ($customer) {
            if (empty($customer->firebase_uid)) {
                $customer->firebase_uid = $uid;
                $customer->save();
            }
        } else {
            $customer = Customer::create([
                'firebase_uid' => $uid,
                'name' => $firebaseUser->displayName ?? 'User Firebase',
                'email' => $email,
                'password' => bcrypt(uniqid()), 
                'email_verified_at' => now(),
            ]);
        }

        Auth::guard('customer')->login($customer);

        return response()->json([
            'success' => true,
            'message' => 'Login berhasil.'
        ]);
    }


    public function firebaseRegister(Request $request)
    {
        $serviceAccountPath = base_path(env('FIREBASE_CREDENTIALS'));
        $firebase = (new Factory)->withServiceAccount($serviceAccountPath);

        $auth = $firebase->createAuth();
        $token = $request->input('token');

        try {
            $verifiedIdToken = $auth->verifyIdToken($token);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Token tidak valid.'], 401);
        }

        $uid = $verifiedIdToken->claims()->get('sub');
        $email = $request->input('email');

        $existingCustomer = Customer::where('firebase_uid', $uid)->orWhere('email', $email)->first();
        if ($existingCustomer) {
            return response()->json(['success' => false, 'message' => 'Email sudah terdaftar.'], 400);
        }

        // ===== [PERBAIKAN UTAMA DI SINI] =====
        // Kita "bersihkan" input sebelum disimpan ke database
        // String kosong ("") diubah menjadi null
        $data = [
            'firebase_uid' => $uid,
            'name' => $request->input('name'), 
            'email' => $email,
            'password' => bcrypt(uniqid()), 
            'email_verified_at' => now(),
            'phone' => $request->input('phone') ?: null, // <-- Ubah "" jadi null
            'address' => $request->input('address') ?: null, // <-- Ubah "" jadi null
            'gender' => $request->input('gender') ?: null, // <-- Ubah "" jadi null
            'birth_date' => $request->input('birth_date') ?: null, // <-- Ubah "" jadi null
        ];
        // ======================================

        // 3. Buat Customer baru menggunakan data yang sudah bersih
        $customer = Customer::create($data);

        // 4. Login-kan customer ke sesi Laravel
        Auth::guard('customer')->login($customer);

        // 5. Kirim respon sukses
        return response()->json([
            'success' => true,
            'message' => 'Registrasi berhasil.'
        ]);
    }

}