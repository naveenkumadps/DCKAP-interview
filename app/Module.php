<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    protected $fillable = ['name','parent_id','created_by'];
    //
 // One level child
    public function childs() {
        return $this->hasMany(Module::class,'parent_id','id') ;
    }


    // Recursive children
    public function children() {
        return $this->hasMany(Module::class, 'parent_id','id')
          			->with('childs');
    }

    
}
