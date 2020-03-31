<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    //
    protected $guarded = array('id');
    
    public static $rules = array(
        'title' => 'required',
        'deadline' => 'required',
        'person' => 'required',
        'deadline' => 'after:yesterday',
    );
    
    public function histories() {
        return $this->hasMany('App\History');
    }
}
