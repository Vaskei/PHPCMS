<?php require_once "includes/db.php"; ?>
<?php $title = "Indeks"; ?>
<?php require_once "includes/header.php"; ?>

<?php

$query = "SELECT * FROM site_options";
$result = $db->query($query);
if ($result) {
    $row = $result->fetch_assoc();
    //var_dump($row);
    $siteTitle = trim(htmlentities($row['site_title']));
    $navbarTitle = trim(htmlentities($row['navbar_title']));
    $infoText = trim(htmlentities($row['info_text']));
}

?>

<!-- Navigation -->
<?php require_once "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container sadrzaj">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <!-- Ispisivanje poruke preko sesije -->
            <?php
            if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>

            <h1 class="my-4">
                <?php echo isset($siteTitle)&&!empty($siteTitle) ? $siteTitle : "Naslov stranice"; ?>
            </h1>

            <?php 

            if (isset($_GET['cat']) && !empty($_GET['cat'])) {
                $cat_id = $_GET['cat'];
                $query = "SELECT * FROM posts WHERE post_category_id=$cat_id ORDER BY post_date DESC";
                $rezultat = $db->query($query);
                if ($rezultat->num_rows > 0) {
                    while ($redak = $rezultat->fetch_assoc()) {
                        //var_dump($redak);
                        $post_id = $redak['post_id'];
                        $post_naslov = $redak['post_title'];
                        $post_autor = $redak['post_author'];
                        $post_vrijeme = $redak['post_date'];
                        $post_slika = $redak['post_image'];
                        $post_sadrzaj = $redak['post_content'];
    
                        ?>
                        
                        <!-- Blog Post -->
                        <div class="card mb-4">
                            <img class="card-img-top" src="images/<?php echo $post_slika; ?>" alt="Card image cap">
                            <div class="card-body">
                                <h2 class="card-title"><a href="post?p=<?php echo $post_id; ?>"><?php echo $post_naslov; ?></a></h2>
                                <p class="card-text"><?php echo strlen($post_sadrzaj) > 200 ? substr($post_sadrzaj, 0, 200) . "..." : $post_sadrzaj; ?></p>
                                <a href="post?p=<?php echo $post_id; ?>" class="btn btn-primary">Više &rarr;</a>
                            </div>
                            <div class="card-footer text-muted">
                                Objavljeno <?php echo date('d.m.Y. \u H:i', strtotime($post_vrijeme)); ?>
                                <br>
                                Autor: <?php echo $post_autor; ?>
                            </div>
                        </div><?php 
                    }
                } else {
                    echo '<div class="alert alert-warning text-center"><strong>Nema rezultata u odabranoj kategoriji.</strong></div>';
                }
            } else {
                $query = "SELECT * FROM posts ORDER BY post_date DESC";
                $rezultat = $db->query($query);
                if ($rezultat) {
                    while ($redak = $rezultat->fetch_assoc()) {
                        $post_id = $redak['post_id'];
                        $post_naslov = $redak['post_title'];
                        $post_autor = $redak['post_author'];
                        $post_vrijeme = $redak['post_date'];
                        $post_slika = $redak['post_image'];
                        $post_sadrzaj = $redak['post_content'];

                        ?>
                        
                        <!-- Blog Post -->
                        <div class="card mb-4">
                            <img class="card-img-top" src="images/<?php echo $post_slika; ?>" alt="Card image cap">
                            <div class="card-body">
                                <h2 class="card-title"><a href="post?p=<?php echo $post_id; ?>"><?php echo $post_naslov; ?></a></h2>
                                <p class="card-text"><?php echo strlen($post_sadrzaj) > 200 ? substr($post_sadrzaj, 0, 200) . "..." : $post_sadrzaj; ?></p>
                                <a href="post?p=<?php echo $post_id; ?>" class="btn btn-primary">Više &rarr;</a>
                            </div>
                            <div class="card-footer text-muted">
                                Objavljeno <?php echo date('d.m.Y. \u H:i', strtotime($post_vrijeme)); ?>
                                <br>
                                Autor: <?php echo $post_autor; ?>
                            </div>
                        </div><?php 
                    }
                }
            }
            

            
            ?>

            <!-- Pagination -->
            <ul class="pagination justify-content-center mb-4">
                <li class="page-item">
                    <a class="page-link" href="#">&larr; Older</a>
                </li>
                <li class="page-item disabled">
                    <a class="page-link" href="#">Newer &rarr;</a>
                </li>
            </ul>
        </div>
        <!-- Sidebar Widgets Column -->
        <?php require_once "includes/sidelist.php"; ?>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<?php require_once "includes/footer.php"; ?>

<?php 
echo '<script>
    document.querySelector("#index").classList.add("active");
</script>';
?>