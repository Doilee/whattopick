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


        // todo: make error messages work
        if (empty($this->enemyJungler))
        {
            return redirect()->back()->withErrors([
                'main' => 'Please choose an enemy jungler.'
            ]);
        }

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
            ->with('scoreList', $scoreList)
            ->with('champions', Champion::all()->sortBy('name'));
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

            if (!empty($this->enemyJungler))
            {
                // activity > passivity | passivity > predatory | predatory > activity
                $jungler->vsEnemyJungleMultipliers['passivity'] += 0.25 * ($jungler->pre_6_passivity <=> $this->enemyJungler->pre_6_activity);
                $jungler->vsEnemyJungleMultipliers['activity'] += 0.25 * ($jungler->pre_6_activity <=> $this->enemyJungler->pre_6_predatory);
                $jungler->vsEnemyJungleMultipliers['predatory'] += 0.25 * ($jungler->pre_6_predatory <=> $this->enemyJungler->pre_6_passivity);
            }

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

            $scores = [
                'passive' => ($jungler->pre_6_passivity * $jungler->vsEnemyJungleMultipliers['passivity']),
                'active' => ($jungler->pre_6_activity * $jungler->vsEnemyJungleMultipliers['activity']) * $enemiesGankabilityMultiplier,
                'aggressive' => ($jungler->pre_6_predatory * $jungler->vsEnemyJungleMultipliers['predatory']) * $alliesGankabilityMultiplier
            ];

            $pickScore = array_sum($scores);

            $advice = array_keys($scores, max($scores));

            $scoreListEntry = [
                'name' => $jungler->name,
                'score' => $pickScore,
                'passivityScore' => $scores['passive'] . '(' . $jungler->pre_6_passivity . '*' . $jungler->vsEnemyJungleMultipliers['passivity']. ')',
                'activityScore' => $scores['active'] .  '(' . $jungler->pre_6_activity . '*' . $jungler->vsEnemyJungleMultipliers['activity'] . '*' . $enemiesGankabilityMultiplier . ')',
                'predatoryScore' => $scores['aggressive'] .  '(' . $jungler->pre_6_predatory . '*' . $jungler->vsEnemyJungleMultipliers['predatory'] . '*' . $alliesGankabilityMultiplier . ')',
                'advice' => 'Play ' . join(' and/or ', $advice)
            ];

            $scoreList->push($scoreListEntry);
        }

        return $scoreList->sortByDesc('score');
    }
}