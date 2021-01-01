<?php

namespace App;

use Laratrust\Models\LaratrustRole;

class Role extends LaratrustRole
{
    protected $fillable=['name'];

    public  function  scopeWhenSearch($query , $search)
    {
        return $query->when($search , function ($q) use ($search){
           return $q->where('name','like',"%$search%");
        });

    }

    // نفس الفنكشن ,بس لو بدم اردي يعني اكتر من رول
    public  function scopeWhereRoleNot($query , $role_name)
    {
        return $query->whereNotIn('name',(array)$role_name);
    }

//
//    public  function scopeWhereRoleNot2($query , $role_name)
//    {
//        return $query->where('name','!=',$role_name);
//    }
}
