<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class Emails extends Model
{
     protected $table = "emails";
    protected $primaryKey = "id";
    protected $fillable = ["id", "description"];
}
