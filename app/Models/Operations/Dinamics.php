<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Model;

class Dinamics extends Model
{
    protected $table = "dinamics";
    protected $primaryKey = "id";
    protected $fillable = ["id", "description"];
}
