<?php 

$db=new MySQLi('localhost', 'root', '1111', 'phpcms');
if ($db->connect_error) {
        echo '<div class="alert alert-danger">
        <strong>Nije se moguće spojiti na bazu podataka</strong> </div>';
        exit();
}
$db->set_charset('utf8mb4');

?>

<?php 
    
    if (isset($_POST['submit-search']) && $_POST['search'] != "") {
        $search = mysqli_real_escape_string($db, $_POST['search']);
        echo "trazio si " . $search;
    } else {
        echo "nisi nist napisao";
    }
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="" method="POST">
        <input type="text" name="search" placeholder="search">

        <button type="submit" name="submit-search">GO</button>
    </form>
</body>
</html>