<?php

namespace App\Models\Security;

use Illuminate\Database\Eloquent\Model;

class PermissionUsers extends Model {

    protected $table = "permissions_user";
    protected $primaryKey = "id";
    protected $fillable = ["id", "users_id", "permission_id"];

}
