<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Champion extends Model
{
    protected $table = 'champions';

    protected $primaryKey = 'id';

    public $incrementing = false;

    public function jungler()
    {
        return $this->hasOne(Jungler::class, 'champion_id');
    }
}
