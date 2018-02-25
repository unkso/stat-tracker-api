<?php

namespace App\Http\Controllers\concerns;

use Illuminate\Database\DatabaseManager;

class PlayersHelper
{
    /** @var DatabaseManager */
    private $db;

    public function __construct(DatabaseManager $db)
    {
        $this->db = $db;
    }

    public function findOrCreate($gamerTag) {
        $player = $this->findPlayer($gamerTag);

        if (!empty($player)) {
            return (array)$player;
        }

        $this->db->table('players')->insert([
            "gamertag" => $gamerTag
        ]);

        return (array)$this->findPlayer($gamerTag);
    }

    public function findPlayer ($gamerTag) {
        return $this->db->table('players')
                ->select(['*'])
                ->from('players')
                ->where('gamertag', '=', $gamerTag)
                ->first();
    }
}