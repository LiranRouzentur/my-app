<?php

include './leaguesApi.php';
include './configdb.php';




try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // print_r($allLeagues['leagues']);



    foreach ($allLeagues['leagues'] as $league) {

        $sql = " INSERT INTO  sportsleague
 ( id_league,str_league,str_sport,str_league_alternate)
 VALUES (:idLeague,:strLeague,:strSport,:strLeagueAlternate )";




    $query = $conn->prepare($sql);
    $query->bindValue(':id_league', $league['idLeague']);
    $query->bindValue(':str_league', $league['strLeague']);
    $query->bindValue(':str_sport', $league['strSport']);
    $query->bindValue(':str_league_alternate', $league['strLeagueAlternate']);

    $query->execute($league);

    if ($query) {
        echo 'Registro Inseridos com Sucesso!<br>';
    }
}
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
