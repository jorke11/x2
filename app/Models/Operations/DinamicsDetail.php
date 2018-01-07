<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Model;

class DinamicsDetail extends Model {

    protected $table = "dinamics_detail";
    protected $primaryKey = "id";
    protected $fillable = ["id", "dinamic_id", "label_field","name_field","placeholder_field","type_form_id","data"];

}
