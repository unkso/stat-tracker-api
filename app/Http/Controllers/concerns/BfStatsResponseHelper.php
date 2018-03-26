<?php

namespace App\Http\Controllers\concerns;

class BfStatsResponseHelper
{
    use StatsResponseHelperTrait;

    public function mapAllStatsToPlayers(array $stats, array $response = []) {
        if (!empty($stats["general"])) {
            $response = $this->mapStatTypeToPlayer("general", $stats, $response, true);
        }

        if (!empty($stats["kits"])) {
            $response = $this->mapStatTypeToPlayer("kits", $stats, $response);
        }

        if (!empty($stats["weapons"])) {
            $response = $this->mapStatTypeToPlayer("weapons", $stats, $response);
        }

        return $this->movePlayerToObject($response);
    }

    public function clean(array $record) {
        unset($record["gamertag"]);
        unset($record["player_id"]);
        unset($record["event"]);
        unset($record["game"]);

        return $record;
    }
}