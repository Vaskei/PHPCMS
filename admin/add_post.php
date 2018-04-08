<?php require_once "includes/admin_db.php"; ?>
<?php $title = "Admin - Dodavanje članka"; ?>
<?php require_once "includes/admin_header.php"; ?>

<!-- Navigation -->
<?php require_once "includes/admin_navigation.php"; ?>

<!-- Page Content -->
<div class="container-fluid h-100">
    <div class="row h-100">
        <?php require_once "includes/admin_sidebar.php"; ?>
        <main class="col bg-faded py-3">
            <h2>Dodavanje članka</h2>
            <hr>

            <?php 
            if (isset($_POST['create_post'])) {
                $post_title = $_POST['post_title'];
                $post_author = $_POST['post_author'];
                $post_category = $_POST['post_category'];

                $post_image = $_FILES['post_image']['name'];
                $post_image_temp = $_FILES['post_image']['tmp_name'];

                $post_tags = $_POST['post_tags'];
                $post_content = $_POST['post_content'];
                $post_date = date('d.m.Y. H:i');
                $post_comment_count = 4;

                var_dump($_POST);
                var_dump($_FILES);
                echo $post_date;
                echo "<br />";
                echo $post_comment_count;
            }
            ?>

            <form class="form_validation" action="" method="post" enctype="multipart/form-data" novalidate>
                <div class="form-group">
                    <label for="post_title" class="font-weight-bold">Naslov članka</label>
                    <input type="text" class="form-control" name="post_title" maxlength="255" required>
                    <div class="invalid-feedback">Naslov članka je obavezan!</div>
                </div>
                <div class="form-group">
                    <label for="post_category" class="font-weight-bold">Kategorija članka</label>
                    <input type="text" class="form-control" name="post_category" required>
                    <div class="invalid-feedback">Kategorija članka je obavezna!</div>
                </div>
                <div class="form-group">
                    <label for="post_author" class="font-weight-bold">Autor članka</label>
                    <input type="text" class="form-control" name="post_author" maxlength="255" required>
                    <div class="invalid-feedback">Autor članka je obavezan!</div>
                </div>
                <div class="form-group">
                    <label for="post_image" class="font-weight-bold">Slika članka</label>
                    <input type="file" class="form-control" name="post_image" required>
                    <div class="invalid-feedback">Slika članka je obavezna!</div>
                </div>
                <div class="form-group">
                    <label for="post_tags" class="font-weight-bold">Tagovi</label>
                    <input type="text" class="form-control" name="post_tags" maxlength="255" required>
                    <div class="invalid-feedback">Tagovi članka su obavezni! Stavite barem jedan tag vezan uz sadržaj članka.</div>
                </div>
                <div class="form-group">
                    <label for="post_content" class="font-weight-bold">Sadržaj članka</label>
                    <textarea class="form-control" name="post_content" id="post_content" cols="30" rows="10" required></textarea>
                    <div class="invalid-feedback">Sadržaj članka je obavezan!</div>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit" name="create_post">Dodaj članak</button>
                </div>
            </form>
        </main>
    </div>
</div>

<?php require_once "includes/admin_footer.php"; ?>