<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Champion extends Model
{
    protected $table = 'champions';

    public $incrementing = false;

    public function jungler()
    {
        return $this->hasOne(Champion::class);
    }
}
