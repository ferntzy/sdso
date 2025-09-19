<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
  protected $table = 'user'; // since your table name is not "users"
  protected $primaryKey = 'user_id';
  public $timestamps = true; // because you have created_at / updated_at

  protected $fillable = [
    'email',
    'password',
    'account_role',
  ];

  protected $hidden = [
    'password',
  ];
}
