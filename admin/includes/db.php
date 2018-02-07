<?php 

$db=new MySQLi('localhost', 'root', '1111', 'phpcms');
if ($db->connect_error) {
        echo '<div class="alert alert-danger">
        <strong>Nije se moguće spojiti na bazu podataka</strong> </div>';
        exit();
}
$db->set_charset('utf8mb4');

?>