<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Model;

class Pair extends Model
{
    protected $table = "pairs";
    protected $primaryKey = "id";
    protected $fillable = ["id", "user_id","repeat","days","hour","route_id"];

}
