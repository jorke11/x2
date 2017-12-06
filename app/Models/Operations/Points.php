<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Model;

class Points extends Model
{
    protected $table = "points";
    protected $primaryKey = "id";
    protected $fillable = ["id", "route_id","name","address","latitude","longitude","uinsert"];
}
