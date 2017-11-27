<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Model;

class Routes extends Model {

    protected $table = "routes";
    protected $primaryKey = "id";
    protected $fillable = ["id", "description","user_id"];

}
