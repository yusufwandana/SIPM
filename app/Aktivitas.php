<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Aktivitas extends Model
{
    protected $table = 'aktivitas';

    protected $guarded = ['id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
