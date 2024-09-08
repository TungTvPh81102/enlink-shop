<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Ward;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function getDistricts(string $id)
    {
        $districts = District::query()->where('province_id', $id)->get();
        return response()->json([
            'status' => true,
            'data' => $districts
        ],200);
    }

    public function getWards(string $id)
    {
        $wards = Ward::query()->where('district_id', $id)->get();
        return response()->json([
            'status' => true,
            'data' => $wards
        ],200);
    }
}
