<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    //
    protected $table = 'admins';

    //Primary key
    public $primaryKey = 'id';

    //TimeStamp
    public $timestamps = true;
}
