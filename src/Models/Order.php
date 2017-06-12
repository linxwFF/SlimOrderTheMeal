<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model as Model;
use App\Models\Menu as Menu;

class Order extends Model
{
    protected $table = 'order';

    // public function seat()
    // {
    //     return $this->belongsTo('App\Models\Seat');
    // }

    public function menu()
    {
        return $this->hasOne('App\Moldes\Menu');
    }
}
