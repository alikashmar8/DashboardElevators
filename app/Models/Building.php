<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Building extends Model
{
    use HasFactory;

    public function Elevators()
    {
        return $this->hasMany('App\Models\Elevator');
    }

    public function Managers()
    {
        return $this->belongsToMany('App\Models\Manager', 'manager_building_relations');
    }

}
