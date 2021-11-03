<?php
session_start();

// seesion to store information
// store an array, push, pop, slice.

// echo "beginning of script";
// echo "<br >";

$action = $_GET["action"];
echo "<prev>" . print_r($action,1) . "</prev>";
if($action != ""){
    switch ($action) {
  case "create":
  createHero($_Get["name"], $_GET["tagline"]);
   break;
  case "read":
    readAllHeros();
    break;
  case "update":
    echo "updating a hero";
    break;
    case "update":
    echo "updating a hero";
    break;
  default:
    init();
}
}
connectToMySQL();
readAllHeros();
function init(){
    $_SESSION ["heros"] = [];

}


// Create
function createHero ($name, $tagline){
//  push to the hero array
echo "<h1>Create</h1><prev>" . print_r([$name, $tagline],1) . "</prev>";
}

// Read
function readAllHeros(){
    // output heros from the array
    echo "<h1>READ</h1><prev>" . print_r($_SESSION ["heros"], 1) . "</prev>";

}

function updateHero($name, $tagline){

}

function deleteHero($name){

}

// echo "end of script";

function createNewDatabase(){
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";
}
