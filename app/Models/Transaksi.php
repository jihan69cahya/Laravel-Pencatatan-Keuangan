<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi';
    protected $fillable = [
        'tanggal',
        'users_id',
        'tipe',
        'nominal',
        'keterangan'
    ];

    protected static function booted(): void
    {
        static::addGlobalScope('pengguna', function (Builder $builder) {
            $builder->when(Auth::user()->role == 'pengguna', function ($query) {
                return $query->where('users_id', Auth::user()->id);
            });
        });
    }

    public function scopeSaldo($query)
    {
        return $query->selectRaw("
            COALESCE(SUM(
                CASE 
                    WHEN tipe IN ('SALDO AWAL', 'MASUK') THEN nominal 
                    WHEN tipe = 'KELUAR' THEN -nominal 
                    ELSE 0 
                END
            ),0) as saldo
        ")->value('saldo');
    }

    function relUser()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
