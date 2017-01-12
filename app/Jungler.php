<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jungler extends Model
{
    protected $table = 'junglers';

    protected $foreignKey = 'champion_id';

    public $vsEnemyJungleMultipliers = [
        'passivity' => 1,
        'activity' => 1,
        'predatory' => 1
    ];

    public function passivityScore()
    {

    }
}
