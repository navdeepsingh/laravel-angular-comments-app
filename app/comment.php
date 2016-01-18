<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    // let eloquent know that these attributes will be available for mass assignment protected $fillable = array('author', 'text'); }
    protected $fillable = array('author', 'text');
}
