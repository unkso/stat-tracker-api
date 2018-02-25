<?php

namespace App\Http\Controllers;

use App\Http\Controllers\concerns\BfStatsHelper;
use App\Http\Controllers\concerns\BfStatsResponseHelper;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Bf1StatsController extends Controller
{
    /** @var BfStatsHelper */
    private $bfStatsHelper;

    /** @var BfStatsResponseHelper */
    private $bfStatsResponseHelper;

    public function __construct(DatabaseManager $db)
    {
        $this->bfStatsHelper = new BfStatsHelper($db);
        $this->bfStatsResponseHelper = new BfStatsResponseHelper();
    }

    public function getLatestStats(Request $request) {
        $eventFilters = $request->input("events");
        $playerFilters = $request->input("players");

        if (empty($eventFilters)) {
            $eventFilters = array();
        }

        if (empty($playerFilters)) {
            $playerFilters = array();
        }

        $stats = $this->bfStatsHelper->findLatestStats([BfStatsHelper::GAME_BF1], $eventFilters, $playerFilters);
        $response = $this->bfStatsResponseHelper->mapAllStatsToPlayers($stats);
        return new Response($response);
    }
}