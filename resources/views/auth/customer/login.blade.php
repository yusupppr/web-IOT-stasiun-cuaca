@extends('layouts.app')
@section('title', 'Login - Terobos')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-gray-900 via-blue-900 to-indigo-900 flex items-center justify-center py-12 px-4 sm:px-6 mt-12 lg:px-8">
    <div class="max-w-md w-full">
        
        <div class="text-center mb-8" data-aos="fade-down">
            <div class="mx-auto h-16 w-16 bg-gradient-to-r from-cyan-500 to-blue-500 rounded-full flex items-center justify-center mb-4">
                <i class="fas fa-robot text-white text-2xl animate-pulse"></i>
            </div>
            <h2 class="text-3xl font-bold text-white mb-2">Selamat Datang Kembali</h2>
            <p class="text-gray-300">Masuk ke akun Terobos Anda</p>
        </div>

        <div class="bg-white/10 backdrop-blur-lg rounded-2xl p-8 shadow-2xl border border-white/20" data-aos="fade-up" data-aos-delay="100">
            
            <div id="firebase-error" class="hidden mb-6 bg-red-500/10 border border-red-500/50 rounded-lg p-4">
                <div class="flex items-center">
                    <i id="firebase-error-icon" class="fas fa-exclamation-triangle text-red-400 mr-2"></i>
                    <span id="firebase-error-message" class="text-red-300 text-sm"></span>
                </div>
            </div>

            <form id="login-form" class="space-y-6">
                @csrf 
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-200 mb-2">
                        <i class="fas fa-envelope mr-2 text-cyan-400"></i>Alamat Email
                    </label>
                    <input type="email" id="email" name="email" required 
                           class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300"
                           placeholder="Masukkan email Anda">
                </div>

                <div>
                    <label for="password" class="block text-sm font-medium text-gray-200 mb-2">
                        <i class="fas fa-lock mr-2 text-cyan-400"></i>Kata Sandi
                    </label>
                    <div class="relative">
                        <input type="password" id="password" name="password" required 
                               class="w-full px-4 py-3 bg-white/5 border border-white/20 rounded-lg text-white placeholder-gray-400 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-transparent transition-all duration-300"
                               placeholder="Masukkan kata sandi Anda">
                        
                        {{-- (Tambahkan tombol show/hide password Anda di sini jika ada) --}}
                    </div>
                </div>

                <div class="flex items-center justify-end">
                    <a href="#" id="forgot-password-link" class="text-sm text-cyan-400 hover:text-cyan-300 transition-colors">
                        Lupa kata sandi?
                    </a>
                </div>

                <button type="submit" id="login-button"
                        class="w-full relative group bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-600 hover:to-blue-700 text-white font-semibold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg hover:shadow-cyan-500/25">
                    <span class="relative flex items-center justify-center">
                        <i class="fas fa-sign-in-alt mr-2"></i>
                        <span id="login-button-text">Masuk</span>
                        <i id="login-spinner" class="fas fa-spinner fa-spin hidden ml-2"></i>
                    </span>
                </button>

                <div class="my-4 flex items-center">
                    <div class="flex-grow border-t border-white/20"></div>
                    <span class="mx-4 flex-shrink text-gray-400 text-sm">ATAU</span>
                    <div class="flex-grow border-t border-white/20"></div>
                </div>

                <button type="button" id="google-login-button" 
                        class="w-full relative group bg-white hover:bg-gray-200 text-gray-900 font-semibold py-3 px-4 rounded-lg transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <span class="relative flex items-center justify-center">
                        <img class="w-5 h-5 mr-3" src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google logo">
                        Masuk dengan Google
                        <i id="google-login-spinner" class="fas fa-spinner fa-spin hidden ml-3"></i>
                    </span>
                </button>

                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-white/20"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-2 bg-transparent text-gray-400">Belum punya akun?</span>
                    </div>
                </div>

                <div class="text-center">
                    <a href="{{ route('auth.register') }}" 
                       class="inline-flex items-center px-6 py-2 border-2 border-cyan-400/50 text-cyan-400 rounded-lg hover:bg-cyan-400 hover:text-gray-900 transition-all duration-300 font-medium">
                        <i class="fas fa-user-plus mr-2"></i>
                        Buat Akun Baru
                    </a>
                </div>
            </form>
        </div>

        <div class="text-center mt-6">
            <a href="{{ route('home') }}" class="text-gray-400 hover:text-white transition-colors text-sm">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Beranda
            </a>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Ambil elemen-elemen Form
    const loginForm = document.getElementById('login-form');
    const loginButton = document.getElementById('login-button');
    const loginButtonText = document.getElementById('login-button-text');
    const loginSpinner = document.getElementById('login-spinner');
    
    // Ambil elemen Google
    const googleLoginButton = document.getElementById('google-login-button');
    const googleLoginSpinner = document.getElementById('google-login-spinner');
    
    // Ambil elemen Error
    const errorDiv = document.getElementById('firebase-error');
    const errorMessage = document.getElementById('firebase-error-message');
    const errorIcon = document.getElementById('firebase-error-icon');
    
    // Ambil link Lupa Password
    const forgotLink = document.getElementById('forgot-password-link');
    
    // Ambil Token CSRF
    const csrfToken = loginForm.querySelector('input[name="_token"]').value;

    // --- Fungsi Bantuan untuk Tampilkan Pesan ---
    function showMessage(message, isSuccess = false) {
        errorMessage.textContent = message;
        errorDiv.classList.remove('hidden');

        if (isSuccess) {
            errorDiv.classList.remove('bg-red-500/10', 'border-red-500/50');
            errorDiv.classList.add('bg-green-500/10', 'border-green-500/50');
            errorMessage.classList.remove('text-red-300');
            errorMessage.classList.add('text-green-300');
            errorIcon.className = 'fas fa-check-circle text-green-400 mr-2';
        } else {
            errorDiv.classList.add('bg-red-500/10', 'border-red-500/50');
            errorDiv.classList.remove('bg-green-500/10', 'border-green-500/50');
            errorMessage.classList.add('text-red-300');
            errorMessage.classList.remove('text-green-300');
            errorIcon.className = 'fas fa-exclamation-triangle text-red-400 mr-2';
        }
        
        // Sembunyikan semua loading
        loginButton.disabled = false;
        loginButtonText.textContent = 'Masuk';
        loginSpinner.classList.add('hidden');
        googleLoginButton.disabled = false;
        googleLoginSpinner.classList.add('hidden');
    }

    // --- Fungsi untuk mengirim Token ke Laravel ---
    function sendTokenToBackend(idToken) {
        return fetch("{{ route('auth.firebase.login') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({ token: idToken })
        });
    }

    // --- 1. Event Listener untuk Form Login (Email/Password) ---
    loginForm.addEventListener('submit', function(e) {
        e.preventDefault(); 
        
        const email = document.getElementById('email').value;
        const password = document.getElementById('password').value;

        loginButton.disabled = true;
        loginButtonText.textContent = 'Memproses...';
        loginSpinner.classList.remove('hidden');
        errorDiv.classList.add('hidden');

        auth.signInWithEmailAndPassword(email, password)
            .then((userCredential) => userCredential.user.getIdToken())
            .then((idToken) => sendTokenToBackend(idToken))
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "{{ route('home') }}"; 
                } else {
                    showMessage(data.message || 'Gagal memverifikasi sesi.', false);
                }
            })
            .catch((error) => {
                showMessage(error.message, false);
            });
    });

    // --- 2. Event Listener untuk Tombol Google ---
    const googleProvider = new firebase.auth.GoogleAuthProvider();
    googleLoginButton.addEventListener('click', function() {
        
        googleLoginButton.disabled = true;
        googleLoginSpinner.classList.remove('hidden');
        errorDiv.classList.add('hidden');

        auth.signInWithPopup(googleProvider)
            .then((result) => result.user.getIdToken())
            .then((idToken) => sendTokenToBackend(idToken))
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    window.location.href = "{{ route('home') }}"; 
                } else {
                    showMessage(data.message || 'Gagal memverifikasi sesi Google.', false);
                }
            })
            .catch((error) => {
                showMessage(error.message, false);
            })
            .finally(() => {
                // Sembunyikan loading di tombol Google
                googleLoginButton.disabled = false;
                googleLoginSpinner.classList.add('hidden');
            });
    });

    // --- 3. Event Listener untuk Link Lupa Password ---
    forgotLink.addEventListener('click', function(e) {
        e.preventDefault();
        
        const email = document.getElementById('email').value;
        if (!email) {
            showMessage('Harap masukkan email Anda di kolom email terlebih dahulu.', false);
            return;
        }

        loginButton.disabled = true;
        loginButtonText.textContent = 'Mengirim Email...';
        loginSpinner.classList.remove('hidden');
        errorDiv.classList.add('hidden');

        auth.sendPasswordResetEmail(email)
            .then(() => {
                showMessage('Link reset password telah dikirim ke email Anda!', true);
            })
            .catch((error) => {
                showMessage(error.message, false);
            });
    });

});
</script>
@endsection