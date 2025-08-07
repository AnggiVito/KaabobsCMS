<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class MenuSub extends Model
{
    use Notifiable;


    protected $table = 'tbl_menu_sub';    
    protected $fillable = [
        'id_menu',
        'sub_menu_label',
        'link',
        'status'
    ];

    public function menu() {
        return $this->belongsTo('App\Models\Menu', 'id_menu');
    }

    public function menu_role_mapping() {
        return $this->hasMany('App\Models\MenuRoleMapping','id_sub_menu');
    }
}
