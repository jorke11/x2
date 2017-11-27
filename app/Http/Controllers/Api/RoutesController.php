<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operations\Routes;
use App\Models\Operations\Pair;
use Auth;

class RoutesController extends Controller {

    public function newRoute(Request $req) {
        $in = $req->all();

        $in["user_id"] = Auth::user()->id;
        $res = Routes::create($in)->id;
        $data = Routes::where("user_id", $in["user_id"])->get();
        return response()->json($data);
    }
 
    public function getRoute() {
        $data = Routes::where("user_id", Auth::user()->id)->get();
        return response()->json($data);
    }
    public function getRoutesUser() {
        $data = Pair::select("pairs.id","routes.description","pairs.hour","pairs.route_id")->where("pairs.user_id", Auth::user()->id)
                ->join("routes","routes.id","pairs.route_id")
                ->get();
        
        return response()->json($data);
    }
    

}
