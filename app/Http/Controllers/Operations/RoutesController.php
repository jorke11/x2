<?php

namespace App\Http\Controllers\Operations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operations\Routes;
use App\Models\Operations\Points;

class RoutesController extends Controller {

    public function index() {
        return view("Operations.routes.init", compact("role"));
    }

    public function edit($id) {
        $data = Routes::find($id);
        $points = Points::where("route_id",$id)->get();

        return response()->json(["data" => $data, "points" => $points]);
    }

}
