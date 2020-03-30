<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class bookuser extends Model
{
    public $primaryKey="u_id";
    protected $table = 'book_user';
    protected $guarded = [];
    public $timestamps = false;
}
