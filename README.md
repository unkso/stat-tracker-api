# UNKSO Game Stats Tracker API

- BF1
    - [Latest Stats](#bf1-latest-stats)
- BF4
    - [Latest Stats](#bf4-latest-stats)
- R6 Siege
    - [Latest Stats](#r6siege-latest-stats)

### /stats/bf1/latest
<a id="bf1-latest-stats"></a>
Retrieves the most recent stats entries for BF1.

| Parameter | Type   | Description                                                                                                |
|-----------|--------|------------------------------------------------------------------------------------------------------------|
| `events`  | array  | If defined, the latest stats will be collected only from given events.                                     |
| `players` | array` | Default: `all players`. If defined, the API will only return stats belonging to the given list of players. |

##### Response

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

### /stats/bf4/latest
<a id="bf4-latest-stats"></a>
Retrieves the most recent stats entries BF4.

| Parameter | Type   | Description                                                                                                |
|-----------|--------|------------------------------------------------------------------------------------------------------------|
| `events`  | array  | If defined, the latest stats will be collected only from given events.                                     |
| `players` | array` | Default: `all players`. If defined, the API will only return stats belonging to the given list of players. |

##### Response
Same response as the [BF1 latest stats](#bf1-latest-stats) endpoint.

### /stats/r6siege/latest
<a id="r6siege-latest-stats"></a>
Retrieves the most recent stats entries R6 Siege.

| Parameter | Type   | Description                                                                                                |
|-----------|--------|------------------------------------------------------------------------------------------------------------|
| `events`  | array  | If defined, the latest stats will be collected only from given events.                                     |
| `players` | array` | Default: `all players`. If defined, the API will only return stats belonging to the given list of players. |

##### Response

```json
{
    "mparsons": {
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
            },
            {
              "id": 2,
              "name": "ash",
              ...
            }
        ]
    },
    "JimAlmeida": {
      "operators": [...]
    }
}
```