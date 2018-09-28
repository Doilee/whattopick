<?php

namespace App\Console\Commands;

use App\Http\Middleware\RedirectIfAuthenticated;
use App\Summoner;
use Illuminate\Console\Command;
use App\Riot\RiotApi;

class GetLatestChallengers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get:challengers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Gets the latest list of 200 challengers and inserts them in the database';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $challengers = (new RiotApi)->challengers();

        $bar = $this->output->createProgressBar(count($challengers));

        foreach($challengers as $challenger) {

            $summoner = Summoner::find($challenger->playerOrTeamId);

            if (!$summoner) {
                $accountId = (new RiotApi)->getAccountId($challenger->playerOrTeamId);

                $summoner = new Summoner([
                    'id' => $challenger->playerOrTeamId,
                    'account_id' => $accountId,
                ]);
            }

            $cool = $summoner->fill([
                'name' => $challenger->playerOrTeamName,
                'soloq_wins' => $challenger->wins,
                'soloq_losses' => $challenger->losses,
                'soloq_league' => 'challenger',
                'soloq_division' => $challenger->rank,
                'soloq_lp' => $challenger->leaguePoints,
            ])->save();

            if($cool) $bar->advance();
        }

        $bar->finish();

        $this->line('Finished.');
    }
}
