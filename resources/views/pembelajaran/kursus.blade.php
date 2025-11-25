@extends('layouts.app')

@section('content')

<section class="bg-gradient-to-br from-[#002343] to-[#0157B2] pt-28 pb-16 sm:pb-20">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mb-12" data-aos="fade-up">
            <span class="inline-block px-4 py-2 bg-white/10 text-cyan-200 rounded-full text-sm font-semibold mb-4">
              Katalog Kursus
            </span>
            <h1 class="text-3xl sm:text-4xl md:text-5xl font-bold text-white leading-tight">
                Jelajahi <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#01C0DB] to-cyan-300">Kursus</span> Robotika
            </h1>
            <p class="text-lg text-blue-100 mt-4">
                Temukan dan pelajari berbagai topik pembelajaran robotika dari pemula hingga mahir.
            </p>
        </div>

        <div class="flex flex-wrap gap-3" data-aos="fade-up" data-aos-delay="100">
            <a href="{{ route('pembelajaran.info') }}" class="border-2 border-white/50 text-white hover:bg-white hover:text-[#002343] font-semibold px-6 py-2 rounded-full transition-colors duration-300">
                Kembali ke Pembelajaran
            </a>
        </div>
    </div>
</section>

<!-- Search & Filter Section -->
<section class="bg-white py-8 sm:py-12 border-b border-gray-200">
    <div class="container mx-auto px-4">
        <form id="search-form" class="flex flex-col sm:flex-row gap-4">
            <div class="flex-1">
                <input 
                    type="text" 
                    id="search-input"
                    placeholder="Cari kursus..." 
                    class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#0157B2] transition-colors"
                >
            </div>
            <button 
                type="submit"
                class="px-6 py-3 bg-gradient-to-r from-[#0157B2] to-[#01C0DB] text-white font-semibold rounded-lg hover:shadow-lg transition-all duration-300"
            >
                <i class="fas fa-search mr-2"></i>Cari
            </button>
        </form>
    </div>
</section>

<!-- Kursus List -->
<section class="bg-gray-50 py-16 sm:py-20">
    <div class="container mx-auto px-4">
        <h2 class="text-3xl sm:text-4xl font-bold text-[#002343] mb-8 pt-4" data-aos="fade-up">
            Daftar <span class="text-transparent bg-clip-text bg-gradient-to-r from-[#0157B2] to-[#01C0DB]">Kursus</span>
        </h2>
        <hr class="border-t border-gray-200 mb-8">

        @if($topik->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                {{-- LOOPING KURSUS DARI DATABASE --}}
                @foreach($topik as $item)
                <div class="group bg-white border border-gray-200 hover:border-sky-500 rounded-2xl shadow-lg overflow-hidden transition-all duration-300 transform hover:shadow-xl hover:scale-105" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="relative overflow-hidden">
                        {{-- Thumbnail Gambar --}}
                        @if($item->image)
                            <img src="{{ Storage::url($item->image) }}" alt="{{ $item->title }}" class="w-full h-48 object-cover group-hover:scale-110 transition-transform duration-300">
                        @else
                            <div class="w-full h-48 bg-gray-300 flex items-center justify-center">
                                <span class="text-gray-500">Gambar tidak tersedia</span>
                            </div>
                        @endif
                        
                        {{-- Badge Harga --}}
                        <div class="absolute top-3 right-3 bg-gradient-to-r from-[#0157B2] to-[#01C0DB] text-white px-3 py-1 rounded-full text-sm font-semibold">
                            Rp {{ number_format($item->harga, 0, ',', '.') }}
                        </div>
                    </div>

                    <div class="p-6">
                        {{-- Icon dan Judul --}}
                        <h3 class="text-xl font-bold text-[#002343] mb-2 flex items-center space-x-2">
                            @if($item->icon)
                                <i class="{{ $item->icon }} text-[#0157B2]"></i>
                            @endif
                            <span>{{ $item->title }}</span>
                        </h3>

                        {{-- Deskripsi Singkat --}}
                        <p class="text-gray-600 text-sm mb-4 line-clamp-3">
                            {!! strip_tags($item->description) !!}
                        </p>

                        {{-- Info Spesifik --}}
                        <div class="space-y-2 text-xs text-gray-700 mb-4">
                            <p><strong>Teknologi:</strong> {{ $item->teknologi }}</p>
                            <p><strong>Untuk:</strong> {{ $item->untuk }}</p>
                            <p><strong>Modul:</strong> {{ $item->modul }}</p>
                        </div>

                        {{-- Button --}}
                        <div class="flex flex-col gap-2">
                            <a href="{{ route('pembelajaran.show', $item->slug) }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-blue-100 hover:bg-blue-200 text-[#0157B2] font-semibold rounded-lg transition-all duration-300">
                                <i class="fas fa-eye mr-2"></i>Lihat Detail
                            </a>
                            <a href="{{ route('pembelajaran.show', $item->slug) }}" class="w-full inline-flex items-center justify-center px-4 py-2 bg-gradient-to-r from-[#0157B2] to-[#01C0DB] hover:shadow-lg text-white font-semibold rounded-lg transition-all duration-300">
                                <i class="fas fa-arrow-right mr-2"></i>Pelajari
                            </a>
                        </div>
                    </div>
                </div>
                @endforeach
                {{-- AKHIR LOOPING --}}
            </div>
        @else
            <div class="text-center col-span-full py-12">
                <p class="text-gray-500 text-lg">
                    Belum ada kursus tersedia.
                </p>
            </div>
        @endif
    </div>
</section>

@endsection
