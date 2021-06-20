<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{

    use SoftDeletes;

    protected $fillable = ['name','module_id','file','summary','created_by'];
    //

    public function task()
    {
        return $this->belongsTo('Module');
    }


}
