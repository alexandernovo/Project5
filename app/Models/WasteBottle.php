<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WasteBottle extends Model
{
    protected $table = 'wastebottle';

    protected $primaryKey = 'wastebottle_id';

    public $timestamps = true;

    protected $fillable = [
        'brgy',
        'municipality',
        'province',
        'purok',
        'bottleinkg',
        'riceinkg',
        'totalinrice',
    ];
}
