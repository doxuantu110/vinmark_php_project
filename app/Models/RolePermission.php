<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RolePermission extends Model
{
    protected $fillable = ['role_id', 'permission_id'];

    public function roles()
    {
        return $this->belongsTo(Role::class);
    }
    public function permissions(){
        return $this->belongsTo(Permission::class);
    }
}
