<?php

namespace App\Models\Administration;

use Illuminate\Database\Eloquent\Model;

class EmailsDetail extends Model {

    protected $table = "emails_detail";
    protected $primaryKey = "id";
    protected $fillable = ["id", "email_id", "description"];

}
