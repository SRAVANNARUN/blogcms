<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mainmenu extends Model
{

    protected $fillable=([
        'main_menu'
    ]);

    
    public function submenus()
    {
        return $this->hasMany('App\Submenu');
    }
}
