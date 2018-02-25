<?php

namespace App\Http\Controllers;

use App\Http\Controllers\concerns\BfStatsHelper;
use App\Http\Controllers\concerns\BfStatsResponseHelper;
use App\Http\Controllers\concerns\R6SiegeStatsHelper;
use App\Http\Controllers\concerns\R6SiegeStatsResponseHelper;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class R6SiegeStatsController
{
    /** @var R6SiegeStatsHelper */
    private $siegeStatsHelper;

    /** @var R6SiegeStatsResponseHelper */
    private $siegeResponseHelper;

    public function __construct(DatabaseManager $db)
    {
        $this->siegeStatsHelper = new R6SiegeStatsHelper($db);
        $this->siegeResponseHelper = new R6SiegeStatsResponseHelper();
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

        $stats = $this->siegeStatsHelper->findLatestStats($eventFilters, $playerFilters);
        $response = $this->siegeResponseHelper->mapAllStatsToPlayers($stats);
        return new Response($response);
    }
}