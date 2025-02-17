<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tanggapan extends Model
{
    use HasFactory;

    protected $table = 'tanggapan';

    protected $fillable = ['id_pengaduan', 'petugas_id', 'tanggapan'];

    public function pengaduan()
    {
        return $this->belongsTo(Pengaduan::class);
    }
}
