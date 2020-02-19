<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once './config/database.php';
include_once './objects/Leagues.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$leagues = new Leagues($db);
// $sports = new Sports($db);

// query products
$stmt = $leagues->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {


  $leagues_arr = array();
  $leagues_arr["Leagues"] = array();


  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    extract($row);


    $leagues_item = array(
      "id_league" => $row['id_league'],
      "str_league" => $row['str_league'],
      "str_sport" => $row['str_sport'],
      "str_league_alternate" => $row['str_league_alternate']

    );

    array_push($leagues_arr["Leagues"], $leagues_item);
  }

  // set response code - 200 OK
  http_response_code(200);

  // show products data in json format
  echo json_encode($leagues_arr["Leagues"]);
} else {

  // set response code - 404 Not found
  http_response_code(404);

  // tell the user no products found
  echo json_encode(
    array("message" => "No leagues found.")
  );
}
?>