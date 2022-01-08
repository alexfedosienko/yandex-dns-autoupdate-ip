<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Domain extends Model
{
  use HasFactory;
  protected $fillable = [
    'name',
    'key',
    'user_id',
    'subdomain_id',
    'subdomain_name',
    'ip',
    'ttl'
  ];
}
