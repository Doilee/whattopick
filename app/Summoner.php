<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Summoner extends Model
{
    protected $fillable = [
        'id',
        'account_id',
        'name',
        'soloq_wins',
        'soloq_losses',
        'soloq_league',
        'soloq_division',
        'soloq_lp',
    ];
}
