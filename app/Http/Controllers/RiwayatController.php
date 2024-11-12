<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Riwayat;
use Carbon\Carbon;
use Box\Spout\Writer\Common\Creator\WriterEntityFactory;
use Box\Spout\Common\Entity\Row;

class RiwayatController extends Controller
{
    public function index(Request $request) {
        $tanggal = $request->query('date', Carbon::now()->toDateString());

        return view('riwayat.index', [
            "active" => "riwayat",
            "path" => ["Riwayat", "Home"],
            "title" => "Riwayat | Home",
            "riwayats" => Riwayat::whereDate('created_at', $tanggal)->get(),
            "tanggal" => $tanggal,
            "aAtas" => [
                'url' => route('riwayat.excel'),
                'icon' => 'bx bx-cloud',
                'text' => "Donwload Data",
            ],
          ]);
    }

    public function download() {
        $fileName = 'riwayat.xlsx';
        $writer = WriterEntityFactory::createXLSXWriter();
        $writer->openToFile($fileName);
    
        // Header kolom utama
        $headerRow = WriterEntityFactory::createRowFromArray(['Tanggal', 'No', 'Keterangan', 'Category']);
        $writer->addRow($headerRow);
    
        $riwayats = Riwayat::orderBy('created_at')->get();
        $groupedRiwayats = $riwayats->groupBy(function ($item) {
            return Carbon::parse($item->created_at)->format('Y-m-d');
        });
    
        // Iterasi setiap grup berdasarkan tanggal
        foreach ($groupedRiwayats as $tanggal => $riwayatGroup) {
            // Header tanggal sebagai judul
            $tanggalRow = WriterEntityFactory::createRowFromArray([$tanggal]);
            $writer->addRow($tanggalRow);
    
            // Menambahkan data riwayat untuk tanggal yang sama
            $no = 1; // Mengatur ulang nomor untuk setiap tanggal
            foreach ($riwayatGroup as $riwayat) {
                $row = WriterEntityFactory::createRowFromArray([
                    '', // Kolom kosong untuk tanggal
                    $no,
                    $riwayat->keterangan,
                    $riwayat->category->category,
                ]);
                $writer->addRow($row);
                $no++;
            }
        }
    
        $writer->close();
    
        // Mengunduh file Excel dan menghapus setelah diunduh
        return response()->download($fileName)->deleteFileAfterSend(true);
    }
    
}
