<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CentroCivico;

class CentroCivicosController extends Controller
{
    public function index()
    {
        $centros = CentroCivico::all();
        return view('centros.index', compact('centros'));
    }
}
