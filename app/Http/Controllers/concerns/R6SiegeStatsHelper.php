<?php

namespace App\Http\Controllers\concerns;

use Illuminate\Database\DatabaseManager;

class R6SiegeStatsHelper
{
    use EntityPersisterTrait;

    /** @var DatabaseManager */
    private $db;

    /** @var array */
    private static $operatorFields = [
        "event",
        "player_id",
        "name",
        "kills",
        "hk",
        "shots",
        "hits",
        "accuracy",
        "special_name_1",
        "special_value_1",
        "special_name_2",
        "special_value_2",
        "special_name_3",
        "special_value_3"
    ];

    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    /**
     * @param $eventKey
     * @param $playerId
     * @param array $stats
     */
    public function saveStats($eventKey, $playerId, array $stats) {
        if (!empty($stats["operators"])) {
            foreach($stats["operators"] as $operatorStats) {
                $operatorStats["event"] = $eventKey;
                $operatorStats["player_id"] = $playerId;
                $this->insertOperatorStats($operatorStats);
            }
        }
    }

    public function insertOperatorStats(array $stats) {
        $record = $this->buildRecordFromArray(self::$operatorFields, $stats);
        return $this->db->table("siege_operator_stats_log")->insert($record);
    }
}