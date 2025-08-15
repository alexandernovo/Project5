<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Record extends Model
{
    protected $table = 'records';

    protected $primaryKey = 'record_id';
    
    public $timestamps = true;

    protected $fillable = [
        'client_id',
        'ornumber',
        'association',
        'model_no',
        'brand',
        'serial_no',
        'lot_no',
        'requester',
        'name_other',
        'status',
        'type',
        'expiration',
    ];
}
