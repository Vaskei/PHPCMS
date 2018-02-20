<?php require_once "includes/admin_db.php"; ?>
<?php require_once "includes/admin_header.php"; ?>

<!-- Navigation -->
<?php require_once "includes/admin_navigation.php"; ?>

<!-- Page Content -->
<div class="container-fluid h-100">
    <div class="row h-100">
        <?php require_once "includes/admin_sidebar.php"; ?>
        <main class="col bg-faded py-3">
            <h2 class="text-center">Kategorije</h2>
            <hr>

            <?php 

            if (isset($_POST['submit'])) {
                $imeKategorije = trim(htmlentities($_POST['catTitle']));
                if ($imeKategorije == "" || empty($imeKategorije)) {
                    echo ('<div class="alert alert-warning text-center"><strong>Upišite ime kategorije!</strong></div>');
                } else {
                    $query = $db->prepare("INSERT INTO categories (cat_title) VALUES (?)");
                    $query->bind_param("s", $imeKategorije);
                    if ($query->execute()) {
                        echo ('<div class="alert alert-success text-center"><strong>Kategorija dodana.</strong></div>');
                    } else {
                        echo ('<div class="alert alert-warning text-center"><strong>Greška!</strong></div>');
                    }
                }
            }
            ?>

            <div class="row">
                <div class="col-md-6">
                    <form class="form" action="" method="POST">
                        <div class="form-group mb-0">
                            <label for="categories">Dodaj kategoriju: </label>                            
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" id="categories" name="catTitle" placeholder="Naziv kategorije...">
                            <div class="input-group-append">
                                <button type="submit" name="submit" class="btn btn-success">Dodaj</button>
                            </div>
                        </div>                       
                    </form>
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-6">
                    <form class="form" action="" method="POST">
                        <div class="form-group mb-0">
                            <label for="categoriesEdit">Uredi kategoriju: </label>                            
                        </div>

                        <?php if (isset($_GET['edit'])) {
                            $idUredi = $_GET['edit'];
                            $query = $db->prepare("SELECT * FROM categories WHERE cat_id = ? LIMIT 1");
                            $query->bind_param("i", $idUredi);
                            if ($query->execute()) {
                                $rezultat = $query->get_result();
                                $redakEdit = $rezultat->fetch_assoc();
                            }
                        } ?>

                        <div class="input-group">
                            <input type="text" class="form-control" id="categoriesEdit" name="catEdit" placeholder="Novi naziv kategorije..."
                                value="<?php if (isset($redakEdit['cat_title'])) {echo $redakEdit['cat_title'];} ?>" >
                            <div class="input-group-append">
                                <button type="submit" name="submitEdit" class="btn btn-info">Uredi</button>
                            </div>
                        </div>                       
                    </form>
                </div>
            </div>
            <br>

            <?php

            if (isset($_GET['delete'])) {
                $idBrisanje = $_GET['delete'];
                $query = $db->prepare("DELETE FROM categories WHERE cat_id = ?");
                $query->bind_param("i", $idBrisanje);
                if ($query->execute()) {
                    echo ('<div class="alert alert-success text-center"><strong>Kategorija obrisana.</strong></div>');
                } else {
                    echo ('<div class="alert alert-warning text-center"><strong>Greška!</strong></div>');
                }
                header("Location: ./categories");
            }



            ?>

            <div class="row">
                <div class="col-12">
                    <table class="table table-sm table-bordered table-hover text-center">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Naziv</th>
                                <th>Opcije</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 

                            $query = "SELECT * FROM categories";
                            $rezultat = $db->query($query);
                            if ($rezultat) {
                                while ($redak = $rezultat->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>" . $redak['cat_id'] . "</td>";
                                    echo "<td>" . $redak['cat_title'] . "</td>";
                                    echo "<td>
                                        <div class='btn-group' role='group' aria-label='Button group'>
                                            <a class='btn btn-info' role='button' href='categories.php?edit=" . $redak['cat_id'] . "'>Uredi</a>
                                            <a class='btn btn-danger' role='button' href='categories.php?delete=" . $redak['cat_id'] . "'>Obriši</a>
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
        </main>
    </div>
</div>



<?php require_once "includes/admin_footer.php"; ?>