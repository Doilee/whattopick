<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jungler extends Model
{
    protected $table = 'junglers';

    protected $foreignKey = 'champion_id';
}
