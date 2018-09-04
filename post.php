<?php require_once "includes/db.php"; ?>
<?php $title = "Članak"; ?>
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

//var_dump($_GET);

if (isset($_GET['p']) && !empty($_GET['p'])) {
    $post_id = $_GET['p'];
} else {
    header("Location: .");
}

?>

<!-- Navigation -->
<?php require_once "includes/navigation.php"; ?>

<?php 

$query = "SELECT * FROM posts WHERE post_id = $post_id LIMIT 1";
$rezultat = $db->query($query);
if ($rezultat) {
    $row = $rezultat->fetch_assoc();
    if (!count($row)) {
        header("Location: .");
    } else {
        //var_dump($row);
        $postTitle = $row['post_title'];
        $postAuthor = $row['post_author'];
        $postDate = $row['post_date'];
        $postImage = $row['post_image'];
        $postContent = $row['post_content'];
    }
} else {
    header("Location: .");
}

?>

<!-- Page Content -->
<div class="container sadrzaj">

    <div class="row">

        <!-- Post Content Column -->
        <div class="col-lg-8">

            <!-- Title -->
            <h1 class="mt-4"><?php echo $postTitle; ?></h1>

            <!-- Author -->
            <p class="lead">
                <i class="fa fa-pencil" aria-hidden="true"></i>
                <a href="#"><?php echo $postAuthor; ?></a>
            </p>

            <hr>

            <!-- Date/Time -->
            <p><i class="fa fa-clock-o" aria-hidden="true"></i> <?php echo date('d.m.Y. \u H:i', strtotime($postDate)); ?></p>

            <hr>

            <!-- Preview Image -->
            <img class="img-fluid" src="images/<?php echo $postImage; ?>" alt="">

            <hr>

            <!-- Post Content -->
            <p><?php echo $postContent; ?></p>

            <hr>

            <!-- Comments Form -->
            <!-- <div class="card my-4">
                <h5 class="card-header">Leave a Comment:</h5>
                <div class="card-body">
                    <form>
                        <div class="form-group">
                            <textarea class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div> -->

            <!-- Single Comment -->
            <!-- <div class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                    <h5 class="mt-0">Commenter Name</h5>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in
                    vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia
                    congue felis in faucibus.
                </div>
            </div> -->

            <!-- Comment with nested comments -->
            <!-- <div class="media mb-4">
                <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                <div class="media-body">
                    <h5 class="mt-0">Commenter Name</h5>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in
                    vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla. Donec lacinia
                    congue felis in faucibus.

                    <div class="media mt-4">
                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                        <div class="media-body">
                            <h5 class="mt-0">Commenter Name</h5>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in
                            vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla.
                            Donec lacinia congue felis in faucibus.
                        </div>
                    </div>

                    <div class="media mt-4">
                        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
                        <div class="media-body">
                            <h5 class="mt-0">Commenter Name</h5>
                            Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin. Cras purus odio, vestibulum in
                            vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi vulputate fringilla.
                            Donec lacinia congue felis in faucibus.
                        </div>
                    </div>

                </div>
            </div> -->

        </div>

        <!-- Sidebar Widgets Column -->
        <?php require_once "includes/sidelist.php"; ?>
    </div>
    <!-- /.row -->

</div>
<!-- /.container -->

<?php require_once "includes/footer.php"; ?>