# UNKSO Game Stats Tracker API

- All Games
    - [Upload Player Stats](#upload-player-stats)
- BF1
    - [Latest Stats](#bf1-latest-stats)
- BF4
    - [Latest Stats](#bf4-latest-stats)
- R6 Siege
    - [Latest Stats](#r6siege-latest-stats)


<a id="upload-player-stats"></a>
### POST /stats

##### Request

```json
{
  "event": "ibcc",
  "players": [
    {
      "player": "mparsons",
      "games": {
        "bf1": {
          "general": {
            "id": 1,
            "accuracy": 0.16848986432890461,
            "headshots": 2055,
            "heals": 6436,
            "kill_assists": 1068,
            "kills": 28666,
            "deaths": 0,
            "ptfo": 3350810,
            "repairs": 218,
            "resupplies": 2210,
            "rounds_played": 1376,
            "squad_score": 1835650,
            "suppression_assists": 2149,
            "wins": 786,
            "revives": 100,
            "time_played": 100,
            "teamwork_index": 100,
            "ptfo_index": 100,
            "is_clan_member": 100,
            "flags_captured": 100,
            "flags_defended": 100,
            "bombs_placed": 100,
            "bombs_defused": 100,
            "orders_completed": 100,
            "region": 1,
            "created_at": "2018-02-25 02:20:24",
            "updated_at": "2018-02-25 02:20:24"
          },
          "kits": [
            {
              "name": "scout",
              "score": 100,
              "time": 100,
              "spm": 100
            }
          ],
          "weapons": [
            {
              "name": "Hellriegel 1915 Factory",
              "kills": 100,
              "hk": 9.76,
              "shots": 1,
              "hits": 1,
              "accuracy": 1
            }
          ]
        },
        "siege": {
          "general": {
            "score": 123,
            "rounds_played": 1850,
            "reinforcements": 6762,
            "barricades": 2245,
            "kill_assists": 2106,
            "gadgets": 4629,
            "melee_kills": 33,
            "penetration_kills": 395,
            "revives": 282,
            "dbno": 2007,
            "wins": 1103,
            "kills": 4337
          },
          "operators": [
            {
              "name": "Buck",
              "kills": 100,
              "hk": 9.76,
              "shots": 1,
              "hits": 1,
              "accuracy": 1,
              "special_name_1": "Kills with shotgun",
              "special_value_1": 80,
              "special_name_2": "",
              "special_value_2": "",
              "special_name_3": "",
              "special_value_3": ""
            }
          ]
        }
      }
    }
  ]
}
```

##### Response

```json
{
  "success": true
}
```


<a id="bf1-latest-stats"></a>
### Latest BF1 stats: GET /stats/bf1/latest
Retrieves the most recent stats entries for BF1.

| Parameter | Type   | Description                                                                                                |
|-----------|--------|------------------------------------------------------------------------------------------------------------|
| `events`  | array  | If defined, the latest stats will be collected only from given events.                                     |
| `players` | array` | Default: `all players`. If defined, the API will only return stats belonging to the given list of players. |

##### Response

```json
{
    "mparsons": {
        "general": [
            {
                "id": 1,
                "accuracy": 0.16848986432890461,
                "headshots": 2055,
                "heals": 6436,
                "kill_assists": 1068,
                "kills": 28666,
                "deaths": 0,
                "ptfo": 3350810,
                "repairs": 218,
                "resupplies": 2210,
                "rounds_played": 1376,
                "squad_score": 1835650,
                "suppression_assists": 2149,
                "wins": 786,
                "revives": 100,
                "time_played": 100,
                "teamwork_index": 100,
                "ptfo_index": 100,
                "is_clan_member": 100,
                "flags_captured": 100,
                "flags_defended": 100,
                "bombs_placed": 100,
                "bombs_defused": 100,
                "orders_completed": 100,
                "region": 1,
                "created_at": "2018-02-25 02:20:24",
                "updated_at": "2018-02-25 02:20:24"
            }
        ],
        "kits": [
            {
                "id": 1,
                "name": "scout",
                "score": 100,
                "time": 100,
                "spm": 100,
                "created_at": "2018-02-25 02:20:24",
                "updated_at": "2018-02-25 02:20:24"
            }
        ],
        "weapons": [
            {
                "id": 1,
                "name": "Hellriegel 1915 Factory",
                "kills": 100,
                "shots": 1,
                "hits": 1,
                "accuracy": 1,
                "created_at": "2018-02-25 02:20:24",
                "updated_at": "2018-02-25 02:20:24"
            }
        ]
    }
}
```

<a id="bf4-latest-stats"></a>
### Latest BF4 stats: GET /stats/bf4/latest
Retrieves the most recent stats entries BF4.

| Parameter | Type   | Description                                                                                                |
|-----------|--------|------------------------------------------------------------------------------------------------------------|
| `events`  | array  | If defined, the latest stats will be collected only from given events.                                     |
| `players` | array` | Default: `all players`. If defined, the API will only return stats belonging to the given list of players. |

##### Response
Same response as the [BF1 latest stats](#bf1-latest-stats) endpoint.

<a id="r6siege-latest-stats"></a>
### Latest Siege stats: GET /stats/r6siege/latest
Retrieves the most recent stats entries R6 Siege.

| Parameter | Type   | Description                                                                                                |
|-----------|--------|------------------------------------------------------------------------------------------------------------|
| `events`  | array  | If defined, the latest stats will be collected only from given events.                                     |
| `players` | array` | Default: `all players`. If defined, the API will only return stats belonging to the given list of players. |

##### Response

```json
{
    "mparsons": {
        "general": {
          "id": 1,
          "score": 123,
          "rounds_played": 1850,
          "reinforcements": 6762,
          "barricades": 2245,
          "kill_assists": 2106,
          "gadgets": 4629,
          "melee_kills": 33,
          "penetration_kills": 395,
          "revives": 282,
          "dbno": 2007,
          "wins": 1103,
          "kills": 4337,
          "created_at": "2018-02-28 04:14:36",
          "updated_at": "2018-02-28 04:33:53"
        },
        "operators": [
            {
                "id": 1,
                "name": "Buck",
                "kills": 100,
                "hk": 9.76,
                "shots": 1,
                "hits": 1,
                "accuracy": 1,
                "special_name_1": "",
                "special_value_1": 0,
                "special_name_2": "",
                "special_value_2": 0,
                "special_name_3": "",
                "special_value_3": 0,
                "created_at": "2018-02-25 02:20:24",
                "updated_at": "2018-02-25 02:20:24"
            }
        ]
    }
}
```