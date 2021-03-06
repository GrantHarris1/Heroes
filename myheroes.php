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



// CREATE
function createHero($name, $about_me, $biography)
{
    global $conn;

    print_r($_POST);
    $SQL =   "INSERT INTO heroes ( name, about_me, biography)
       VALUES ('$name', '$about_me', '$biography' )";
    echo $SQL;
    if ($conn->query($SQL) === TRUE) {
        echo "New Hero created successfully";
        echo '<br>';
    } else {
        echo "Error: " . $SQL . "<br>" . $conn->error;
    }
    mysqli_close($conn);
}



// READ
function readHero(){
   global $conn;

    $sql = "SELECT name, about_me, biography FROM heroes";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "NAME: " . $row["name"] . "<br>" . "  ABOUT_ME: " . $row["about_me"] . "<br>" . " BIOGRAPHY:" . $row["biography"] . "<br> <br>";
        }
    } else {
        echo "0 results";
    }

    mysqli_close($conn);
}

// UPDATE
function updateHero($id, $name, $about_me, $biography)
{
   
    global $conn;

    $sql = "UPDATE heroes SET about_me='$about_me', name='$name', biography='$biography' WHERE heroes.id=$id";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn->error;
    }
    $conn->close();
}


// DELETE
function deleteHero($id)
{
    global $conn;

    $sql = "DELETE FROM heroes WHERE id='$id'";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . $conn->error;
    }
}
// READALL
function heroData()
{
    global $conn;
    $SQL = "SELECT 
            heroes.name, 
            heroes.about_me, 
            GROUP_CONCAT(ability_type.ability SEPARATOR ', ') AS powers
            FROM heroes
            INNER JOIN abilities ON abilities.hero_id = heroes.id
            INNER JOIN ability_type ON ability_type.id = abilities.ability_id 
            GROUP BY heroes.name";

            // echo $SQL;

    $result = mysqli_query($conn, $SQL);
    // echo $result;

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo "NAME: " . $row["name"] . "<br>" . "  ABOUT_ME: " . $row["about_me"] . "<br>" . "  POWERS: " . $row["powers"] . "<br>" . "<br>";
        }
    } else {
        echo "0 results";
    }

    mysqli_close($conn);
}
// $WITCH
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {

        case "create":
            
            if (isset($_GET["name"])) {
                $name = $_GET["name"];
            }
            if (isset($_GET["about_me"])) {
                $about_me = $_GET["about_me"];
            }
            if (isset($_GET["biography"])) {
                $biography  = $_GET["biography"];
            }
            createHero($name, $about_me, $biography);
            break;
        case "read":
            readHero();
            break;
        case "update":
            updateHero($_POST["id"], $_POST["name"], $_POST["about_me"], $_POST["biography"]);
            break;
        case "delete":
            deleteHero($_GET["id"]);
            break;
        case "readAll":
            heroData();
            break;
        default:

            
    }
}
