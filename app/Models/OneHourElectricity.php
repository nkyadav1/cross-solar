<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class OneHourElectricity extends Model
{
    protected $fillable = ['panel_id', 'kilowatts', 'hour'];

    public static $fieldValidations = [
        'panel_id'  => 'required',
        'kilowatts' => 'required',
        'hour'      => 'required|unique:one_hour_electricities,hour,NULL,panel_id'
    ];
    /**
     * retrieve agreegate values as per panel id
     * @param  $panel
     * @return array
     */
    public function getEveryDayAgreegates($panel){
        return self::select(DB::raw("SUM(kilowatts) as sum,MIN(kilowatts) as min,MAX(kilowatts) as max,AVG(kilowatts) as avg,DATE(`hour`) as date"))->where('panel_id', $panel->id)->where('hour', '<=', Carbon::today())->groupBy(DB::raw("DATE(`hour`)"))->get();
    }
}
