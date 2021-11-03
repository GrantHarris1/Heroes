<!-- * connect to database
* switch for a route
* run a crude function
    * inside crude function check for errors
    * access database for the crude function RUN A MYSQL QUERRY
    * inside function return result of querry
* echo data to api of postman
* close connection -->
<?php
$servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Heroes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
echo "Connected successfully";

$action = $_GET["action"];

//echo "<pre>" . print_r($action, 1) . "</pre>";

if($action != ""){
    switch ($action) {
        case "create":
            createHero($_GET["name"], $_GET["tagline"]);
            break;
        case "read":
            //readAllHeroes();
            break;
        case "update":
            updateHero($_GET["id"], $_GET["name"], $_GET["tagline"]);
            break;
        case "delete":
            deleteHero($_GET["id"]);
            break;
        default:
        
            init();
        }
    }
