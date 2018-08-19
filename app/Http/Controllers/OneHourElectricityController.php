<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Validator;
use Illuminate\Support\Carbon;
use App\Models\OneHourElectricity;
use App\Models\Panel;

class OneHourElectricityController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, OneHourElectricity $oneHourElectricity) {
        $panel = Panel::where('serial', $request->panel_serial)->firstOrFail();
        //dd($panel);
        
        return $oneHourElectricity->getEveryDayAgreegates($panel);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $panel = Panel::where('serial', $request->panel_serial)->first();
        $params = $request->all();
        unset($params['panel_serial']);
        if ($panel) {
            $params['panel_id'] = $panel->id;
        }
        Validator::make($params, OneHourElectricity::$fieldValidations)->validate();

        return $panel->oneHourElectricities()->create($params);
    }

}
