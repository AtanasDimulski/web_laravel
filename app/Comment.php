<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //

    protected $table = 'comments';

    //Primary key
    public $primaryKey = 'id';

    //TimeStamp
    public $timestamps = true;


    //Relation between user and comment
    public function user(){
        return $this->belongsTo('App\User');
    }
}
