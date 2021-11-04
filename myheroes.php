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
//echo "Connected successfully";
function createHero($name, $about_me, $biography){
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "Heroes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);}

  print_r($_POST);
    $SQL =   "INSERT INTO heroes ( name, about_me, biography)
       VALUES ('$name', '$about_me', '$biography' )";
       echo $SQL;
    if ($conn->query($SQL) === TRUE) {
            echo "New Hero created successfully";
            echo '<br>';
        }
        else {
            echo "Error: " . $SQL . "<br>" . $conn->error;
        }
        mysqli_close($conn);

   

}



// Read
function readHero(){
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "Heroes";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// $conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT name, about_me, biography FROM heroes";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
  // output data of each row
  while($row = mysqli_fetch_assoc($result)) {
    echo "Name " . $row["name"]. "  " . $row["about_me"]. " " . $row["biography"]. "<br>";
  }
} else {
  echo "0 results";
}

mysqli_close($conn);

   

}
function updateHero($id, $name, $about_me, $biography){
    //
    //array_splice($_SESSION["heroes"],$index,1,[[$name, $tagline]]);
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
    
    $sql = "UPDATE heroes SET about_me='$about_me', name='$name', biography='$biography' WHERE heroes.id=$id";
    
    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $conn->close();

}

function deleteHero($id){
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

    // sql to delete a record
    $sql = "DELETE FROM heroes WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
    echo "Record deleted successfully";
    } else {
    echo "Error deleting record: " . $conn->error;
    }
}

// Create connection

// Check connection







//echo "<pre>" . print_r($action, 1) . "</pre>";

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {

        case "create":
            // conn
            // check isset($_GET['name']);
            if(isset($_GET["name"])){
                $name = $_GET["name"];

            }
            if(isset($_GET["about_me"])){
                $about_me = $_GET["about_me"];
            }
            if(isset($_GET["biography"])){
                $biography  = $_GET["biography"];
            }
            
            //echo "hey create";
            createHero($name, $about_me, $biography);
            break;
        case "read":
            readHero();
            break;
        case "update":
        // updateHero($id, $name, $tagline);
            updateHero($_POST["id"], $_POST["name"], $_POST["about_me"], $_POST["biography"]);
            break;
        case "delete":
            deleteHero($_GET["id"]);
            break;
        default:
        
           // init();
        }
    }
