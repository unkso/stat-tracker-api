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
        "headshots"
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
            "operators" => $this->findLatestOperatorStats($eventFilters, $playerFilters),
        ];
    }

    public function findLatestGeneralStats(array $eventFilters, array $playerFilters) {
        $where = [];
        $whereParams = [];

        if (!empty($eventFilters)) {
            $where[] = 'AND event IN (:events)';
            $whereParams['events'] = $eventFilters;
        }

        if (!empty($playerFilters)) {
            $where[] = 'AND players.gamertag IN (:players)';
            $whereParams['players'] = $playerFilters;
        }

        $whereStmt = implode(' ', $where);

        $query = $this->db->table('siege_general_stats_log AS siege')
            ->select(['siege.*', 'players.gamertag as gamertag'])
            ->join('players', 'players.id', '=', 'siege.player_id')
            ->whereRaw("siege.created_at IN (
              SELECT MAX(created_at)
              FROM siege_general_stats_log
              WHERE siege.player_id = player_id {$whereStmt}
            )", $whereParams);

        return $query->get()->toArray();
    }

    public function findLatestOperatorStats(array $eventFilters, array $playerFilters) {
        $where = [];
        $whereParams = [];

        if (!empty($gameFilters)) {
            $where[] = 'AND game IN (:games)';
            $whereParams['games'] = $gameFilters;
        }

        if (!empty($eventFilters)) {
            $where[] = 'AND event IN (:events)';
            $whereParams['events'] = $eventFilters;
        }

        if (!empty($playerFilters)) {
            $where[] = 'AND players.gamertag IN (:players)';
            $whereParams['players'] = $playerFilters;
        }

        $whereStmt = implode(' ', $where);

        $query = $this->db->table('siege_operator_stats_log AS siege')
            ->select(['siege.*', 'players.gamertag as gamertag'])
            ->join('players', 'players.id', '=', 'siege.player_id')
            ->whereRaw("
                siege.created_at IN (
                  SELECT MAX(created_at)
                  FROM siege_operator_stats_log
                  WHERE siege.player_id = player_id AND siege.name = name {$whereStmt}
                  GROUP BY name
                )
            ", $whereParams);

        return $query->get()->toArray();
    }
}