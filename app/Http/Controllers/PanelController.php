<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Panel;

class PanelController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate(Panel::$fieldValidations);
        return Panel::create($request->all());
    }
}
