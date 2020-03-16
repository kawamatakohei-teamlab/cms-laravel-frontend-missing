<?php

namespace App\Http\Controllers\Guide;

use App\Http\Controllers\Controller;

class FacilityDetailController extends Controller
{
    /**
     * 施設案内TOP
     */
    public function show($permalink)
    {
        \Debugbar::info($permalink);
        return view('pages/guide/facility_detail/show');
    }
}
