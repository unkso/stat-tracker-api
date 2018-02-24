<?php

namespace App\Http\Controllers\concerns;

use Illuminate\Database\DatabaseManager;

class BfStatsHelper
{
    use EntityPersisterTrait;

    const GAME_BF1 = "bf1";
    const GAME_BF4 = "bf4";

    /** @var DatabaseManager */
    private $db;

    /** @var array */
    private static $playerFields = [
        "game",
        "event",
        "kills",
        "deaths"
    ];

    /** @var array */
    private static $kitFields = [
        "game",
        "event",
        "name",
        "score",
        "time",
        "spm"
    ];

    /** @var array */
    private static $weaponFields = [
        "game",
        "event",
        "name",
        "kills",
        "shots",
        "hits",
        "accuracy"
    ];

    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    /**
     * @param $eventKey
     * @param $game
     * @param array $stats
     */
    public function saveStats($eventKey, $game, array $stats) {
        if (!empty($stats['general'])) {
            foreach($stats['general'] as $generalStats) {
                $generalStats['game'] = $game;
                $generalStats['event'] = $eventKey;
                $this->insertGeneralStats($generalStats);
            }
        }

        if (!empty($stats['kits'])) {
            foreach($stats['kits'] as $kitStats) {
                $generalStats['game'] = $game;
                $generalStats['event'] = $eventKey;
                $this->insertKitStats($kitStats);
            }
        }

        if (!empty($stats['weapons'])) {
            foreach($stats['weapons'] as $weaponStats) {
                $generalStats['game'] = $game;
                $generalStats['event'] = $eventKey;
                $this->insertWeaponStats($weaponStats);
            }
        }
    }

    public function insertGeneralStats(array $stats) {
        $record = $this->buildRecordFromArray(self::$playerFields, $stats);
        return $this->db->table('bf_general_stats_log')->insert($record);
    }

    public function insertKitStats(array $stats) {
        $record = $this->buildRecordFromArray(self::$kitFields, $stats);
        return $this->db->table('bf_kit_stats_log')->insert($record);
    }

    public function insertWeaponStats(array $stats) {
        $record = $this->buildRecordFromArray(self::$weaponFields, $stats);
        return $this->db->table('bf_weapon_stats_log')->insert($record);
    }
}