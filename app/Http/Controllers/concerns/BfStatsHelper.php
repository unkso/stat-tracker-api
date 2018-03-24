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
    private static $generalFields = [
        "game",
        "event",
        "player_id",
        "accuracy",
        "headshots",
        "heals",
        "killassists",
        "kills",
        "deaths",
        "ptfo",
        "repairs",
        "resupplies",
        "roundsplayed",
        "squadscore",
        "suppressionassists",
        "wins",
        "revives",
        "time_played",
        "teamwork_index",
        "ptfo_index",
        "is_clan_member",
        "flags_captured",
        "flags_defended",
        "bombs_placed",
        "bombs_defused",
        "orders_completed"
    ];

    /** @var array */
    private static $kitFields = [
        "game",
        "event",
        "player_id",
        "name",
        "score",
        "time",
        "spm"
    ];

    /** @var array */
    private static $weaponFields = [
        "game",
        "event",
        "player_id",
        "player_id",
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
     * @param $playerId
     * @param $game
     * @param array $stats
     */
    public function saveStats($eventKey, $playerId, $game, array $stats) {
        if (!empty($stats["general"])) {
            $stats["general"]["game"] = $game;
            $stats["general"]["event"] = $eventKey;
            $stats["general"]["player_id"] = $playerId;
            $this->insertGeneralStats($stats["general"]);
        }

        if (!empty($stats["kits"])) {
            foreach($stats["kits"] as $kitStats) {
                $kitStats["game"] = $game;
                $kitStats["event"] = $eventKey;
                $kitStats["player_id"] = $playerId;
                $this->insertKitStats($kitStats);
            }
        }

        if (!empty($stats["weapons"])) {
            foreach($stats["weapons"] as $weaponStats) {
                $weaponStats["game"] = $game;
                $weaponStats["event"] = $eventKey;
                $weaponStats["player_id"] = $playerId;
                $this->insertWeaponStats($weaponStats);
            }
        }
    }

    public function insertGeneralStats(array $stats) {
        $record = $this->buildRecordFromArray(self::$generalFields, $stats);
        return $this->db->table("bf_general_stats_log")->insert($record);
    }

    public function insertKitStats(array $stats) {
        $record = $this->buildRecordFromArray(self::$kitFields, $stats);
        return $this->db->table("bf_kit_stats_log")->insert($record);
    }

    public function insertWeaponStats(array $stats) {
        $record = $this->buildRecordFromArray(self::$weaponFields, $stats);
        return $this->db->table("bf_weapon_stats_log")->insert($record);
    }

    public function findLatestStats(array $gameFilters, array $eventFilters, array $playerFilters) {
        return [
            "general" => $this->findLatestGeneralStats($gameFilters, $eventFilters, $playerFilters),
            "kits" => $this->findLatestKitStats($gameFilters, $eventFilters, $playerFilters),
            "weapons" => $this->findLatestWeaponStats($gameFilters, $eventFilters, $playerFilters)
        ];
    }

    public function findLatestGeneralStats(array $gameFilters, array $eventFilters, array $playerFilters) {
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

        $query = $this->db->table('bf_general_stats_log AS bf')
            ->select(['bf.*', 'players.gamertag as gamertag'])
            ->join('players', 'players.id', '=', 'bf.player_id')
            ->whereRaw("bf.created_at IN (
              SELECT MAX(created_at)
              FROM bf_general_stats_log
              WHERE bf.player_id = player_id {$whereStmt}
            )", $whereParams);

        return $query->get()->toArray();
    }

    public function findLatestKitStats(array $gameFilters, array $eventFilters, array $playerFilters) {
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

        $query = $this->db->table('bf_kit_stats_log AS bf')
            ->select(['bf.*', 'players.gamertag as gamertag'])
            ->join('players', 'players.id', '=', 'bf.player_id')
            ->whereRaw("
                bf.created_at IN (
                  SELECT MAX(created_at)
                  FROM bf_kit_stats_log
                  WHERE bf.player_id = player_id AND bf.name = name {$whereStmt}
                  GROUP BY name
                )
            ", $whereParams);

        return $query->get()->toArray();
    }

    public function findLatestWeaponStats(array $gameFilters, array $eventFilters, array $playerFilters) {
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

        $query = $this->db->table('bf_weapon_stats_log AS bf')
            ->select(['bf.*', 'players.gamertag as gamertag'])
            ->join('players', 'players.id', '=', 'bf.player_id')
            ->whereRaw("
                bf.created_at IN (
                  SELECT MAX(created_at)
                  FROM bf_weapon_stats_log
                  WHERE bf.player_id = player_id AND bf.name = name {$whereStmt}
                  GROUP BY name
                )
            ", $whereParams);

        return $query->get()->toArray();
    }
}