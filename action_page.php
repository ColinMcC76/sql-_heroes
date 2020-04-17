
    <?php
    $hero_id = $_GET['id'];
    $method = $_GET['method'];
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "superheroes";


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // $sql = 'SELECT * FROM abilities';

    if ($method == 'add_ability') {
        $val = $_POST['ability'];
        // echo $value;
        $sql = "INSERT INTO abilities (ability) VALUES ('$val')";
        $conn->query($sql);
        $sql = "SELECT * FROM abilities WHERE ability = '$val'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $ability_id = $row['id'];
        $sql = "INSERT INTO ability_hero (hero_id, ability_id) VALUES ('$hero_id','$ability_id')";
        $conn->query($sql);
        header("Location: ./user.php?id=$hero_id");
    }
    if ($method == 'change_story') {
        $val=$_POST['biography'];
        // echo $val;
        // $sql = "INSERT INTO abilities (ability) VALUES ('$val')";
        $sql = "UPDATE heroes SET biography='$val' WHERE id=$hero_id";
        $conn->query($sql);
        header("Location: ./user.php?id=$hero_id");
    }
    if ($method == 'delete_ability') {

        // echo 'delete';
        $ability= $_GET['ability'];
        // echo $ability;
        $sql= "DELETE FROM ability_hero WHERE ability_id='$ability'";
        $conn->query($sql);
        $sql= "DELETE FROM abilities WHERE id='$ability'";
        $conn->query($sql);
        header("Location: ./user.php?id=$hero_id");
        



        // $sql = "INSERT INTO abilities (ability) VALUES ('$val')";
        // $sql = "UPDATE heroes SET biography='$val' WHERE id=$hero_id";
        // $conn->query($sql);
        // header("Location: ./user.php?id=$hero_id");
    }
    ?>