<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submenu extends Model
{
    protected $fillable=([
        'submenu',
        'mainmenu_id'

    ]);

    public function mainmenu()
    {
        return $this->belongsTo('App\Mainmenu');
    }
    public function posts()
    {
        return $this->hasMany('App\Post');
    }
}
