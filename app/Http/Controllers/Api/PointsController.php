<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operations\Points;
use App\Models\Operations\Pair;
use Auth;
use File;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class PointsController extends Controller {

    public function newPoint(Request $req) {
        $in = $req->all();

        $data = Points::where("route_id", $in["id"])->get();
        foreach ($data as $val) {
            Points::deleted($val->id);
        }

        foreach ($in["pointers"] as $val) {
            $new["uinsert"] = Auth::user()->id;
            $new["route_id"] = $in["id"];
            $new["name"] = $val["name"];
            $new["address"] = $val["address"];
            $new["latitude"] = $val["latitude"];
            $new["longitude"] = $val["longitude"];
            $id = Points::create($new)->id;
            $pathdb = url("/qr/" . $in["id"] . "/" . $id . "/point.png");
            $path = public_path() . "/qr/" . $in["id"] . "/" . $id;
            File::makeDirectory($path, 0777, true, true);
            $path.="/point.png";
            QrCode::format("png")->size(100)->generate("route::" . $in["id"] . "-point::" . $id, $path);
            $row = Points::find($id);
            $row->qr = $pathdb;
            $row->save();
        }

        $data = Points::where("route_id", $in["id"])->get();
        return response()->json($data);
    }

    public function getPoints($id) {
        $data = Points::where("route_id", $id)->get();
        return response()->json($data);
    }

    public function pairRoute(Request $req) {
        $in = $req->all();
        $in["days"] = json_encode(array(1, 2));
        $data = Pair::create($in);
        return response()->json($data);
    }

}
