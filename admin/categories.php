<?php require_once "includes/admin_db.php"; ?>
<?php $title = "Admin - Kategorije"; ?>
<?php require_once "includes/admin_header.php"; ?>

<!-- Navigation -->
<?php require_once "includes/admin_navigation.php"; ?>

<?php session_start() ?>

<!-- Page Content -->
<div class="container-fluid h-100">
    <div class="row h-100">
        <?php require_once "includes/admin_sidebar.php"; ?>
        <main class="col bg-faded py-3">
            <h2>Kategorije</h2>
            <hr>

            <!-- Ispisivanje poruke preko sesije -->
            <?php
            if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
            ?>

            <!-- Dodavanje kategorije -->
            <div class="row">
                <div class="col-md-6">
                    <form class="form_validation" action="" method="POST" novalidate>
                        <div class="form-group mb-0">
                            <label for="categories">Dodaj kategoriju: </label>                            
                        </div>
                        <div class="input-group">
                            <input type="text" class="form-control" id="categories" name="catTitle" placeholder="Naziv kategorije..." maxlength=50 required>
                            <div class="input-group-append">
                                <button type="submit" name="submit" class="btn btn-success gumb_kategorija">Dodaj</button>
                            </div>
                            <div class="invalid-feedback">Kategorija ne smije biti prazna. Maksimalno 50 znakova.</div>
                        </div>                       
                    </form>

                    <?php
                    if (isset($_POST['submit'])) {
                        //var_dump($_POST);
                        $imeKategorije = htmlentities(trim($_POST['catTitle']));
                        if ($imeKategorije == "" || empty($imeKategorije)) {
                            $_SESSION['msg'] = '<div class="alert alert-warning text-center"><strong>Upišite ime kategorije!</strong></div>';
                            header("Location: ./categories");
                        } else if (strlen($imeKategorije) > 50) {
                            $_SESSION['msg'] = '<div class="alert alert-warning text-center"><strong>Kategorija ima više od 50 znakova!</strong></div>';
                            header("Location: ./categories");
                        } else {
                            $query = $db->prepare('SELECT * FROM categories WHERE cat_title=? LIMIT 1');
                            $query->bind_param("s", $imeKategorije);
                            if ($query->execute()) {
                                $result=$query->get_result();
                                if (count($result->fetch_array())) {
                                    $_SESSION['msg'] = '<div class="alert alert-warning text-center"><strong>Kategorija već postoji u bazi!</strong></div>';
                                    header("Location: ./categories");
                                } else {
                                    $query = $db->prepare("INSERT INTO categories (cat_title) VALUES (?)");
                                    $query->bind_param("s", $imeKategorije);
                                    if ($query->execute()) {
                                        $_SESSION['msg'] = '<div class="alert alert-success text-center"><strong>Kategorija dodana.</strong></div>';
                                        header("Location: ./categories");
                                    } else {
                                        $_SESSION['msg'] = '<div class="alert alert-warning text-center"><strong>Greška!</strong></div>';
                                        header("Location: ./categories");
                                    }
                                }
                            } else {
                                $_SESSION['msg'] = '<div class="alert alert-warning text-center"><strong>Nije moguće čitati bazu!</strong></div>';
                                header("Location: ./categories");
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
                    <form class="form_validation" action="" method="POST" novalidate>
                        <div class="form-group mb-0">
                            <label for="categoriesEdit">Uredi kategoriju: </label>                            
                        </div>

                        <?php

                        if (isset($_POST['catEdit'])) {
                            var_dump($_POST);
                            $idEdit = $_POST['idEdit'];
                            //echo $idEdit;
                            $query = $db->prepare("SELECT * FROM categories WHERE cat_id = ? LIMIT 1");
                            $query->bind_param("i", $idEdit);
                            if ($query->execute()) {
                                $result = $query->get_result();
                                $rowEdit = $result->fetch_assoc();
                                var_dump($rowEdit);
                            }
                        } 

                        ?>

                        <div class="input-group">
                            <input type="text" class="form-control" id="categoriesEdit" name="catEditedName" placeholder="Novi naziv kategorije..." maxlength=50
                                value="<?php if (isset($rowEdit['cat_title'])) {echo $rowEdit['cat_title'];} ?>" required>
                            <div class="input-group-append">
                                <button type="submit" name="submitEdit" value="<?php if (isset($rowEdit['cat_id'])) {echo $rowEdit['cat_id'];} ?>" class="btn btn-info gumb_kategorija">Uredi</button>
                            </div>
                            <div class="invalid-feedback">Niste odabrali kategoriju za uređivanje ili je naziv kategorije prazan. Maksimalno 50 znakova.</div>
                        </div>

                        <?php

                        if (isset($_POST['submitEdit']) && !empty($_POST['submitEdit'])) {
                            $catNameEdit = htmlentities(trim($_POST['catEditedName']));
                            $idEdit = intval(trim($_POST['submitEdit']));
                            //var_dump($idEdit);
                            //$id = intval($_GET['edit']);
                            //echo($_GET['edit']);
                            //echo($idUredi);
                            // echo("<br>");
                            // echo($catNaslovEdit);
                            // echo("<br>");
                            if ($catNameEdit == "" || empty($catNameEdit)) {
                                $_SESSION['msg'] = '<div class="alert alert-warning text-center"><strong>Ime kategorije je prazno! Pokušajte ponovno.</strong></div>';
                                header("Location: ./categories");
                            }else if (strlen($catNameEdit) > 50) {
                                $_SESSION['msg'] = '<div class="alert alert-warning text-center"><strong>Kategorija ima više od 50 znakova!</strong></div>';
                                header("Location: ./categories");
                            } else {
                                //var_dump($_POST);
                                $query = $db->prepare('SELECT * FROM categories WHERE cat_title=? AND cat_id!=? LIMIT 1');
                                $query->bind_param("si", $catNameEdit, $idEdit);
                                if ($query->execute()) {
                                    $result=$query->get_result();
                                    if (count($result->fetch_array())) {
                                        //echo ('<div class="alert alert-warning text-center"><strong>Kategorija već postoji u bazi!</strong></div>');
                                        $_SESSION['msg'] = '<div class="alert alert-warning text-center"><strong>Kategorija već postoji u bazi!</strong></div>';
                                        header("Location: ./categories");
                                    } else {
                                        $query=$db->prepare('UPDATE categories SET cat_title=? WHERE cat_id=?');
                                        $query->bind_param('si', $catNameEdit, $idEdit);
                                        if ($query->execute()) {
                                            //echo ('<div class="alert alert-success text-center"><strong>Kategorija izmjenjena.</strong></div>');
                                            $_SESSION['msg'] = '<div class="alert alert-success text-center"><strong>Kategorija izmjenjena.</strong></div>';
                                            header("Location: ./categories");
                                            // header("Location: ./categories?editsuccess");
                                        } else {
                                            $_SESSION['msg'] = '<div class="alert alert-warning text-center"><strong>Greška!</strong></div>';
                                            header("Location: ./categories");
                                        }
                                    }
                                } else {
                                    $_SESSION['msg'] = '<div class="alert alert-warning text-center"><strong>Nije moguće čitati bazu!</strong></div>';
                                    header("Location: ./categories");
                                }      
                            }
                        } else if (isset($_POST['submitEdit']) && empty($_POST['submitEdit'])) {
                            $_SESSION['msg'] = '<div class="alert alert-warning text-center"><strong>Niste odabrali kategoriju za uređivanje!</strong></div>';
                            header("Location: ./categories");
                        }
                        
                        // if (isset($_GET['editsuccess'])) {
                        //     echo ('<div class="alert alert-success text-center"><strong>Kategorija izmjenjena.</strong></div>');
                        // }
                        ?>

                    </form>
                </div>
            </div>
            <!-- // Uredivanje kategorije -->

            <br>

            <!-- Brisanje kategorije  -->
            <?php

            // if (isset($_GET['delete'])) {
            //     $idBrisanje = $_GET['delete'];
            //     $query = $db->prepare("DELETE FROM categories WHERE cat_id = ?");
            //     $query->bind_param("i", $idBrisanje);
            //     if ($query->execute()) {
            //         $_SESSION['msg'] = '<div class="alert alert-danger text-center"><strong>Kategorija obrisana.</strong></div>';
            //         header("Location: ./categories");
            //     } else {
            //         $_SESSION['msg'] = '<div class="alert alert-warning text-center"><strong>Greška!</strong></div>';
            //         header("Location: ./categories");
            //     }
            // }

            if (isset($_POST['catDelete'])) {
                $idDelete = $_POST['idDelete'];
                $query = $db->prepare("DELETE FROM categories WHERE cat_id = ?");
                $query->bind_param("i", $idDelete);
                if ($query->execute()) {
                    $_SESSION['msg'] = '<div class="alert alert-danger text-center"><strong>Kategorija obrisana.</strong></div>';
                    header("Location: ./categories");
                } else {
                    $_SESSION['msg'] = '<div class="alert alert-warning text-center"><strong>Greška!</strong></div>';
                    header("Location: ./categories");
                }
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
                                        <form action='' method='post'>
                                            <input type='hidden' name='idEdit' value='" . $redak['cat_id'] . "' />
                                            <input type='submit' value='Uredi' name='catEdit' class='btn btn-info gumb_kategorija'></input>
                                        </form>
                                        <form action='' method='post'>
                                            <input type='hidden' name='idDelete' value='" . $redak['cat_id'] . "' />
                                            <input type='submit' value='Brisi' name='catDelete' class='btn btn-danger gumb_kategorija'
                                                data-toggle='confirmation' data-singleton='true' 
                                                data-placement='right' data-title='Obrisati kategoriju?' 
                                                data-btn-ok-label='DA' data-btn-ok-class='btn-success'
                                                data-btn-ok-icon-class='fa fa-check' data-btn-ok-icon-content=' '
                                                data-btn-cancel-label='NE' data-btn-cancel-class='btn-danger'
                                                data-btn-cancel-icon-class='fa fa-times' data-btn-cancel-icon-content=' '></input>
                                        </form>
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