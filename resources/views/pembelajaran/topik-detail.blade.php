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
                            <a href="#" class="group/btn w-full inline-flex items-center justify-center px-4 py-3 bg-blue-100 hover:bg-blue-200 text-[#0157B2] font-semibold rounded-full transition-all duration-300">
                                @if($topik->harga == 0)
                                    <i class="fas fa-check mr-2"></i> Akses Gratis Sekarang
                                @else
                                    <i class="fas fa-shopping-cart mr-2"></i> Beli Paket Ini
                                @endif
                            </a>
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

@endsection
