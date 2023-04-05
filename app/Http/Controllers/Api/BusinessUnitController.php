<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BusinessUnit;
use Illuminate\Http\Request;

class BusinessUnitController extends Controller
{
    public function index()
    {
        return BusinessUnit::all();
    }
}
