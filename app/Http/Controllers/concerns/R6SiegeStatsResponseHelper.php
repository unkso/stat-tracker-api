<?php
namespace App\Http\Controllers\concerns;

class R6SiegeStatsResponseHelper
{
    public function mapAllStatsToPlayers(array $operators, array $response = []) {
        foreach($operators as $operator) {
            $operator = (array)$operator;
            $gamerTag = $operator["gamertag"];

            if (!array_key_exists($operator["gamertag"], $response)) {
                $response[$gamerTag] = [];
            }

            if (!array_key_exists("operators", $response[$operator["gamertag"]])) {
                $response[$gamerTag]["operators"] = [];
            }

            $response[$gamerTag]["operators"][] = $this->clean($operator);
        }

        return $response;
    }

    public function clean(array $record) {
        unset($record["gamertag"]);
        unset($record["player_id"]);
        unset($record["event"]);

        return $record;
    }
}