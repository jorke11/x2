<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class Deparments extends Model {

    protected $table = "departments";
    protected $primaryKey = "id";
    protected $fillable = ["id", "description", "code"];

}
