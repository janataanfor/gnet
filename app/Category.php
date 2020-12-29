<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Serials;

class Category extends Model
{
    protected $fillable = [
        'number',
    ];
    
    public function serials(){
        return $this->hasMany(Serials::Class);
    }
}
