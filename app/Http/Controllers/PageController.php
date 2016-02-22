<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct(Request $r) {
        parent::__construct($r);
    }
    
    public function index()
    {
        //
    }

    public function memberFront(Request $request) {
        return view('member/home');
    }


}
