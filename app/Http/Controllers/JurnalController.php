<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jurnal;

class JurnalController extends Controller
{
    public function index() {

        $jurnal = Jurnal::All();

        return view('jurnal', compact('jurnal'));
    }
}