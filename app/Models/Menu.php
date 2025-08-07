<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use Notifiable;


    protected $table = 'tbl_menu';    
    protected $fillable = [
        'menu_label',
        'icon',
        'status'
    ];

    public function menu_sub() {
        return $this->hasMany('App\Models\MenuSub','id_menu');
    }

    public function menu_role_mapping() {
        return $this->hasMany('App\Models\MenuRoleMapping','id_menu');
    }
}
