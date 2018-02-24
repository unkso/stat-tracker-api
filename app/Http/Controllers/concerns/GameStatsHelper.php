<?php

namespace App\Http\Controllers\concerns;

use Illuminate\Database\DatabaseManager;

class GameStatsHelper
{
    /** @var DatabaseManager */
    private $db;

    /** @var BfStatsHelper */
    private $bfStatsHelper;

    /** @var R6SiegeStatsHelper */
    private $siegeStatsHelper;

    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
        $this->bfStatsHelper = new BfStatsHelper($db);
        $this->siegeStatsHelper = new R6SiegeStatsHelper($db);
    }

    /**
     * @param $eventKey
     * @param array $playersStats
     * @throws \Exception
     */
    public function saveAllPlayerStats ($eventKey, array $playersStats) {
        foreach ($playersStats as $player) {
            $this->saveSinglePlayerStats($eventKey, $player);
        }
    }

    /**
     * @param $eventKey
     * @param array $player
     * @throws \Exception
     */
    public function saveSinglePlayerStats ($eventKey, array $player) {
        try {
            $this->db->beginTransaction();
            if (!empty($player["games"]["bf1"])) {
                $this->bfStatsHelper->saveStats($eventKey, BfStatsHelper::GAME_BF1, $player["games"]["bf1"]);
            }

            if (!empty($player["games"]["bf4"])) {
                $this->bfStatsHelper->saveStats($eventKey, BfStatsHelper::GAME_BF4, $player["games"]["bf4"]);
            }

            if (!empty($player["games"]['siege'])) {
                $this->siegeStatsHelper->saveStats($eventKey, $player["games"]["siege"]);
            }

            $this->db->commit();
        } catch (\Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}