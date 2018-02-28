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
            "accuracy": 0.16848986432890461,
            "headshots": 2055.0,
            "heals": 6436.0,
            "killassists": 1068.0,
            "kills": 28666.0,
            "lastupdate": "Sat Feb 24 16:00:49 2018\n",
            "ptfo": 3350810.0,
            "repairs": 218.0,
            "resupplies": 2210.0,
            "revives": 1016.0,
            "roundsplayed": 1376.0,
            "squadscore": 1835650.0,
            "suppressionassists": 2149.0,
            "wins": 786.0
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
            "roundsplayed": 1850,
            "reinforcements": 6762,
            "barricades": 2245,
            "killassists": 2106,
            "gadgets": 4629,
            "meleekills": 33,
            "penetrationkills": 395,
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
              "special_value_1": "",
              "special_name_3": "",
              "special_value_1": ""
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
### GET /stats/bf1/latest
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
                "killassists": 1068,
                "kills": 28666,
                "deaths": 0,
                "ptfo": 3350810,
                "repairs": 218,
                "resupplies": 2210,
                "roundsplayed": 1376,
                "squadscore": 1835650,
                "suppressionassists": 2149,
                "wins": 786,
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
### GET /stats/bf4/latest
Retrieves the most recent stats entries BF4.

| Parameter | Type   | Description                                                                                                |
|-----------|--------|------------------------------------------------------------------------------------------------------------|
| `events`  | array  | If defined, the latest stats will be collected only from given events.                                     |
| `players` | array` | Default: `all players`. If defined, the API will only return stats belonging to the given list of players. |

##### Response
Same response as the [BF1 latest stats](#bf1-latest-stats) endpoint.

<a id="r6siege-latest-stats"></a>
### GET /stats/r6siege/latest
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
          "roundsplayed": 1850,
          "reinforcements": 6762,
          "barricades": 2245,
          "killassists": 2106,
          "gadgets": 4629,
          "meleekills": 33,
          "penetrationkills": 395,
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