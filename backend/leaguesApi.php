<?php

$result = file_get_contents('https://www.thesportsdb.com/api/v1/json/1/all_leagues.php');

$allLeagues = json_decode($result, true);
  