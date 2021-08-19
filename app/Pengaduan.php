<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pengaduan extends Model
{
    protected $table = 'pengaduan';
    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\Masyarakat');
    }

    public function tanggapan()
    {
        return $this->hasMany('App\Tanggapan');
    }

    public function masyarakat()
    {
        return $this->belongsTo('App\Masyarakat');
    }
}
