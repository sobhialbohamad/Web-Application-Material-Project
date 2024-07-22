<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminAlert extends Model
{
    // Fillable attributes for mass assignment
    protected $fillable = [
      'name',
      'email',
      'password',
      'group_id',
      'status'
  ];

    // Relationships, accessors, and other model methods can be defined here
}
