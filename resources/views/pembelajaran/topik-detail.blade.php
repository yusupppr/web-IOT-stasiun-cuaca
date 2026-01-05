@extends('layouts.app')

@section('content')

<section class="bg-gradient-to-br from-[#002343] to-[#0157B2] pt-28 pb-16 sm:pb-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mb-8" data-aos="fade-up">
            <a href="{{ route('pembelajaran.info') }}" class="inline-flex items-center text-cyan-200 hover:text-white transition-colors mb-4">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke Paket Pembelajaran
            </a>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white leading-tight">
                {{ $topik->title }}
            </h1>
            <p class="text-lg text-blue-100 mt-4">
                Detail lengkap tentang paket pembelajaran ini
            </p>
        </div>
    </div>
</section>

<section class="bg-white py-16 sm:py-20">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            
            {{-- Gambar & Harga (Sidebar) --}}
            <div class="md:col-span-1">
                <div class="sticky top-20 bg-white rounded-2xl shadow-lg overflow-hidden">
                    {{-- Gambar --}}
                    @if($topik->image)
                        <img src="{{ Storage::url($topik->image) }}" alt="{{ $topik->title }}" class="w-full h-64 object-cover">
                    @else
                        <div class="w-full h-64 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">Gambar tidak tersedia</span>
                        </div>
                    @endif

                    {{-- Harga & CTA --}}
                    <div class="p-6">
                        {{-- Harga --}}
                        @if($topik->harga == 0)
                            <div class="bg-green-100 rounded-lg p-4 mb-6 text-center">
                                <p class="text-sm text-green-600 font-semibold mb-1">HARGA</p>
                                <h3 class="text-3xl font-bold text-green-700">GRATIS</h3>
                                <p class="text-xs text-green-600 mt-2">Akses penuh untuk semua materi</p>
                            </div>
                        @else
                            <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-lg p-4 mb-6 text-center border border-blue-200">
                                <p class="text-sm text-gray-600 font-semibold mb-1">HARGA</p>
                                <h3 class="text-3xl font-bold text-[#0157B2]">Rp {{ number_format($topik->harga, 0, ',', '.') }}</h3>
                            </div>
                        @endif

                        {{-- Tombol CTA --}}
                        <div class="space-y-3">
                            {{-- Download PDF --}}
                            @if($topik->slug === 'iot-stasiun-mini')
                                <a href="{{ route('pembelajaran.download-pdf', $topik->slug) }}" class="group/btn w-full inline-flex items-center justify-center px-4 py-3 bg-gradient-to-r from-[#0157B2] to-[#01C0DB] hover:from-[#01C0DB] hover:to-[#0157B2] text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg">
                                    <i class="fas fa-file-pdf mr-2"></i> Download PDF
                                </a>
                            @endif

                            {{-- Daftar / Beli Paket --}}
                            @if($topik->harga == 0)
                                <button onclick="openAudiobookModal()" class="group/btn w-full inline-flex items-center justify-center px-4 py-3 bg-blue-100 hover:bg-blue-200 text-[#0157B2] font-semibold rounded-full transition-all duration-300">
                                    <i class="fas fa-headphones mr-2"></i> Audio Book
                                </button>
                            @else
                                <a href="#" class="group/btn w-full inline-flex items-center justify-center px-4 py-3 bg-blue-100 hover:bg-blue-200 text-[#0157B2] font-semibold rounded-full transition-all duration-300">
                                    <i class="fas fa-shopping-cart mr-2"></i> Beli Paket Ini
                                </a>
                            @endif
                        </div>

                        {{-- Info Tambahan --}}
                        <div class="mt-6 pt-6 border-t border-gray-200 space-y-3 text-sm">
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-green-600 mr-3 mt-0.5"></i>
                                <span class="text-gray-700">Akses seumur hidup</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-green-600 mr-3 mt-0.5"></i>
                                <span class="text-gray-700">Sertifikat resmi</span>
                            </div>
                            <div class="flex items-start">
                                <i class="fas fa-check-circle text-green-600 mr-3 mt-0.5"></i>
                                <span class="text-gray-700">Dukungan komunitas</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Konten Detail (Main Content) --}}
            <div class="md:col-span-2">
                
                {{-- Deskripsi --}}
                <div class="mb-10">
                    <h2 class="text-2xl font-bold text-[#002343] mb-4">Deskripsi Paket</h2>
                    <div class="prose prose-sm max-w-none text-gray-700 leading-relaxed">
                        {!! strip_tags($topik->description) !!}
                    </div>
                </div>

                {{-- Grid Info --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
                    
                    {{-- Teknologi --}}
                    <div class="bg-blue-50 rounded-xl p-6 border border-blue-100">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#0157B2] to-[#01C0DB] rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-microchip text-white"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-bold text-[#002343] mb-2">Teknologi</h3>
                                <p class="text-gray-700 text-sm">{{ $topik->teknologi }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Learning Outcomes --}}
                    <div class="bg-cyan-50 rounded-xl p-6 border border-cyan-100">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-br from-[#01C0DB] to-cyan-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-graduation-cap text-white"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-bold text-[#002343] mb-2">Learning Outcomes</h3>
                                <p class="text-gray-700 text-sm">{{ $topik->learning_outcomes }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Untuk Siapa --}}
                    <div class="bg-purple-50 rounded-xl p-6 border border-purple-100">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-400 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-users text-white"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-bold text-[#002343] mb-2">Untuk Siapa</h3>
                                <p class="text-gray-700 text-sm">{{ $topik->untuk }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Modul --}}
                    <div class="bg-orange-50 rounded-xl p-6 border border-orange-100">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-br from-orange-600 to-orange-400 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-book text-white"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-bold text-[#002343] mb-2">Modul</h3>
                                <p class="text-gray-700 text-sm">{{ $topik->modul }}</p>
                            </div>
                        </div>
                    </div>

                    {{-- Perangkat --}}
                    <div class="bg-green-50 rounded-xl p-6 border border-green-100 md:col-span-2">
                        <div class="flex items-start">
                            <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-green-400 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-laptop text-white"></i>
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-bold text-[#002343] mb-2">Perangkat yang Digunakan</h3>
                                <p class="text-gray-700 text-sm">{{ $topik->perangkat }}</p>
                            </div>
                        </div>
                    </div>

                </div>

                {{-- Icon Display --}}
                @if($topik->icon)
                    <div class="bg-gradient-to-r from-blue-50 to-cyan-50 rounded-xl p-8 text-center border border-blue-100">
                        <i class="{{ $topik->icon }} text-6xl text-[#0157B2] mb-4"></i>
                        <p class="text-gray-600 text-sm">{{ $topik->title }}</p>
                    </div>
                @endif

            </div>

        </div>
    </div>
</section>

{{-- Section Lainnya (Opsional) --}}
<section class="bg-gray-50 py-16">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl font-bold text-[#002343] mb-8 text-center">Mengapa Pilih Paket Ini?</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="text-4xl font-bold text-[#0157B2] mb-3">✓</div>
                <h3 class="text-lg font-bold text-[#002343] mb-2">Materi Berkualitas</h3>
                <p class="text-gray-600 text-sm">Disusun oleh expert di bidangnya dengan pengalaman industri nyata.</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="text-4xl font-bold text-[#01C0DB] mb-3">✓</div>
                <h3 class="text-lg font-bold text-[#002343] mb-2">Fleksibel & Praktis</h3>
                <p class="text-gray-600 text-sm">Belajar kapan saja, di mana saja dengan kecepatan Anda sendiri.</p>
            </div>

            <div class="bg-white rounded-xl shadow-lg p-6">
                <div class="text-4xl font-bold text-green-600 mb-3">✓</div>
                <h3 class="text-lg font-bold text-[#002343] mb-2">Sertifikat Resmi</h3>
                <p class="text-gray-600 text-sm">Dapatkan sertifikat yang diakui untuk meningkatkan profesionalisme Anda.</p>
            </div>
        </div>
    </div>
</section>

{{-- CTA Section --}}
<section class="bg-gradient-to-r from-[#0157B2] to-[#01C0DB] py-16">
    <div class="container mx-auto px-4 text-center">
        <h2 class="text-3xl sm:text-4xl font-bold text-white mb-4">Siap Belajar?</h2>
        <p class="text-lg text-blue-100 mb-8">Mulai perjalanan pembelajaran Anda hari ini dan kembangkan skill Anda!</p>
        
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            @if($topik->slug === 'iot-stasiun-mini')
                <a href="{{ route('pembelajaran.download-pdf', $topik->slug) }}" class="group/btn inline-flex items-center justify-center px-8 py-3 bg-white text-[#0157B2] font-semibold rounded-full transition-all duration-300 transform hover:scale-105 shadow-lg">
                    <i class="fas fa-file-pdf mr-2"></i> Download PDF Sekarang
                </a>
            @endif
            
            <a href="{{ route('pembelajaran.info') }}" class="group/btn inline-flex items-center justify-center px-8 py-3 border-2 border-white text-white font-semibold rounded-full transition-all duration-300 transform hover:scale-105">
                <i class="fas fa-arrow-left mr-2"></i> Kembali
            </a>
        </div>
    </div>
</section>

{{-- Modal Audio Book --}}
<div id="audiobookModal" class="fixed inset-0 bg-black bg-opacity-50 z-50 hidden flex items-center justify-center p-4">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto no-scrollbar">
        {{-- Modal Header --}}
        <div class="sticky top-0 z-20 bg-gradient-to-r from-[#0157B2] to-[#01C0DB] px-6 py-4 rounded-t-2xl flex items-center justify-between">
            <h3 class="text-2xl font-bold text-white">
                <i class="fas fa-headphones mr-2"></i> Audio Book
            </h3>
            <button onclick="closeAudiobookModal()" class="text-white hover:text-gray-200 transition-colors">
                <i class="fas fa-times text-2xl"></i>
            </button>
        </div>

        {{-- Modal Body --}}
        <div class="p-6">
            <p class="text-gray-600 mb-6 text-center">Pilih chapter yang ingin Anda dengarkan:</p>
            
            <!-- {{-- Audio Player (akan muncul saat audio diputar) --}}
            <div id="audioPlayerContainer" class="hidden mb-6 bg-gradient-to-r from-[#0157B2] to-[#01C0DB] rounded-xl p-4">
                <div class="flex items-center justify-between mb-3">
                    <div class="flex items-center space-x-3">
                        <button id="playPauseBtn" onclick="togglePlayPause()" class="w-12 h-12 bg-white text-[#0157B2] rounded-full flex items-center justify-center hover:bg-gray-100 transition-colors">
                            <i id="playPauseIcon" class="fas fa-play"></i>
                        </button>
                        <div>
                            <p id="currentChapter" class="text-white font-semibold">Chapter 1</p>
                            <p id="audioTime" class="text-blue-100 text-sm">00:00 / 00:00</p>
                        </div>
                    </div>
                    <button onclick="stopAudio()" class="text-white hover:text-gray-200 transition-colors">
                        <i class="fas fa-stop"></i>
                    </button>
                </div>
                <div class="flex items-center space-x-3">
                    <input type="range" id="progressBar" min="0" max="100" value="0" class="flex-1 h-2 bg-white rounded-lg appearance-none cursor-pointer" oninput="seekAudio(this.value)">
                    <div class="flex items-center space-x-2">
                        <i class="fas fa-volume-up text-white"></i>
                        <input type="range" id="volumeControl" min="0" max="100" value="100" class="w-20 h-2 bg-white rounded-lg appearance-none cursor-pointer" oninput="setVolume(this.value)">
                    </div>
                </div>
            </div> -->

            {{-- Audio Player Container --}}
            <div id="audioPlayerContainer" class="hidden mb-6 bg-gradient-to-r from-[#0157B2] to-[#01C0DB] rounded-xl p-4 shadow-inner">
                <div class="flex flex-col space-y-3">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center space-x-4">
                            {{-- Tombol Navigasi --}}
                            <div class="flex items-center space-x-2">
                                <button onclick="skipAudio(-10)" class="text-white hover:text-cyan-200 transition-colors" title="Mundur 10 detik">
                                    <i class="fas fa-undo-alt"></i>
                                </button>
                                
                                <button id="playPauseBtn" onclick="togglePlayPause()" class="w-12 h-12 bg-white text-[#0157B2] rounded-full flex items-center justify-center hover:scale-105 transition-transform">
                                    <i id="playPauseIcon" class="fas fa-play"></i>
                                </button>
                                
                                <button onclick="skipAudio(10)" class="text-white hover:text-cyan-200 transition-colors" title="Maju 10 detik">
                                    <i class="fas fa-redo-alt"></i>
                                </button>

                                <button onclick="skipAudio(60)" class="ml-2 px-2 py-1 border border-white/50 rounded text-[10px] text-white hover:bg-white/20" title="Maju 1 menit">
                                    +1m
                                </button>
                            </div>

                            <div>
                                <p id="currentChapter" class="text-white font-semibold text-sm">Chapter 1</p>
                                <p id="audioTime" class="text-blue-100 text-xs">00:00 / 00:00</p>
                            </div>
                        </div>
                        
                        <button onclick="stopAudio()" class="text-white/80 hover:text-white transition-colors">
                            <i class="fas fa-stop text-sm"></i>
                        </button>
                    </div>

                    {{-- Progress Bar --}}
                    <div class="flex items-center space-x-3">
                        <input type="range" id="progressBar" min="0" max="100" value="0" 
                            class="flex-1 h-1.5 bg-white/30 rounded-lg appearance-none cursor-pointer" 
                            oninput="seekAudio(this.value)">
                        
                        <div class="flex items-center space-x-2">
                            <i class="fas fa-volume-up text-white text-xs"></i>
                            <input type="range" id="volumeControl" min="0" max="100" value="100" 
                                class="w-16 h-1 bg-white/30 rounded-lg appearance-none cursor-pointer" 
                                oninput="setVolume(this.value)">
                        </div>
                    </div>
                </div>
            </div>
            
            {{-- Grid 4 Chapter --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                {{-- Chapter 1 --}}
                <div class="group bg-gradient-to-br from-blue-50 to-cyan-50 rounded-xl p-6 border-2 border-blue-200 hover:border-[#0157B2] transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#0157B2] to-[#01C0DB] rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg">1</span>
                        </div>
                        <i class="fas fa-play-circle text-[#0157B2] text-2xl transition-colors"></i>
                    </div>
                    <h4 class="text-lg font-bold text-[#002343] mb-2">Chapter 1</h4>
                    <p class="text-sm text-gray-600 mb-4">Bagian pertama dari materi pembelajaran</p>
                    <button onclick="playChapter(1)" class="w-full bg-[#0157B2] hover:bg-[#5170ff] text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                        <i class="fas fa-play mr-2"></i> Putar Audio
                    </button>
                </div>

                {{-- Chapter 2 --}}
                <div class="group bg-gradient-to-br from-cyan-50 to-blue-50 rounded-xl p-6 border-2 border-cyan-200 hover:border-[#01C0DB] transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-[#01C0DB] to-cyan-500 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg">2</span>
                        </div>
                        <i class="fas fa-play-circle text-[#01C0DB] text-2xl transition-colors"></i>
                    </div>
                    <h4 class="text-lg font-bold text-[#002343] mb-2">Chapter 2</h4>
                    <p class="text-sm text-gray-600 mb-4">Bagian kedua dari materi pembelajaran</p>
                    <button onclick="playChapter(2)" class="w-full bg-[#01C0DB] hover:bg-cyan-500 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                        <i class="fas fa-play mr-2"></i> Putar Audio
                    </button>
                </div>

                {{-- Chapter 3 --}}
                <div class="group bg-gradient-to-br from-purple-50 to-blue-50 rounded-xl p-6 border-2 border-purple-200 hover:border-purple-500 transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-purple-600 to-purple-400 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg">3</span>
                        </div>
                        <i class="fas fa-play-circle text-purple-600 text-2xl transition-colors"></i>
                    </div>
                    <h4 class="text-lg font-bold text-[#002343] mb-2">Chapter 3</h4>
                    <p class="text-sm text-gray-600 mb-4">Bagian ketiga dari materi pembelajaran</p>
                    <button onclick="playChapter(3)" class="w-full bg-purple-600 hover:bg-purple-500 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                        <i class="fas fa-play mr-2"></i> Putar Audio
                    </button>
                </div>

                {{-- Chapter 4 --}}
                <div class="group bg-gradient-to-br from-green-50 to-cyan-50 rounded-xl p-6 border-2 border-green-200 hover:border-green-500 transition-all duration-300 transform hover:scale-105">
                    <div class="flex items-center justify-between mb-4">
                        <div class="w-12 h-12 bg-gradient-to-br from-green-600 to-green-400 rounded-lg flex items-center justify-center">
                            <span class="text-white font-bold text-lg">4</span>
                        </div>
                        <i class="fas fa-play-circle text-green-600 text-2xl transition-colors"></i>
                    </div>
                    <h4 class="text-lg font-bold text-[#002343] mb-2">Chapter 4</h4>
                    <p class="text-sm text-gray-600 mb-4">Bagian keempat dari materi pembelajaran</p>
                    <button onclick="playChapter(4)" class="w-full bg-green-600 hover:bg-green-500 text-white font-semibold py-2 px-4 rounded-lg transition-colors">
                        <i class="fas fa-play mr-2"></i> Putar Audio
                    </button>
                </div>
                

            </div>
        </div>
    </div>
</div>

{{-- JavaScript untuk Modal --}}
<!-- <script>
    let currentAudio = null;
    let currentChapter = 0;

    function openAudiobookModal() {
        document.getElementById('audiobookModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeAudiobookModal() {
        // Stop audio jika sedang diputar
        if (currentAudio) {
            currentAudio.pause();
            currentAudio = null;
            document.getElementById('audioPlayerContainer').classList.add('hidden');
        }
        document.getElementById('audiobookModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    function playChapter(chapterNumber) {
        // Stop audio sebelumnya jika ada
        if (currentAudio) {
            currentAudio.pause();
            currentAudio = null;
        }

        // Path audio setelah storage:link
        const audioUrl = `/storage/audio/chapter-${chapterNumber}.mp3`;
        
        // Buat audio element baru
        currentAudio = new Audio(audioUrl);
        currentChapter = chapterNumber;

        // Tampilkan audio player
        document.getElementById('audioPlayerContainer').classList.remove('hidden');
        document.getElementById('currentChapter').textContent = `Chapter ${chapterNumber}`;
        
        // Update play/pause icon
        document.getElementById('playPauseIcon').className = 'fas fa-pause';

        // Event listeners untuk audio
        currentAudio.addEventListener('loadedmetadata', function() {
            updateAudioTime();
        });

        currentAudio.addEventListener('timeupdate', function() {
            updateProgress();
            updateAudioTime();
        });

        currentAudio.addEventListener('ended', function() {
            document.getElementById('playPauseIcon').className = 'fas fa-play';
            document.getElementById('progressBar').value = 0;
        });

        currentAudio.addEventListener('error', function(e) {
            console.error('Error loading audio:', e);
            alert('Gagal memuat audio.');
        });

        // Play audio
        currentAudio.play().catch(function(error) {
            console.error('Error playing audio:', error);
            alert('Gagal memutar audio. Pastikan browser mengizinkan autoplay.');
        });
    }

    function togglePlayPause() {
        if (!currentAudio) return;

        if (currentAudio.paused) {
            currentAudio.play();
            document.getElementById('playPauseIcon').className = 'fas fa-pause';
        } else {
            currentAudio.pause();
            document.getElementById('playPauseIcon').className = 'fas fa-play';
        }
    }

    function stopAudio() {
        if (currentAudio) {
            currentAudio.pause();
            currentAudio.currentTime = 0;
            document.getElementById('playPauseIcon').className = 'fas fa-play';
            document.getElementById('progressBar').value = 0;
            updateAudioTime();
        }
    }

    function seekAudio(value) {
        if (!currentAudio) return;
        const seekTime = (value / 100) * currentAudio.duration;
        currentAudio.currentTime = seekTime;
    }

    function setVolume(value) {
        if (!currentAudio) return;
        currentAudio.volume = value / 100;
    }

    function updateProgress() {
        if (!currentAudio) return;
        const progress = (currentAudio.currentTime / currentAudio.duration) * 100;
        document.getElementById('progressBar').value = progress || 0;
    }

    function updateAudioTime() {
        if (!currentAudio) return;
        const current = formatTime(currentAudio.currentTime);
        const duration = formatTime(currentAudio.duration);
        document.getElementById('audioTime').textContent = `${current} / ${duration}`;
    }

    function formatTime(seconds) {
        if (!seconds || isNaN(seconds)) return '00:00';
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
    }

    // Tutup modal saat klik di luar modal
    document.getElementById('audiobookModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeAudiobookModal();
        }
    });

    // Tutup modal dengan tombol ESC dan Play/Pause dengan Space
    document.addEventListener('keydown', function(e) {
    // 1. Logika untuk tombol Escape (Tutup Modal)
        if (e.key === 'Escape') {
            closeAudiobookModal();
    }

    // 2. Logika untuk tombol Space (Play/Pause)
    // Kita cek apakah currentAudio ada dan modal sedang tidak tersembunyi
        if (e.code === 'Space' || e.key === ' ') {
            const modal = document.getElementById('audiobookModal');
        
        // Hanya jalankan jika modal terbuka dan audio sudah pernah dipilih
        if (currentAudio && !modal.classList.contains('hidden')) {
            // Mencegah halaman scroll ke bawah saat menekan Space (Default behavior browser)
            e.preventDefault(); 
            togglePlayPause();
        }
    }
});
</script> -->

<script>
    let currentAudio = null;
    let currentChapter = 0;
    let audioBlobUrl = null; // Menyimpan URL sementara di memori browser

    function openAudiobookModal() {
        document.getElementById('audiobookModal').classList.remove('hidden');
        document.body.style.overflow = 'hidden';
    }

    function closeAudiobookModal() {
        // Stop audio jika sedang diputar
        if (currentAudio) {
            currentAudio.pause();
            currentAudio = null;
        }
        // Bersihkan memori dari Blob URL
        if (audioBlobUrl) {
            URL.revokeObjectURL(audioBlobUrl);
            audioBlobUrl = null;
        }
        document.getElementById('audioPlayerContainer').classList.add('hidden');
        document.getElementById('audiobookModal').classList.add('hidden');
        document.body.style.overflow = 'auto';
    }

    async function playChapter(chapterNumber) {
        // 1. Hentikan audio dan bersihkan memori URL sebelumnya
        if (currentAudio) {
            currentAudio.pause();
            currentAudio = null;
        }
        if (audioBlobUrl) {
            URL.revokeObjectURL(audioBlobUrl);
        }

        const playerContainer = document.getElementById('audioPlayerContainer');
        const chapterTitle = document.getElementById('currentChapter');
        
        playerContainer.classList.remove('hidden');
        chapterTitle.textContent = `Memuat Chapter ${chapterNumber}...`;

        // Path audio (sesuaikan jika Anda menggunakan folder slug)
        const audioUrl = `/storage/audio/chapter-${chapterNumber}.mp3`;

        try {
            // 2. TEKNIK KHUSUS: Download file ke memori browser (Blob)
            // Ini agar fitur 'Seeking' lancar di localhost (php artisan serve)
            const response = await fetch(audioUrl);
            if (!response.ok) throw new Error("File audio tidak ditemukan");
            
            const blob = await response.blob();
            audioBlobUrl = URL.createObjectURL(blob);
            
            currentAudio = new Audio(audioBlobUrl);
            currentChapter = chapterNumber;

            // Update UI Tampilan
            chapterTitle.textContent = `Chapter ${chapterNumber}`;
            document.getElementById('playPauseIcon').className = 'fas fa-pause';

            // 3. Pasang ulang Event Listeners
            currentAudio.addEventListener('loadedmetadata', updateAudioTime);
            currentAudio.addEventListener('timeupdate', () => {
                updateProgress();
                updateAudioTime();
            });
            currentAudio.addEventListener('ended', () => {
                document.getElementById('playPauseIcon').className = 'fas fa-play';
                document.getElementById('progressBar').value = 0;
            });

            // Putar audio
            currentAudio.play();

        } catch (error) {
            console.error(error);
            alert('Gagal memuat audio. Pastikan file ada di public/storage/audio/');
            playerContainer.classList.add('hidden');
        }
    }

    function togglePlayPause() {
        if (!currentAudio) return;

        if (currentAudio.paused) {
            currentAudio.play();
            document.getElementById('playPauseIcon').className = 'fas fa-pause';
        } else {
            currentAudio.pause();
            document.getElementById('playPauseIcon').className = 'fas fa-play';
        }
    }

    function stopAudio() {
        if (currentAudio) {
            currentAudio.pause();
            currentAudio.currentTime = 0;
            document.getElementById('playPauseIcon').className = 'fas fa-play';
            document.getElementById('progressBar').value = 0;
            updateAudioTime();
        }
    }

    function skipAudio(seconds) {
        // Cek apakah audio sudah siap (durasi terdeteksi)
        if (!currentAudio || !isFinite(currentAudio.duration)) return;
        
        let newTime = currentAudio.currentTime + seconds;
        
        // Batasi agar tidak kurang dari 0 atau lebih dari durasi
        if (newTime < 0) newTime = 0;
        if (newTime > currentAudio.duration) newTime = currentAudio.duration;
        
        currentAudio.currentTime = newTime;
    }

    function seekAudio(value) {
        if (!currentAudio || !isFinite(currentAudio.duration)) return;
        const seekTime = (value / 100) * currentAudio.duration;
        currentAudio.currentTime = seekTime;
    }

    function setVolume(value) {
        if (!currentAudio) return;
        currentAudio.volume = value / 100;
    }

    function updateProgress() {
        if (!currentAudio || !isFinite(currentAudio.duration)) return;
        const progress = (currentAudio.currentTime / currentAudio.duration) * 100;
        document.getElementById('progressBar').value = progress || 0;
    }

    function updateAudioTime() {
        if (!currentAudio) return;
        const current = formatTime(currentAudio.currentTime);
        const duration = isFinite(currentAudio.duration) ? formatTime(currentAudio.duration) : '00:00';
        document.getElementById('audioTime').textContent = `${current} / ${duration}`;
    }

    function formatTime(seconds) {
        if (!seconds || isNaN(seconds)) return '00:00';
        const mins = Math.floor(seconds / 60);
        const secs = Math.floor(seconds % 60);
        return `${String(mins).padStart(2, '0')}:${String(secs).padStart(2, '0')}`;
    }

    // Tutup modal saat klik di luar modal
    document.getElementById('audiobookModal').addEventListener('click', function(e) {
        if (e.target === this) {
            closeAudiobookModal();
        }
    });

    // Kontrol Keyboard (Space, Arrow Keys, ESC)
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('audiobookModal');
        if (modal.classList.contains('hidden')) return;

        if (e.key === 'Escape') {
            closeAudiobookModal();
        }

        if (e.code === 'Space' || e.key === ' ') {
            if (currentAudio) {
                e.preventDefault(); 
                togglePlayPause();
            }
        }

        if (e.key === 'ArrowRight') {
            if (currentAudio) {
                e.preventDefault();
                skipAudio(10); // Maju 10 detik
            }
        }

        if (e.key === 'ArrowLeft') {
            if (currentAudio) {
                e.preventDefault();
                skipAudio(-10); // Mundur 10 detik
            }
        }
    });
</script>
{{-- Styling untuk Range Input (Progress Bar & Volume) --}}
<style>
    /* Progress Bar Styling */
    #progressBar {
        -webkit-appearance: none;
        appearance: none;
        background: rgba(255, 255, 255, 0.3);
        height: 6px;
        border-radius: 5px;
        outline: none;
    }

    #progressBar::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: white;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    #progressBar::-moz-range-thumb {
        width: 16px;
        height: 16px;
        border-radius: 50%;
        background: white;
        cursor: pointer;
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    /* Volume Control Styling */
    #volumeControl {
        -webkit-appearance: none;
        appearance: none;
        background: rgba(255, 255, 255, 0.3);
        height: 4px;
        border-radius: 5px;
        outline: none;
    }

    #volumeControl::-webkit-slider-thumb {
        -webkit-appearance: none;
        appearance: none;
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: white;
        cursor: pointer;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    #volumeControl::-moz-range-thumb {
        width: 12px;
        height: 12px;
        border-radius: 50%;
        background: white;
        cursor: pointer;
        border: none;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
    }

    /* Hide scrollbar untuk modal */
    .no-scrollbar::-webkit-scrollbar {
        display: none;
    }
    .no-scrollbar {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }
</style>

@endsection
