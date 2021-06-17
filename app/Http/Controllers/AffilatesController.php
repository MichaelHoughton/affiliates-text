<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\DataSource\Affiliate;

class AffilatesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $affiliates = Affiliate::getWithinDistance(100);

        return view('home', compact('affiliates'));
    }
}
