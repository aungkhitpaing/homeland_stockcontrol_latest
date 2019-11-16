<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payable extends Model
{
    //
    public function payable_details() {
        return $this->hasMany('App\PayableDetail');
    }
}
