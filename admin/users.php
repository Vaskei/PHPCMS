<?php require_once "includes/admin_db.php"; ?>
<?php $title = "Admin - Korisnici"; ?>
<?php require_once "includes/admin_header.php"; ?>

<!-- Navigation -->
<?php require_once "includes/admin_navigation.php"; ?>

<!-- Page Content -->
<div class="container-fluid h-100">
    <div class="row h-100">
        <?php require_once "includes/admin_sidebar.php"; ?>
        <main class="col bg-faded py-3">
            <h2>
                Korisnici
                <?php
                if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>                                             
            </h2>

            <hr>

            <!-- Ispis korisnika u tablicu -->
            <div class="row">
                <div class="col-12">
                    <table class="table table-sm table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nadimak</th>
                                <th>Korisničko ime</th>
                                <th>Vrsta profila</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT user_id, user_username, user_nickname, user_role FROM users";
                            $rezultat = $db->query($query);
                            if ($rezultat) {
                                while ($redak = $rezultat->fetch_assoc()) {
                                    //var_dump($redak);
                                    $user_id = $redak['user_id'];
                                    $user_username = $redak['user_username'];
                                    $user_nickname = $redak['user_nickname'];
                                    $user_role = $redak['user_role'];
                                    
                                    echo "<tr>";
                                    echo "<td>$user_id</td>";
                                    echo "<td>$user_username</td>";
                                    echo "<td>$user_nickname</td>";
                                    echo "<td>$user_role</td>";
                                    echo "<tr>";
                                }
                            }
                            ?>
                        </tbody>                     
                    </table>           
                </div>
            </div>
            <!-- Ispis korisnika u tablicu -->

        </main>
    </div>
</div>



<?php require_once "includes/admin_footer.php"; ?>