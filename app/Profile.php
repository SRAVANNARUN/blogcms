<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    protected $fillable=([
        'image','about','user_id',
    ]);
    // public function user()
    // {
    //     return $this->belongsTo('App\User');
    // }
   
}
