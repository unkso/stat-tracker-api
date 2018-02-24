<?php

namespace App\Http\Controllers;

use App\Http\Controllers\concerns\GameStatsHelper;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GameStatsController extends Controller
{
    /** @var GameStatsHelper */
    private $gameStatsHelper;

    public function __construct()
    {
        $this->gameStatsHelper = new GameStatsHelper();
    }

    public function uploadStats(Request $request) {
        $eventKey = $request->input('event');
        $playerData = $request->input('players');

        if (empty($eventKey)) {
            return new Response(["error" => 'Parameter "event" is missing.'], 400);
        }

        if (empty($playerData)) {
            return new Response(["error" => 'Parameter "players" is missing.'], 400);
        }

        $this->gameStatsHelper->saveAllStats($eventKey, $playerData);

        return [

        ];
    }
}