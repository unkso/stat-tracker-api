<?php

namespace App\Http\Controllers\concerns;

class BfStatsResponseHelper
{
    public function mapAllStatsToPlayers(array $stats, array $response = []) {
        if (!empty($stats["general"])) {
            $response = $this->mapStatTypeToPlayer("general", $stats, $response);
        }

        if (!empty($stats["kits"])) {
            $response = $this->mapStatTypeToPlayer("kits", $stats, $response);
        }

        if (!empty($stats["weapons"])) {
            $response = $this->mapStatTypeToPlayer("weapons", $stats, $response);
        }

        return $response;
    }

    public function mapStatTypeToPlayer($type, array $stats, array $response = []) {
        foreach($stats[$type] as $stat) {
            $stat = (array)$stat;
            $gamerTag = $stat["gamertag"];

            if (!array_key_exists($stat["gamertag"], $response)) {
                $response[$gamerTag] = [];
            }

            if (!array_key_exists($type, $response[$stat["gamertag"]])) {
                $response[$gamerTag][$type] = [];
            }

            $response[$gamerTag][$type][] = $this->clean($stat);
        }

        return $response;
    }

    public function clean(array $record) {
        unset($record["gamertag"]);
        unset($record["player_id"]);
        unset($record["event"]);
        unset($record["game"]);

        return $record;
    }
}