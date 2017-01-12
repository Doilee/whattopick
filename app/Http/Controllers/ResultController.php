<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\Http\Request;
use App\Champion;
use App\Jungler;

/**
 * Class ResultController
 * @package App\Http\Controllers
 */
class ResultController extends Controller
{
    const BLUESIDE = [
        1, 4, 5, 8, 9
    ];

    const REDSIDE = [
        2, 3, 6, 7, 10
    ];

    /**
     * @var
     */
    protected $enemyJungler;

    /**
     * @param Request $request
     * @return View
     */
    public function index(Request $request)
    {

        $this->enemyJungler = Jungler::where('champion_id', $request->get('enemy-' . $request->get('jungler')))->first();

        $picks = collect($request->all())->reject(function ($pick){
            return empty($pick);
        });

        $allies = $picks->filter(function($pick, $key){
            return str_contains($key, 'ally');
        })->map(function($pick) {
            return Champion::find($pick);
        });

        $enemies = $picks->filter(function($pick, $key){
            // Also remove the jungler from the list so it doesn't get calculated
            return str_contains($key, 'enemy') AND $this->enemyJungler->champion_id != $pick;
        })->map(function($pick) {
            return Champion::find($pick);
        });

        $scoreList = $this->calculation($allies, $enemies);

        return view('result')
            ->with('scoreList', $scoreList);
    }

    /**
     * @param Collection $allies
     * @param Collection $enemies
     * @return Collection Scorelist
     */
    private function calculation(Collection $allies, Collection $enemies)
    {
        $scoreList = new Collection();

        foreach (Jungler::all() as $jungler) {

            // default
            $allyGankabilityTotal = 0;
            $enemyGankabilityTotal = 0;

            //todo: this calculation should be fine, but test it
            if (!empty($this->enemyJungler))
            {
                // activity beats passivity
                // passivity beats predatory
                // predatory beats activity
                $jungler->vsEnemyJungleMultipliers['passivity'] += 0.5 * ($jungler->pre_6_passivity <=> $this->enemyJungler->pre_6_activity);
                $jungler->vsEnemyJungleMultipliers['activity'] += 0.5 * ($jungler->pre_6_activity <=> $this->enemyJungler->pre_6_predatory);
                $jungler->vsEnemyJungleMultipliers['predatory'] += 0.5 * ($jungler->pre_6_predatory <=> $this->enemyJungler->pre_6_passivity);
            }

            //todo: something is off about this calculation..
            //todo: divide by zero error is possible when not entering in any allies/enemies
            $allies->each(function($ally) use (&$allyGankabilityTotal)
            {
                $allyGankabilityTotal += $ally->pre_6_gankability ?? 2;
            });

            $alliesGankabilityMultiplier = 0.5 + ($allyGankabilityTotal / (count($allies) * 4));

            $enemies->each(function($enemy) use (&$enemyGankabilityTotal)
            {
                $enemyGankabilityTotal += $enemy->pre_6_gankability ?? 2;
            });

            $enemiesGankabilityMultiplier = 0.5 + ($enemyGankabilityTotal / (count($enemies) * 4));

            $passivityScore = ($jungler->pre_6_passivity * $jungler->vsEnemyJungleMultipliers['passivity']);
            $activityScore = ($jungler->pre_6_activity * $jungler->vsEnemyJungleMultipliers['activity']) * $enemiesGankabilityMultiplier;
            $predatoryScore = ($jungler->pre_6_predatory * $jungler->vsEnemyJungleMultipliers['predatory']) * $alliesGankabilityMultiplier;

            $pickScore = $passivityScore + $activityScore + $predatoryScore;

            $scoreListEntry = [
                'score' => $pickScore,
                'name' => $jungler->name,
                'passivityScore' => $passivityScore . '(' . $jungler->pre_6_passivity . '*' . $jungler->vsEnemyJungleMultipliers['passivity']. ')',
                'activityScore' => $activityScore .  '(' . $jungler->pre_6_activity . '*' . $jungler->vsEnemyJungleMultipliers['activity'] . '*' . $enemiesGankabilityMultiplier . ')',
                'predatoryScore' => $predatoryScore .  '(' . $jungler->pre_6_predatory . '*' . $jungler->vsEnemyJungleMultipliers['predatory'] . '*' . $alliesGankabilityMultiplier . ')'
            ];

            $scoreList->push($scoreListEntry);
        }

        return $scoreList->sortByDesc('score');
    }
}