<?php

namespace App\Http\Controllers\Operations;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Operations\Dinamics;
use App\Models\Operations\DinamicsDetail;
use App\Models\Administration\Parameters;
use DB;

class DinamicController extends Controller {

    public function __construct() {
        $this->middleware("auth");
    }

    public function index() {
        $parameters = Parameters::where("group", "type_form")->get();
        return view("Operations.dinamic.init", compact("parameters"));
    }

    public function store(Request $request) {
        if ($request->ajax()) {
            $input = $request->all();
            unset($input["id"]);
//            $user = Auth::User();
//            $input["users_id"] = 1;

            $result = Dinamics::create($input)->id;
            if ($result) {
                $header = Dinamics::Find($result);
                return response()->json(['success' => true, "header" => $header]);
            } else {
                return response()->json(['success' => false]);
            }
        }
    }

    public function storeDetail(Request $request) {
        if ($request->ajax()) {
            $input = $request->all();
            unset($input["id"]);
//            $user = Auth::User();
//            $input["users_id"] = 1;

            $result = DinamicsDetail::create($input)->id;
            if ($result) {
                $detail = DinamicsDetail::select("dinamics_detail.id", "dinamics_detail.label_field", "dinamics_detail.name_field"
                                        , "dinamics_detail.placeholder_field", "parameters.description as type_form")
                                ->join("parameters", "parameters.code", DB::raw("dinamics_detail.type_form_id"))->where("dinamic_id", $input["dinamic_id"])->get();
                return response()->json(['success' => true, "detail" => $detail]);
            } else {
                return response()->json(['success' => false]);
            }
        }
    }

    public function edit($id) {
        $record = Dinamics::Find($id);
        $detail = DinamicsDetail::select("dinamics_detail.id", "dinamics_detail.label_field", "dinamics_detail.name_field"
                                , "dinamics_detail.placeholder_field", "parameters.description as type_form")
                        ->join("parameters", "parameters.code", DB::raw("dinamics_detail.type_form_id"))->where("dinamic_id", $record->id)->get();
        return response()->json(["header" => $record, "detail" => $detail]);
    }

    public function editDetail($id) {
        $detail = DinamicsDetail::find($id);
        return response()->json($detail);
    }

    public function update(Request $request, $id) {
        $record = Dinamics::Find($id);
        $input = $request->all();
        $result = $record->fill($input)->save();
        if ($result) {

            $data = Email::Find($id);
            return response()->json(['success' => true, "data" => $data]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function updateDetail(Request $request, $id) {
        $input = $request->all();
        $record = DinamicsDetail::Find($id);
        $input = $request->all();
        $result = $record->fill($input)->save();
        if ($result) {
            $data = DinamicsDetail::where("dinamic_id", $input["dinamic_id"])->get();
            return response()->json(['success' => true, "detail" => $data]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function destroy($id) {
        $record = Dinamics::Find($id);
        $result = $record->delete();

        if ($result) {
            return response()->json(['success' => true]);
        } else {
            return response()->json(['success' => false]);
        }
    }

    public function destroyDetail(Request $req, $id) {
        $input = $req->all();
        $record = DinamicsDetail::Find($id);
        $result = $record->delete();

        if ($result) {
            $data = DinamicsDetail::where("dinamic_id", $input["dinamic_id"])->get();
            return response()->json(['success' => true, "detail" => $data]);
        } else {
            return response()->json(['success' => false]);
        }
    }

}
