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

    const COUNT_JUNGLERS = 2;

    protected $enemyJungler;

    public function index(Request $request)
    {
        $picks = $request->toArray();

        // todo: add enemy jungler option
        foreach ($picks as $key => $pick)
        {
            if ($pick === '' OR $pick === 'me')
            {
                continue;
            }

            if (str_contains($key, 'ally'))
            {
                $allies[] = Champion::find($pick);
            }
            else
            {
                if ($key === 'jungler')
                {
                    $enemyKey = $pick - 1;
                    $this->enemyJungler = $enemies[$enemyKey]->jungler;
                    unset($enemies[$enemyKey]);
                }
                else
                {
                    $enemies[] = Champion::find($pick);
                }
            }
        }


        $scoreList = $this->calculation($allies, $enemies);

        $scoreList = collect($scoreList)->sortByDesc('score');

        return view('result')
            ->with('scoreList', $scoreList);
    }

    /**
     * @param $allies
     * @param $enemies
     */
    private function calculation($allies = array(), $enemies = array())
    {
        $scoreList = [];

        foreach (Jungler::all() as $jungler) {

            // default
            $allyGankabilityTotal = 0;
            $enemyGankabilityTotal = 0;

            // Multiplier defaults
            $vsEnemyJunglePassivityMultiplier = 1;
            $vsEnemyJungleActivityMultiplier = 1;
            $vsEnemyJunglePredatoryMultiplier = 1;

            //todo: this calculation should be fine, but test it
            if (!empty($this->enemyJungler))
            {

                // activity beats passivity
                // passivity beats predatory
                // predatory beats activity
                $vsEnemyJunglePassivityMultiplier += 0.5 * ($jungler->pre_6_passivity <=> $this->enemyJungler->pre_6_activity);
                $vsEnemyJungleActivityMultiplier += 0.5 * ($jungler->pre_6_activity <=> $this->enemyJungler->pre_6_predatory);
                $vsEnemyJunglePredatoryMultiplier += 0.5 * ($jungler->pre_6_predatory <=> $this->enemyJungler->pre_6_passivity);
            }

            //todo: something is off about this calculation..
            //todo: divide by zero error is possible when not entering in any allies/enemies
            foreach ($allies as $ally)
            {
                $allyGankabilityTotal += $ally->pre_6_gankability ?? 2;
            }

            $alliesGankabilityMultiplier = 0.5 + ($allyGankabilityTotal / (count($allies) * 4));

            foreach ($enemies as $enemy)
            {
                $enemyGankabilityTotal += $enemy->pre_6_gankability ?? 2;
            }

            $enemiesGankabilityMultiplier = 0.5 + ($enemyGankabilityTotal / (count($enemies) * 4));

            $passivityScore = ($jungler->pre_6_passivity * $vsEnemyJunglePassivityMultiplier);
            $activityScore = ($jungler->pre_6_activity * $vsEnemyJungleActivityMultiplier) * $enemiesGankabilityMultiplier;
            $predatoryScore = ($jungler->pre_6_predatory * $vsEnemyJunglePredatoryMultiplier) * $alliesGankabilityMultiplier;

            $pickScore = $passivityScore + $activityScore + $predatoryScore;

            $scoreListEntry = [
                'score' => $pickScore,
                'name' => $jungler->name,
                'passivityScore' => $passivityScore . '(' . $jungler->pre_6_passivity . '*' . $vsEnemyJunglePassivityMultiplier. ')',
                'activityScore' => $activityScore .  '(' . $jungler->pre_6_activity . '*' . $vsEnemyJungleActivityMultiplier . '*' . $enemiesGankabilityMultiplier . ')',
                'predatoryScore' => $predatoryScore .  '(' . $jungler->pre_6_predatory . '*' . $vsEnemyJunglePredatoryMultiplier . '*' . $alliesGankabilityMultiplier . ')'
            ];

            $scoreList[] = $scoreListEntry;
        }

        return $scoreList;
    }
}