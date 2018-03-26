<?php
namespace App\Http\Controllers\concerns;

class R6SiegeStatsResponseHelper
{
    use StatsResponseHelperTrait;

    public function mapAllStatsToPlayers(array $stats, array $response = []) {
        if (!empty($stats["general"])) {
            $response = $this->mapStatTypeToPlayer("general", $stats, $response, true);
        }

        if (!empty($stats["operators"])) {
            $response = $this->mapStatTypeToPlayer("operators", $stats, $response);
        }

        return $this->movePlayerToObject($response);
    }

    public function clean(array $record) {
        unset($record["gamertag"]);
        unset($record["player_id"]);
        unset($record["event"]);

        return $record;
    }
}