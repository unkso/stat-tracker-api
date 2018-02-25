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

    /** @var PlayersHelper */
    private $playersHelper;

    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
        $this->bfStatsHelper = new BfStatsHelper($db);
        $this->siegeStatsHelper = new R6SiegeStatsHelper($db);
        $this->playersHelper = new PlayersHelper($db);
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
     * @param array $playerStats
     * @throws \Exception
     */
    public function saveSinglePlayerStats ($eventKey, array $playerStats) {
        try {
            $player = $this->playersHelper->findOrCreate($playerStats["player"]);

            $this->db->beginTransaction();
            if (!empty($playerStats["games"]["bf1"])) {
                $this->bfStatsHelper->saveStats($eventKey, $player["id"], BfStatsHelper::GAME_BF1, $playerStats["games"]["bf1"]);
            }

            if (!empty($playerStats["games"]["bf4"])) {
                $this->bfStatsHelper->saveStats($eventKey, $player["id"], BfStatsHelper::GAME_BF4, $playerStats["games"]["bf4"]);
            }

            if (!empty($playerStats["games"]['siege'])) {
                $this->siegeStatsHelper->saveStats($eventKey, $player["id"], $playerStats["games"]["siege"]);
            }

            $this->db->commit();
        } catch (\Exception $e) {
            $this->db->rollBack();
            throw $e;
        }
    }
}