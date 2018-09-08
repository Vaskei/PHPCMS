<?php session_start() ?>
<?php require_once "includes/admin_db.php"; ?>
<?php $title = "Admin - Postavke"; ?>
<?php require_once "includes/admin_header.php"; ?>

<!-- Navigation -->
<?php require_once "includes/admin_navigation.php"; ?>

<!-- Page Content -->
<div class="container-fluid h-100">
    <div class="row h-100">
        <?php require_once "includes/admin_sidebar.php"; ?>
        <main class="col bg-faded py-3">
            <h2>
                Postavke

                <!-- Ispisivanje poruke preko sesije -->
                <?php
                if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>
            
            </h2>
            <hr>

            <?php

            $query = "SELECT * FROM site_options";
            $result = $db->query($query);
            if ($result) {
                $row = $result->fetch_assoc();
                //var_dump($row);
                $optionId = trim(htmlentities($row['option_id']));
                $siteTitle = trim(htmlentities($row['site_title']));
                $navbarTitle = trim(htmlentities($row['navbar_title']));
                $infoText = trim(htmlentities($row['info_text']));
            }

            ?>

            <ul class="list-group">
                <li class="list-group-item list-group-item-info d-flex justify-content-between align-items-center">
                    <strong>Naslov stranice 
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" data-html="true" title="<img src='./images/site_title.jpg' class='img-thumbnail' alt=''>" aria-hidden="true"></i>
                    </strong>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center ">
                    <?php echo isset($siteTitle) && !empty($siteTitle) ? $siteTitle : "Ovdje će biti ispisan naslov stranice."; ?>
                </li>

                <li class="list-group-item list-group-item-info d-flex justify-content-between align-items-center">
                    <strong>Naslov navigacijske trake 
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" data-html="true" title="<img src='./images/navbar_title.jpg' class='img-thumbnail' alt=''>" aria-hidden="true"></i>
                    </strong>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center ">
                    <?php echo isset($navbarTitle) && !empty($navbarTitle) ? $navbarTitle : "Ovdje će biti ispisan naslov navigacijske trake."; ?>
                </li>

                <li class="list-group-item list-group-item-info d-flex justify-content-between align-items-center">
                    <strong>Info tekst 
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" data-html="true" title="<img src='./images/info_text.jpg' class='img-thumbnail' alt=''>" aria-hidden="true"></i>
                    </strong>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center ">
                    <?php echo isset($infoText) && !empty($infoText) ? $infoText : "Ovdje će biti ispisan info tekst."; ?>
                </li>

                <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center ">
                    <strong></strong>
                    <div class='btn-group' role='group' aria-label='Button group'>
                        <?php

                        if (empty($siteTitle) && empty($navbarTitle) && empty($infoText)) {
                           // echo '<button type="button" class="btn btn-success gumb_kategorija">Dodaj</button>';
                            echo "<form action='' method='POST'>
                                    <input type='submit' value='Dodaj' name='optionsAddForm' class='btn btn-success gumb_kategorija'/>
                                </form>";
                        } else {
                            // echo '<button type="button" class="btn btn-info gumb_kategorija">Uredi</button>
                            //       <button type="button" class="btn btn-danger gumb_kategorija">Briši</button>';
                            echo "<form action='' method='POST'>
                                    <input type='hidden' name='optionId' value='" . $optionId . "' />
                                    <input type='submit' value='Uredi' name='optionsEditForm' class='btn btn-info gumb_kategorija'/>
                                </form>
                                <form action='' method='POST'>
                                    <input type='hidden' name='optionId' value='" . $optionId . "' />
                                    <input type='submit' value='Briši' name='optionsDelete' class='btn btn-danger gumb_kategorija'
                                        data-toggle='confirmation' data-singleton='true' 
                                        data-placement='right' data-title='Obrisati sve opcije?' 
                                        data-btn-ok-label='DA' data-btn-ok-class='btn-success'
                                        data-btn-ok-icon-class='fa fa-check' data-btn-ok-icon-content=' '
                                        data-btn-cancel-label='NE' data-btn-cancel-class='btn-danger'
                                        data-btn-cancel-icon-class='fa fa-times' data-btn-cancel-icon-content=' '/>
                                </form>";
                        }

                        ?>
                    </div>
                </li>
            </ul>

            <br>

            <!-- Dodavanje opcija -->

            <?php if (isset($_POST['optionsAddForm'])) : ?>

            <hr>

            <form class="form_validation" action="" method="POST" novalidate>
                <div class="form-group">
                    <label for="site_title" class="font-weight-bold">Naslov stranice</label>
                    <input type="text" class="form-control" name="site_title" id="site_title" maxlength="50">
                </div>
                <div class="form-group">
                    <label for="navbar_title" class="font-weight-bold">Naslov navigacijske trake</label>
                    <input type="text" class="form-control" name="navbar_title" id="navbar_title" maxlength="50">
                </div>
                <div class="form-group">
                    <label for="info_text" class="font-weight-bold">Info tekst</label>
                    <input type="text" class="form-control" name="info_text" id="info_text" maxlength="255">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit" name="optionsAddSubmit">Dodaj opcije</button>
                </div>
            </form>
                
            <?php endif; ?>

            <?php 

            if (isset($_POST['optionsAddSubmit'])) {
                var_dump($_POST);
                $site_title = trim(htmlentities($_POST['site_title']));
                $navbar_title = trim(htmlentities($_POST['navbar_title']));
                $info_text = trim(htmlentities($_POST['info_text']));

                $query = $db->prepare("INSERT INTO site_options (option_id, site_title, navbar_title, info_text) VALUES (?, ?, ?, ?)");
                $query->bind_param("isss", $id=1, $site_title, $navbar_title, $info_text);
                if ($query->execute()) {
                    $_SESSION['msg'] = '<small class="text-success alertFadeout"><strong>OPCIJE DODANE.</strong></small>';
                    header("Location: ./site_options");
                } else {
                    $_SESSION['msg'] = '<small class="text-success alertFadeout"><strong>GREŠKA.</strong></small>';
                    header("Location: ./site_options");
                }
            }

            ?>

            <!-- // Dodavanje opcija -->

            <!-- Uredivanje opcija -->

            <?php if (isset($_POST['optionsEditForm'])) : var_dump($_POST) ?>
            
            <hr>

            <form class="form_validation" action="" method="POST" novalidate>
                <div class="form-group">
                    <label for="site_title" class="font-weight-bold">Naslov stranice</label>
                    <input type="text" class="form-control" name="site_title" id="site_title" maxlength="50" value="<?php echo $siteTitle; ?>">
                </div>
                <div class="form-group">
                    <label for="navbar_title" class="font-weight-bold">Naslov navigacijske trake</label>
                    <input type="text" class="form-control" name="navbar_title" id="navbar_title" maxlength="50" value="<?php echo $navbarTitle; ?>">
                </div>
                <div class="form-group">
                    <label for="info_text" class="font-weight-bold">Info tekst</label>
                    <input type="text" class="form-control" name="info_text" id="info_text" maxlength="255" value="<?php echo $infoText; ?>">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit" name="optionsEditSubmit">Uredi opcije</button>
                </div>
            </form>
                
            <?php endif; ?>

            <?php 

            if (isset($_POST['optionsEditSubmit'])) {
                var_dump($_POST);
                $site_title = trim(htmlentities($_POST['site_title']));
                $navbar_title = trim(htmlentities($_POST['navbar_title']));
                $info_text = trim(htmlentities($_POST['info_text']));

                $query = $db->prepare("UPDATE site_options SET option_id=?, site_title=?, navbar_title=?, info_text=? WHERE option_id=?");
                $query->bind_param("isssi", $id=1, $site_title, $navbar_title, $info_text, $updateId=1);
                if ($query->execute()) {
                    $_SESSION['msg'] = '<small class="text-success alertFadeout"><strong>OPCIJE IZMIJENJENE.</strong></small>';
                    header("Location: ./site_options");
                } else {
                    $_SESSION['msg'] = '<small class="text-success alertFadeout"><strong>GREŠKA.</strong></small>';
                    header("Location: ./site_options");
                }
            }

            ?>

            <!-- // Uredivanje opcija -->

            <!-- Brisanje članka  -->

            <?php
            if (isset($_POST['optionsDelete'])) {
                var_dump($_POST);
                $idDelete = $_POST['optionId'];
                $query = $db->prepare("DELETE FROM site_options WHERE option_id = ?");
                $query->bind_param("i", $idDelete);
                if ($query->execute()) {
                    $_SESSION['msg'] = '<small class="text-danger alertFadeout"><strong>OPCIJE OBRISANE.</strong></small>';
                    header("Location: ./site_options");
                } else {
                    $_SESSION['msg'] = '<small class="text-danger alertFadeout"><strong>GREŠKA KOD BRISANJA!</strong></small>';
                    header("Location: ./site_options");
                }
            }
            ?>

            <!-- // Brisanje članka  -->
            
<!-- 
            <ul class="list-group">
                <li class="list-group-item list-group-item-info d-flex justify-content-between align-items-center">
                    <strong>Naslov navigacijske trake</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center ">
                    Dapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis in
                    <div class='btn-group' role='group' aria-label='Button group'>
                        <button type="button" class="btn btn-info gumb_kategorija">Uredi</button>
                        <button type="button" class="btn btn-danger gumb_kategorija">Briši</button>
                    </div>
                </li>
            </ul>

            <br>

            <ul class="list-group">
                <li class="list-group-item list-group-item-info d-flex justify-content-between align-items-center">
                    <strong>Info tekst</strong>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center ">
                    Dapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis inDapibus ac facilisis in
                    <div class='btn-group' role='group' aria-label='Button group'>
                        <button type="button" class="btn btn-info gumb_kategorija">Uredi</button>
                        <button type="button" class="btn btn-danger gumb_kategorija">Briši</button>
                    </div>
                </li>
            </ul> -->
            
        </main>
    </div>
</div>

<?php require_once "includes/admin_footer.php"; ?>