<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $uploads='/codehacking5.3/public/images/';
    //protected $uploads='/images/';




    protected $fillable = ['file'];





    public function getFileAttribute($photo){




        return $this->uploads . $photo;



    }




}
