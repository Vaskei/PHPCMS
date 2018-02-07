<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container">

    <div class="row">

        <!-- Blog Entries Column -->
        <div class="col-md-8">

            <h1 class="my-4">Pretraga
                <small>Rezultati pretrage</small>
            </h1>

            <?php 
            
            if (isset($_POST['submit']) && !empty($_POST['search'])) {
                $pretraga = trim(htmlentities($_POST['search']));
                $pretraga = "%{$pretraga}%";
                //$pretraga = "%{$pretraga}%";
                //echo $pretraga;

                $query = $db->prepare("SELECT * FROM posts WHERE post_tags LIKE ? OR post_title LIKE ?");
                $query->bind_param('ss', $pretraga, $pretraga);
                //$query->execute();

                if ($query->execute()) {
                    $rezultat=$query->get_result();
                    //echo $rezultat->num_rows;
                    //print_r($rezultat);
                    if ($rezultat->num_rows > 0) {
                        while ($redak = $rezultat->fetch_assoc()) {
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
                                    <h2 class="card-title"><?php echo $post_naslov; ?></h2>
                                    <p class="card-text"><?php echo $post_sadrzaj; ?></p>
                                    <a href="#" class="btn btn-primary">Read More &rarr;</a>
                                </div>
                                <div class="card-footer text-muted">
                                    Posted on <?php echo $post_vrijeme ?> by
                                    <a href="#"><?php echo $post_autor; ?></a>
                                </div>
                            </div>
                            
                            <?php 
                        }
                    } else {
                        echo '
                        <div class="alert alert-warning" role="alert">
                            Nema pronađenih rezultata.
                        </div> ';
                    }
                } else {
                    echo "Greška kod pretraživanja.";
                }
            } else {
                header("Location: index.php");
                exit;
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
        <?php include "includes/sidebar.php"; ?>

    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<?php include "includes/footer.php"; ?>