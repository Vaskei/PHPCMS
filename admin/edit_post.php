<?php session_start() ?>
<?php require_once "includes/admin_db.php"; ?>
<?php $title = "Admin - Uređivanje članka"; ?>
<?php require_once "includes/admin_header.php"; ?>

<!-- Navigation -->
<?php require_once "includes/admin_navigation.php"; ?>

<!-- Page Content -->
<div class="container-fluid h-100">
    <div class="row h-100">
        <?php require_once "includes/admin_sidebar.php"; ?>
        <main class="col bg-faded py-3">
            <h2>Uređivanje članka</h2>
            <hr>

            <!-- Ispisivanje poruke preko sesije -->
            <?php
            if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>

            <!-- Uredivanje clanka -->
            <?php
            if (isset($_POST['postEdit'])) {
                $postId = intval($_POST['idEdit']);
                //var_dump($postId);
                $query = $db->prepare("SELECT * FROM posts WHERE post_id=? LIMIT 1");
                $query->bind_param("i", $postId);
                if ($query->execute()) {
                    $result = $query->get_result();
                    //var_dump($result);
                    $row = $result->fetch_assoc();
                    var_dump($row);
                    $post_title = $row['post_title'];
                    $post_category_id = $row['post_category_id'];
                    $post_author = $row['post_author'];
                    $post_image = $row['post_image'];
                    $_SESSION['post_image'] = $post_image;
                    $post_tags = $row['post_tags'];
                    $post_content = $row['post_content'];
                }
            }

            if (isset($_POST['update_post'])) {
                var_dump($_POST);
                $post_title_edit = trim(htmlentities($_POST['post_title']));
                $post_author_edit = trim(htmlentities($_POST['post_author']));
                $post_category_edit = trim(htmlentities($_POST['post_category']));
                $post_tags_edit = trim(htmlentities($_POST['post_tags']));
                $post_content_edit = trim(htmlentities($_POST['post_content']));
                
                var_dump($_FILES);
                if (isset($_FILES['post_image']['tmp_name']) && !empty($_FILES['post_image']['tmp_name'])) {
                    // pokreni query za zapisivanje podataka sa novom slikom
                    echo "Nova slika: " . $_FILES['post_image']['name'];
                } else {
                    // pokreni query za zapisivanje podataka bez slike
                    echo "Stara slika je aktivna";
                }

                if (empty($post_title_edit) || strlen($post_title_edit) > 255) {
                    $_SESSION['msg'] = '<small class="text-danger alertFadeout"><strong> <u>NASLOV ČLANKA JE BIO PRAZAN.</u> </strong></small>';
                    header("Location: ./posts");
                }
                // $_SESSION['msg'] = '<small class="text-success alertFadeout"><strong> <u>ČLANAK IZMIJENJEN.</u> </strong></small>';
                // header("Location: ./posts");
                $post_title = $post_title_edit;
                $post_category_id = $post_category_edit;
                $post_author = $post_author_edit;
                $post_image = $_SESSION['post_image'];
                $post_tags = $post_tags_edit;
                $post_content = $post_content_edit;

            }
            ?>

            <form class="form_validation" action="" method="POST" enctype="multipart/form-data" novalidate>
                <div class="form-group">
                    <label for="post_title" class="font-weight-bold">Naslov članka</label>
                    <input type="text" class="form-control" name="post_title" id="post_title" maxlength="255" value="<?php echo $post_title; ?>">
                    <div class="invalid-feedback">Naslov članka je obavezan! (Max. 255 znakova)</div>
                </div>
                <div class="form-group">
                    <label for="post_category" class="font-weight-bold">Kategorija članka</label>
                    <?php
                        $query = "SELECT * FROM categories";
                        $rezultat = $db->query($query);
                        echo '<select class="custom-select" name="post_category" id="post_category" required>';
                        echo '<option value="">Odaberite kategoriju.</option>';
                        if ($rezultat) {
                            while ($redak = $rezultat->fetch_assoc()) {
                                if ($redak['cat_id'] == $post_category_id) {
                                    echo '<option selected value="' . $redak['cat_id'] . '">' . $redak['cat_title'] . '</option>';
                                } else {
                                    echo '<option value="' . $redak['cat_id'] . '">' . $redak['cat_title'] . '</option>';
                                }                                
                            }
                        } else {
                            echo '<option selected value="">Niste dodali barem jednu kategoriju.</option>';
                        }
                        echo '</select>';
                    ?>
                    <div class="invalid-feedback">Kategorija članka je obavezna!</div>
                </div>
                <div class="form-group">
                    <label for="post_author" class="font-weight-bold">Autor članka</label>
                    <input type="text" class="form-control" name="post_author" id="post_author" maxlength="50" value="<?php echo $post_author; ?>" required>
                    <div class="invalid-feedback">Autor članka je obavezan! (Max. 50 znakova)</div>
                </div>
                <div class="form-group">
                    <label for="post_image" class="font-weight-bold">Slika članka</label>
                    <input type="file" class="form-control" name="post_image" id="post_image" accept="image/png, image/jpeg, image/gif, image/bmp" value="<?php echo $post_image; ?>">
                    <div class="invalid-feedback">Slika članka je obavezna!</div>
                    <br>
                    <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
                </div>
                <div class="form-group">
                    <label for="post_tags" class="font-weight-bold">Tagovi</label>
                    <input type="text" class="form-control" name="post_tags" id="post_tags" maxlength="255" value="<?php echo $post_tags; ?>" required>
                    <div class="invalid-feedback">Tagovi članka su obavezni! Stavite barem jedan tag vezan uz sadržaj članka. (Max. 255 znakova)</div>
                </div>
                <div class="form-group">
                    <label for="post_content" class="font-weight-bold">Sadržaj članka</label>
                    <textarea class="form-control" name="post_content" id="post_content" cols="30" rows="10" required><?php echo $post_content; ?></textarea>
                    <div class="invalid-feedback">Sadržaj članka je obavezan!</div>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit" name="update_post">Izmijeni članak</button>
                </div>
            </form>
            <!-- // Uredivanje clanka -->
        </main>
    </div>
</div>

<?php 
echo '<script>
    document.querySelector("#posts_submenu").classList.add("show");
</script>';
?>

<?php require_once "includes/admin_footer.php"; ?>