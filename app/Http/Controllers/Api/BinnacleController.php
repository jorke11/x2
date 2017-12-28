<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operations\PairDetail;
use Auth;

class BinnacleController extends Controller {

    public function setReport(Request $req) {
        return response()->json($req->all());
    }

    public function setReportGPS(Request $req) {
        $in = $req->all();
        $new["pair_id"] = 2;
        $new["latitude"] = $in["latitude"];
        $new["longitude"] = $in["longitude"];
        $new["report"] = date("Y-m-d H:i");
        $new["uinsert"] = 1;
        $new["img"] = "";
        PairDetail::create($new);

        return response()->json($in);
    }

}
