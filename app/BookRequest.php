<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookRequest extends Model
{
    protected $table = 'tbl_requests';

    protected $primaryKey = 'request_id'; 


    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'user_id');
    }

    public function approved(){
        return $this->belongsTo('App\User', 'approved_by', 'user_id');
    }

    public function book(){
        return $this->belongsTo('App\Books', 'book_id', 'book_id');
    }

}