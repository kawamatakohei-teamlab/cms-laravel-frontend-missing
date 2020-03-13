<?php

namespace App\Http\Controllers;

class GuideController extends Controller
{
    /**
     * 大学案内TOP
     */
    public function index()
    {
        return view('pages/guide/index');
    }
}
