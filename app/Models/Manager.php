<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Manager extends Model
{
    use HasFactory;

    public function Buildings()
    {
        return $this->belongsToMany('App\Models\Building', 'manager_building_relations');
    }
}
