<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pincode extends Model
{
    protected $table = "pincodes";
    protected $guarded = ['id'];
}
