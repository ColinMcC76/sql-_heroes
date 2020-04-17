<!doctype html>
<html lang="en">
<?php

?>

<head>
    <title>User</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <a class='btn btn-dark' href="index.php">Back</a>
    <?php
    $id = $_GET['id'];
    $servername = "localhost";
    $username = "root";
    $password = "root";
    $dbname = "superheroes";


    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT * FROM heroes WHERE id='$id'";
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $output =   "
                            <h5 class='text-center card-title'>$row[name]</h5>
                            <p class='text-center offset-2 col-8'>
                                <a class='btn btn-warning' href='story_form.php?id=$id'>Update Story</a><br>
                                $row[about_me]<br> 
                                $row[biography]                                   
                            </p>
                        ";
        echo $output;
    }
    // abilities
    $sql = " SELECT * FROM ability_hero
    INNER JOIN abilities 
    ON abilities.id=ability_id
    INNER JOIN heroes 
    ON heroes.id=hero_id
    WHERE hero_id=$id
    ";
    $setup =
        "<a class='offset-5 col-2 btn btn-dark' href='./abilityForm.php?id=$id'>add ability</a>
        <div class='d-flex justify-content-center text-center'>
            <h5>
                Abilities
            </h5>
        </div>";
    echo $setup;
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        // echo $row['id'];
        $output =   "
        <div class='d-flex justify-content-around'>
        $row[ability] <a id='$row[id]'class='btn btn-danger' href='action_page.php?method=delete_ability&&id=$id&&ability=$row[ability_id]'>X</a>           
        </div>
        ";
        echo $output;
    }
    // friends
    $sql = "SELECT * FROM relationships
    INNER JOIN heroes 
    ON heroes.id=hero2_id
    INNER JOIN relationship_types
    ON relationship_types.id=type_id
    WHERE hero1_id=$id and type_id=1";
    $result = $conn->query($sql);
    $setup =
        '<div class="d-flex justify-content-center text-center">
                <h5>
                    Friends
                </h5>
            </div>';
    echo $setup;
    while ($row = $result->fetch_assoc()) {
        $output =   "
        <div class='d-flex justify-content-center text-center'>
        $row[name]            
        </div>
        ";
        echo $output;
    }
    // enemies
    $sql = "SELECT * FROM relationships
    INNER JOIN heroes 
    ON heroes.id=hero2_id
    INNER JOIN relationship_types
    ON relationship_types.id=type_id
    WHERE hero1_id=$id and type_id=2";
    $setup =
        '<div class="d-flex justify-content-center text-center">
    <h5>
    Enemies
    </h5>
    </div>';
    echo $setup;
    $result = $conn->query($sql);
    while ($row = $result->fetch_assoc()) {
        $output =   "
            <div class='d-flex justify-content-center text-center'>
            $row[name]            
            </div>
            ";
        echo $output;
    }


    ?>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>
<!-- "<div id=$row[id] class=' offset-2 col-8 card'>
                        <div class='card-body'> -->