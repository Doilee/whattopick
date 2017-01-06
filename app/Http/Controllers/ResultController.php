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

    protected $enemyJungler;

    public function index(Request $request)
    {
        $picks = $request->toArray();


        // todo: add enemy jungler option
        foreach ($picks as $key => $pick)
        {
            if ($pick === 'unknown' OR $pick === 'me')
            {
                continue;
            }

            if (str_contains($key, 'ally'))
            {
                $allyLaners[] = Champion::find($pick);
            }
            else
            {
                if ($key === 'jungler')
                {
                    $this->enemyJungler = Champion::find($pick)->jungler();
                }
                else
                {
                    $enemyLaners[] = Champion::find($pick);
                }
            }
        }

        $scoreList = $this->calculation($allyLaners, $enemyLaners);

        $scoreList = collect($scoreList)->sortByDesc('score');

        return view('result')
            ->with('scoreList', $scoreList);
    }

    /**
     * @param $allyLaners
     * @param $enemyLaners
     */
    private function calculation($allyLaners = array(), $enemyLaners = array())
    {
        $scoreList = [];

        foreach (Jungler::all() as $jungler) {

            // default todo: should change later
            $allyGankabilityMultiplier = 0;
            $enemyGankabilityMultiplier = 0;

            foreach ($allyLaners as $ally)
            {
                $allyGankabilityMultiplier += ($ally->pre_6_gankability ?? 2) / 4;
            }

            $alliesGankabilityMultiplier = 0.5 + ($allyGankabilityMultiplier / count($allyLaners));


            foreach ($enemyLaners as $enemyLaner)
            {
                $enemyGankabilityMultiplier = ($enemyLaner->pre_6_gankability ?? 2) / 4;
            }

            $enemiesGankabilityMultiplier = 0.5 + ($enemyGankabilityMultiplier / count($enemyLaners));

            $passivityScore = $jungler->pre_6_passivity;
            $activityScore = $jungler->pre_6_activity * $enemiesGankabilityMultiplier;
            $predatoryScore = $jungler->pre_6_predatory * $alliesGankabilityMultiplier;

            $pickScore = $passivityScore + $activityScore + $predatoryScore;

            $scoreListEntry = [
                'score' => $pickScore,
                'name' => $jungler->name
            ];

            $scoreList[] = $scoreListEntry;
        }

        return $scoreList;
    }
}

//            $pickSide = in_array($order, self::BLUESIDE) ? 'blue' : 'red';

//            if ($pick == 'me') {
//                $this->playerSide = $pickSide;
//                break;
//            }

//          $pick = (int) $pick;

//            todo: this shizzle
//            if ($this->playerSide == $pickSide);