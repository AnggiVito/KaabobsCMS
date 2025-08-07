<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;


class MenuRoleMapping extends Model
{
    use Notifiable;


    protected $table = 'tbl_menu_role_mapping';    
    protected $fillable = [
        'id_menu',
        'id_sub_menu',
        'code_role',
        'action',
        'status'
    ];

    public function menu() {
        return $this->belongsTo('App\Models\Menu', 'id_menu');
    }

    public function menu_sub() {
        return $this->belongsTo('App\Models\MenuSub','id_sub_menu');
    }
}
