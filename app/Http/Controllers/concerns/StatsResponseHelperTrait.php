<?php

namespace App\Http\Controllers\concerns;

trait StatsResponseHelperTrait
{
    public abstract function clean(array $stats);

    public function mapStatTypeToPlayer($type, array $stats, array $response = [], $mapFirstAsObject = false) {
        foreach($stats[$type] as $stat) {
            $stat = (array)$stat;
            $gamerTag = $stat["gamertag"];

            if (!array_key_exists($stat["gamertag"], $response)) {
                $response[$gamerTag] = [];
            }

            if (!array_key_exists($type, $response[$stat["gamertag"]])) {
                $response[$gamerTag][$type] = [];
            }

            if ($mapFirstAsObject) {
                $response[$gamerTag][$type] = $this->clean($stat);
            } else {
                $response[$gamerTag][$type][] = $this->clean($stat);
            }
        }

        return $response;
    }

    public function movePlayerToObject(array $stats) {
        $result = [
            "players" => []
        ];

        foreach($stats as $gamertag => $records) {
            $records["player"] = $gamertag;
            $result["players"][] = $records;
        }

        return $result;
    }
}