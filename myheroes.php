<!-- * connect to database
* switch for a route
* run a crud function
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
function createHero($name, $about_me, $biography){

print_r($_GET);
  $SQL =   "INSERT INTO heroes( name, about_me, biography)
     VALUES ('$name', '$about_me, '$biography' )";
     echo $SQL;

}

//echo "<pre>" . print_r($action, 1) . "</pre>";

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {

        case "create":
        echo "hey create";
            createHero($name, $about_me, $biography);
            break;
        case "read":
            //readAllHeroes();
            break;
        case "update":
            //updateHero($_GET["id"], $_GET["name"], $_GET["tagline"]);
            break;
        case "delete":
            //deleteHero($_GET["id"]);
            break;
        default:
        
           // init();
        }
    }
