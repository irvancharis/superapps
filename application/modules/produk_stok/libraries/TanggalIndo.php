<?php
class TanggalIndo {
    private $hari = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
    private $bulan = [
        1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"
    ];

    public function formatTanggal($tanggal, $format = 'd F Y') {
        if (!$tanggal) {
            return "-";
        }
        
        $timestamp = strtotime($tanggal);
        $hari = $this->hari[date('w', $timestamp)];
        $tanggal = date('d', $timestamp);
        $bulan = $this->bulan[(int)date('m', $timestamp)];
        $tahun = date('Y', $timestamp);
        
        // Format tanggal berdasarkan pilihan
        switch ($format) {
            case 'd F Y':
                return "$tanggal $bulan $tahun";
            case 'l, d F Y':
                return "$hari, $tanggal $bulan $tahun";
            case 'd/m/Y':
                return date('d/m/Y', $timestamp);
            default:
                return date($format, $timestamp);
        }
    }
}
