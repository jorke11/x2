<?php

namespace App\Models\Operations;

use Illuminate\Database\Eloquent\Model;

class PairDetail extends Model
{
    protected $table = "pair_detail";
    protected $primaryKey = "id";
    protected $fillable = ["id", "pair_id","report","latitude","longitude","img","uinsert"];

}
