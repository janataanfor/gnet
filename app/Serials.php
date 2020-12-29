<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Category;

class Serials extends Model
{
    
    public function category(){
        return $this->belongsTo(Category::Class);
    }
}
