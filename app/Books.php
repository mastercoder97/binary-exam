<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    protected $table = 'tbl_books';

    protected $primaryKey = 'book_id'; 

}