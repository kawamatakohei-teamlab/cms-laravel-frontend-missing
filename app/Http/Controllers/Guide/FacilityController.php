<?php

namespace App\Http\Controllers\Guide;

use App\Http\Controllers\Controller;

class FacilityController extends Controller
{
    /**
     * 施設案内TOP
     */
    public function index()
    {
        return view('pages/guide/facility/index');
    }
}
