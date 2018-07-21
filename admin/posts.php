<?php require_once "includes/admin_db.php"; ?>
<?php $title = "Admin - Članci"; ?>
<?php require_once "includes/admin_header.php"; ?>

<!-- Navigation -->
<?php require_once "includes/admin_navigation.php"; ?>

<!-- Page Content -->
<div class="container-fluid h-100">
    <div class="row h-100">
        <?php require_once "includes/admin_sidebar.php"; ?>
        <main class="col bg-faded py-3">
            <h2>Članci</h2>
            <hr>

            <!-- Ispis članaka u tablicu -->
            <div class="row">
                <div class="col-12">
                    <table class="table table-sm table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Autor</th>
                                <th>Naslov</th>
                                <th>Kategorija</th>
                                <th>Slika</th>
                                <th>Komentari</th>
                                <th>Tagovi</th>
                                <th>Datum</th>
                                <th>Opcije</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = "SELECT * FROM posts LEFT JOIN categories ON posts.post_category_id=categories.cat_id";
                            $rezultat = $db->query($query);
                            if ($rezultat) {
                                while ($redak = $rezultat->fetch_assoc()) {
                                    //var_dump($redak);
                                    $post_id = $redak['post_id'];
                                    $post_author = $redak['post_author'];
                                    $post_title = $redak['post_title'];
                                    $post_category_id = $redak['post_category_id'];
                                    $cat_title = $redak['cat_title'];
                                    $post_image = $redak['post_image'];
                                    $post_comment_count = $redak['post_comment_count'];
                                    $post_tags = $redak['post_tags'];
                                    $post_date = $redak['post_date'];
                                    
                                    echo "<tr>";
                                    echo "<td>$post_id</td>";
                                    echo "<td>$post_author</td>";
                                    echo "<td>$post_title</td>";
                                    echo "<td>$post_category_id" . " - " . "$cat_title</td>";
                                    echo "<td><img width='100' src='../images/$post_image' alt='image'> </td>";
                                    echo "<td>$post_comment_count</td>";
                                    echo "<td>$post_tags</td>";
                                    echo "<td>$post_date</td>";
                                    echo "<td>
                                        <div class='btn-group' role='group' aria-label='Button group'>
                                            <a class='btn btn-info gumb_kategorija' role='button' href='edit_post.php?edit=" . $redak['post_id'] . "'>Uredi</a>
                                            <a class='btn btn-danger gumb_kategorija' role='button' href='posts.php?delete=" . $redak['post_id'] . "'>Obriši</a>
                                        </div>  
                                    </td>";
                                    echo "<tr>";
                                }
                            }
                            ?>
                        </tbody>                     
                    </table>           
                </div>
            </div>
            <!-- Ispis članaka u tablicu -->

        </main>
    </div>
</div>

<?php require_once "includes/admin_footer.php"; ?>