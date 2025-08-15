<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AssociationController extends Controller
{
    public function association_view()
    {
        return view('association.views.association');
    }
}
