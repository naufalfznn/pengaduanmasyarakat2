<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    use HasFactory;

    protected $table = 'pengaduan'; // Pastikan tabelnya benar

    protected $primaryKey = 'id_pengaduan'; // Pastikan primary key sesuai dengan database

    protected $fillable = ['id_pengaduan', 'nik', 'tgl_pengaduan', 'isi_laporan', 'foto', 'status'];

    public function masyarakat()
    {
        return $this->belongsTo(Masyarakat::class, 'nik');
    }

    public function tanggapan()
    {
        return $this->hasOne(Tanggapan::class, 'id_pengaduan');
    }
}

