<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Activity;
use App\Http\Requests\ActivityRequest;

class ActivityController extends Controller
{
    public function getActivity()
    {
        $activity = Activity::all();

        return response()->json([
            'code' => 200,
            'status' => 'OK',
            'data' => $activity
        ], 200);
    }
}
