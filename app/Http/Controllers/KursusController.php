<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use App\Models\TopikPembelajaran;
use Illuminate\Support\Facades\Storage;

class KursusController extends Controller
{
   
    public function info()
    {
        // 2. Ambil semua data
        $topik = TopikPembelajaran::orderBy('order', 'asc')->get();
        
        // 3. Kirim data ke view
        return view('pembelajaran.pembelajaran-info', compact('topik'));
    }

    public function index()
    {
        // Ambil semua data kursus dari database
        $topik = TopikPembelajaran::orderBy('order', 'asc')->get();
        
        // Kirim data ke view kursus
        return view('pembelajaran.kursus', compact('topik'));
    }

    public function show($slug)
    {
        $topik = TopikPembelajaran::where('slug', $slug)->firstOrFail();
        return view('pembelajaran.topik-detail', compact('topik'));
    }

    public function downloadPdf($slug)
    {
        $topik = TopikPembelajaran::where('slug', $slug)->firstOrFail();
        
        // Path PDF di storage
        $pdfPath = 'pdf/' . $slug . '.pdf';
        
        // Cek apakah file ada
        if (!Storage::disk('public')->exists($pdfPath)) {
            return redirect()->back()->with('error', 'File PDF tidak ditemukan');
        }
        
        // Download file
        return Storage::disk('public')->download($pdfPath, $topik->title . '.pdf');
    }
}