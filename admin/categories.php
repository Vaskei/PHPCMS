<?php require_once "includes/admin_db.php"; ?>
<?php $title = "Admin - Kategorije"; ?>
<?php require_once "includes/admin_header.php"; ?>

<!-- Navigation -->
<?php require_once "includes/admin_navigation.php"; ?>

<!-- Page Content -->
<div class="container-fluid h-100">
    <div class="row h-100">
        <?php require_once "includes/admin_sidebar.php"; ?>
        <main class="col bg-faded py-3">
            <h2>Kategorije</h2>
            <hr>

            <!-- Dodavanje kategorije -->
            <div class="row">
                <div class="col-md-6">
                    <form class="form" action="" method="POST">
                        <div class="form-group mb-0">
                            <label for="categories">Dodaj kategoriju: </label>                            
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" id="categories" name="catTitle" placeholder="Naziv kategorije...">
                            <div class="input-group-append">
                                <button type="submit" name="submit" class="btn btn-success gumb_kategorija">Dodaj</button>
                            </div>
                        </div>                       
                    </form>

                    <?php
                    if (isset($_POST['submit'])) {
                        //var_dump($_POST);
                        $imeKategorije = htmlentities(trim($_POST['catTitle']));
                        if ($imeKategorije == "" || empty($imeKategorije)) {
                            echo ('<div class="alert alert-warning text-center"><strong>Upišite ime kategorije!</strong></div>');
                        } else {
                            $query = $db->prepare('SELECT * FROM categories WHERE cat_title=? LIMIT 1');
                            $query->bind_param("s", $imeKategorije);
                            if ($query->execute()) {
                                $result=$query->get_result();
                                if (count($result->fetch_array())) {
                                    echo ('<div class="alert alert-warning text-center"><strong>Kategorija već postoji u bazi!</strong></div>');
                                } else {
                                    $query = $db->prepare("INSERT INTO categories (cat_title) VALUES (?)");
                                    $query->bind_param("s", $imeKategorije);
                                    if ($query->execute()) {
                                        echo ('<div class="alert alert-success text-center"><strong>Kategorija dodana.</strong></div>');
                                    } else {
                                        echo ('<div class="alert alert-warning text-center"><strong>Greška!</strong></div>');
                                    }
                                }
                            } else {
                                echo ('<div class="alert alert-warning text-center"><strong>Nije moguće čitati bazu!</strong></div>');
                            }                            
                        }
                    }
                    ?>

                </div>
            </div>
            <!-- // Dodavanje kategorije -->

            <br>

            <!-- Uredivanje kategorije -->
            <div class="row">
                <div class="col-md-6">
                    <form class="form" action="" method="POST">
                        <div class="form-group mb-0">
                            <label for="categoriesEdit">Uredi kategoriju: </label>                            
                        </div>

                        <?php 
                        if (isset($_GET['edit'])) {
                            $idUredi = $_GET['edit'];
                            $query = $db->prepare("SELECT * FROM categories WHERE cat_id = ? LIMIT 1");
                            $query->bind_param("i", $idUredi);
                            if ($query->execute()) {
                                $rezultat = $query->get_result();
                                $redakEdit = $rezultat->fetch_assoc();
                            }
                        } 
                        ?>

                        <div class="input-group">
                            <input type="text" class="form-control" id="categoriesEdit" name="catEdit" placeholder="Novi naziv kategorije..."
                                value="<?php if (isset($redakEdit['cat_title'])) {echo $redakEdit['cat_title'];} ?>" >
                            <div class="input-group-append">
                                <button type="submit" name="submitEdit" class="btn btn-info gumb_kategorija">Uredi</button>
                            </div>
                        </div>

                        <?php
                        if (isset($_POST['submitEdit']) && isset($_GET['edit'])) {
                            $catNaslovEdit = htmlentities(trim($_POST['catEdit']));
                            //$id = intval($_GET['edit']);
                            //echo($_GET['edit']);
                            //echo($idUredi);
                            echo("<br>");
                            echo($catNaslovEdit);
                            echo("<br>");
                            if (empty($catNaslovEdit)) {
                                echo ('<div class="alert alert-warning text-center"><strong>Upišite ime kategorije!</strong></div>');
                            } else {  
                                $query = $db->prepare('SELECT * FROM categories WHERE cat_title=? AND cat_id!=? LIMIT 1');
                                $query->bind_param("si", $catNaslovEdit, $idUredi);
                                if ($query->execute()) {
                                    $result=$query->get_result();
                                    if (count($result->fetch_array())) {
                                        echo ('<div class="alert alert-warning text-center"><strong>Kategorija već postoji u bazi!</strong></div>');
                                    } else {
                                        $query=$db->prepare('UPDATE categories SET cat_title=? WHERE cat_id=?');
                                        $query->bind_param('si', $catNaslovEdit, $idUredi);
                                        if ($query->execute()) {
                                            echo ('<div class="alert alert-success text-center"><strong>Kategorija izmjenjena.</strong></div>');
                                            header("Location: ./categories?editsuccess");
                                        } else {
                                            echo ('<div class="alert alert-warning text-center"><strong>Greška!</strong></div>');
                                        }
                                    }
                                } else {
                                    echo ('<div class="alert alert-warning text-center"><strong>Nije moguće čitati bazu!</strong></div>');
                                }      
                                


                                // print_r($redakEdit);
                                // if ($catNaslovEdit == $redakEdit['cat_title']) {
                                //     echo ('<div class="alert alert-warning text-center"><strong>Kategorija već postoji!</strong></div>');
                                // } else {
                                //     echo ('<div class="alert alert-success text-center"><strong>JAJ!</strong></div>');
                                //     header("Location: ./categories?editsuccess");
                                // }
                            }
                        } else if (isset($_POST['submitEdit'])) {
                            echo ('<div class="alert alert-warning text-center"><strong>Niste odabrali kategoriju za uređivanje!</strong></div>');
                        }
                        
                        if (isset($_GET['editsuccess'])) {
                            echo ('<div class="alert alert-success text-center"><strong>Kategorija izmjenjena.</strong></div>');
                        }
                        ?>

                    </form>
                </div>
            </div>
            <!-- // Uredivanje kategorije -->

            <br>

            <!-- Brisanje kategorije  -->
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
            <!-- // Brisanje kategorije  -->

            <!-- Ispis kategorija u tablicu -->
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
                                            <a class='btn btn-info gumb_kategorija' role='button' href='categories.php?edit=" . $redak['cat_id'] . "'>Uredi</a>
                                            <a class='btn btn-danger gumb_kategorija' role='button' href='categories.php?delete=" . $redak['cat_id'] . "'>Obriši</a>
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
            <!-- // Ispis kategorija u tablicu -->
        </main>
    </div>
</div>

<?php require_once "includes/admin_footer.php"; ?>