<?php ob_start(); ?>
<?php

session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] == "user") {
    header("Location: ../");
} elseif (!isset($_SESSION['id'])) {
    header("Location: ../");
}

function echoActiveClass($navItemUri)
{
    $current_file_name = basename($_SERVER['PHP_SELF'], ".php");
    if ($current_file_name == $navItemUri) echo "active";
} 
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- FontAwesome 4.7.0 -->
    <link rel="stylesheet" href="css/font-awesome.min.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/phpcms_admin.css">

    <title> <?php echo isset($title) ? $title : "Stranica"; ?> </title>

</head>

<body>