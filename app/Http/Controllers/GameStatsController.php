<?php

namespace App\Http\Controllers;

use App\Http\Controllers\concerns\GameStatsHelper;
use Illuminate\Database\DatabaseManager;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GameStatsController extends Controller
{
    /** @var GameStatsHelper */
    private $gameStatsHelper;

    public function __construct(DatabaseManager $db)
    {
        $this->gameStatsHelper = new GameStatsHelper($db);
    }

    public function uploadStats(Request $request) {
        $eventKey = $request->input('event');
        $playersData = $request->input('players');

        if (empty($eventKey)) {
            return new Response(["error" => 'Parameter "event" is missing.'], 400);
        }

        if (empty($playersData)) {
            return new Response(["error" => 'Parameter "players" is missing.'], 400);
        }

        try {
            $this->gameStatsHelper->saveAllPlayerStats($eventKey, $playersData);

            return new Response(["success" => true], 200);
        } catch (\Exception $e) {
            return new Response(["error" => "Operation failed: {$e->getMessage()}"], 500);
        }
    }

    public function getStats(Request $request) {
        $gameFilters = $request->input("games");
        $eventFilters = $request->input("events");
        $playerFilters = $request->input("players");
    }
}