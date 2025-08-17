<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WasteBottle extends Model
{
    protected $table = 'wastebottle';

    protected $primaryKey = 'wastebottle_id';

    public $timestamps = true;

    protected $fillable = [
        'resident_name',
        'bottle_kg',
        'rice_kg',
    ];
}
