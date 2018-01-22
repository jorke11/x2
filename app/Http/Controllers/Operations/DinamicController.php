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
        $data_types = Parameters::where("group", "type_data_input")->get();
        return view("Operations.dinamic.init", compact("parameters", "data_types"));
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
            $input["required_field"] = (isset($input["required_field"])) ? true : false;

            $result = DinamicsDetail::create($input)->id;
            if ($result) {
                $detail = $this->getDetail($input["dinamic_id"]);

                return response()->json(['success' => true, "detail" => $detail]);
            } else {
                return response()->json(['success' => false]);
            }
        }
    }

    public function getDetail($id) {
        
        return DinamicsDetail::select("dinamics_detail.id", "dinamics_detail.label_field", "dinamics_detail.name_field"
                                , "dinamics_detail.placeholder_field", "parameters.description as type_form","p.description as type_data_input","dinamics_detail.length_text",
                "dinamics_detail.required_field")
                        ->join("parameters", "parameters.code", DB::raw("dinamics_detail.type_form_id and parameters.group='type_form'"))
                        ->join("parameters as p", "p.code", DB::raw("dinamics_detail.type_form_id and p.group='type_data_input'"))
                        ->where("dinamic_id", $id)->get();
    }

    public function edit($id) {
        $record = Dinamics::Find($id);
        $detail = $this->getDetail($id);

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
