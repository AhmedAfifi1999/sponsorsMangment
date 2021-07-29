<?php

namespace App\Http\Controllers\Admin;

use App\Models\enterpriseSponsor as EnterPrise;

use App\Http\Controllers\Controller;
use App\Http\Middleware\EnterpriseSponsor;
use Illuminate\Http\Request;


class enterpriseSponsorController extends Controller
{

    public function __construct()
    {
        $this->middleware('admin');

    }

    public function index()
    {


        $enterpriseSponors = EnterPrise::get();

        return response()->json([
            'status' => 1,
            'massage' => 'Show is Successfully',
            'data' => $enterpriseSponors

        ]);

    }

    public function show($id)
    {

        $enterpriseSponor = EnterpriseSponsor::find($id);
        return response()->json([
            'status' => 1,
            'massage' => 'Show is Successfully',
            'data' => $enterpriseSponor

        ]);
    }

    public function store(Request $request)
    {

    }

    public function search(Request $request)
    {


    }

}
