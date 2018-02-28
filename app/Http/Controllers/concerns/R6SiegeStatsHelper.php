<?php

namespace App\Http\Controllers\concerns;

use Illuminate\Database\DatabaseManager;

class R6SiegeStatsHelper
{
    use EntityPersisterTrait;

    const GAME_R6_SIEGE = "r6_siege";

    /** @var DatabaseManager */
    private $db;

    /** @var array */
    private static $generalFields = [
        "event",
        "player_id",
        "score",
        "roundsplayed",
        "reinforcements",
        "barricades",
        "killassists",
        "gadgets",
        "meleekills",
        "penetrationkills",
        "revives",
        "dbno",
        "wins",
        "kills",
        "special_name_1",
        "special_value_1",
        "special_name_2",
        "special_value_2",
        "special_name_3",
        "special_value_3"
    ];

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

    public function saveStats($eventKey, $playerId, array $stats) {
        if (!empty($stats["general"])) {
            $stats["general"]["event"] = $eventKey;
            $stats["general"]["player_id"] = $playerId;
            $this->insertGeneralStats($stats["general"]);
        }

        if (!empty($stats["operators"])) {
            foreach($stats["operators"] as $operatorStats) {
                $operatorStats["event"] = $eventKey;
                $operatorStats["player_id"] = $playerId;
                $this->insertOperatorStats($operatorStats);
            }
        }
    }

    public function insertGeneralStats(array $stats) {
        $record = $this->buildRecordFromArray(self::$generalFields, $stats);
        return $this->db->table("siege_general_stats_log")->insert($record);
    }

    public function insertOperatorStats(array $stats) {
        $record = $this->buildRecordFromArray(self::$operatorFields, $stats);
        return $this->db->table("siege_operator_stats_log")->insert($record);
    }

    public function findLatestStats(array $eventFilters, array $playerFilters) {
        return [
            "general" => $this->findLatestGeneralStats($eventFilters, $playerFilters),
            "operator" => $this->findLatestOperatorStats($eventFilters, $playerFilters),
        ];
    }

    public function findLatestGeneralStats(array $eventFilters, array $playerFilters) {
        $query = $this->db->table('siege_general_stats_log')
            ->select(['siege_general_stats_log.*', 'players.gamertag as gamertag'])
            ->join('players', 'players.id', '=', 'siege_general_stats_log.player_id')
            ->orderBy('siege_general_stats_log.created_at', 'desc')
            ->groupBy(['players.id']);

        if (!empty($eventFilters)) {
            $query->whereIn('event', $eventFilters);
        }

        if (!empty($playerFilters)) {
            $query->whereIn('players.gamertag', $playerFilters);
        }

        return $query->get()->toArray();
    }

    public function findLatestOperatorStats(array $eventFilters, array $playerFilters) {
        $query = $this->db->table('siege_operator_stats_log')
            ->select(['siege_operator_stats_log.*', 'players.gamertag as gamertag'])
            ->join('players', 'players.id', '=', 'siege_operator_stats_log.player_id')
            ->orderBy('siege_operator_stats_log.created_at', 'desc')
            ->groupBy(['players.id', 'siege_operator_stats_log.name']);

        if (!empty($eventFilters)) {
            $query->whereIn('event', $eventFilters);
        }

        if (!empty($playerFilters)) {
            $query->whereIn('player_id', $playerFilters);
        }

        return $query->get()->toArray();
    }
}