<?php

include './sportTypeApi.php';
include './configdb.php';




try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    // print_r($allLeagues['leagues']);



    foreach ($allsports['sports'] as $sport) {

        $sql = " INSERT INTO  sportstypes
 ( id_sport,str_sport,str_format,str_sport_img,str_sport_description)
 VALUES (:idSport,:strSport,:strFormat,:strSportThumb,:strSportDescription )";





    $query = $conn->prepare($sql);
    $query->bindValue(':id_sport', $sport['idSport']);
    $query->bindValue(':str_sport', $sport['strSport']);
    $query->bindValue(':str_format', $sport['strFormat']);
    $query->bindValue(':str_sport_img', $sport['strSportThumb']);
    $query->bindValue(':str_sport_description', $sport['strSportDescription']);

    $query->execute($sport);

    if ($query) {
        echo 'Registro Inseridos com Sucesso!<br>';
    }
}
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
