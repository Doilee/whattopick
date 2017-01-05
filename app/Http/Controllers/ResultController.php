<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Champion;
use App\Jungler;

class ResultController extends Controller
{
    const BLUESIDE = [
        1, 4, 5, 8, 9
    ];

    const REDSIDE = [
        2, 3, 6, 7, 10
    ];

    protected $playerSide;

    protected $scoreList;

    public function index(Request $request)
    {
        $picks = $request->toArray();

        foreach ($picks as $order => $pick)
        {

            $pickSide = in_array($order, self::BLUESIDE) ? 'blue' : 'red';

            if ($pick == 'me') {
                $this->playerSide = $pickSide;
                break;
            }

            $pick = (int) $pick;

//            todo: this shizzle
//            if ($this->playerSide == $pickSide);

            $enemyLaners[] = Champion::find((int) $pick);
            $allyLaners[] = Champion::find((int) $pick);
        }

        $junglers = Jungler::all();

        foreach ($junglers as $jungler)
        {
            $pickScore = ($jungler->pre_6_passivity + $jungler->pre_6_activity + $jungler->pre_6_predatory);

            $scoreListEntry = [$pickScore, $jungler->name];
            $this->scoreList[] = $scoreListEntry;
        }

        var_dump($this->scoreList);

        return view('result')
            ->with('scoreList', $this->scoreList);
    }
}
