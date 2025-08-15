<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    protected $table = 'clients';

    protected $primaryKey = 'client_id';

    public $timestamps = true;

    protected $fillable = [
        'owner_name',
        'address',
    ];
}
