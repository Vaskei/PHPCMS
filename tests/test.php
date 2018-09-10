<?php include "includes/db.php"; ?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">

    <title>Hello, world!</title>
</head>

<body>
    <h1>Hello, world!</h1>

    <?php 
    
    $sql = "SELECT * FROM posts";
    $result = mysqli_query($db, $sql);
    $queryResult = mysqli_num_rows($result);

    if ($queryResult > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "<div>
                ".$row['post_title']."
            </div>";
        }
    }
    
    ?>

    <form action="" method="POST">
        <input type="text" name="search" placeholder="search">

        <button type="submit" name="submit-search">GO</button>
    </form>

    <?php 
    
    if (isset($_POST['submit-search'])) {
        $search = mysqli_real_escape_string($db, $_POST['search']);
        echo "trazio si " . $search;
    }
    
    ?>

    <?php 

    $query = "SELECT * FROM categories";
    $rezultat = $db->query($query);

    if ($rezultat) {
        $polje = array();
        while ($row = $rezultat->fetch_assoc()) {
            $polje[] = $row;
        }
        //print_r($polje);
        echo "<br>";
      //print_r(array_chunk($polje, ceil(count($polje) / 2)));
        $podjela = array_chunk($polje, ceil(count($polje) / 2));
        //print_r($podjela);
    }

    ?>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>
</body>

</html>