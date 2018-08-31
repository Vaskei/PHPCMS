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
            <h2>Postavke</h2>
            <hr>

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

            <ul class="list-group">
                <li class="list-group-item list-group-item-info d-flex justify-content-between align-items-center">
                    <strong>Naslov stranice 
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" data-html="true" title="<img src='./images/site_title.jpg' class='img-thumbnail' alt=''>" aria-hidden="true"></i>
                    </strong>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center ">
                    <?php echo isset($siteTitle)&&!empty($siteTitle) ? $siteTitle : "Ovdje će biti ispisan naslov stranice."; ?>
                </li>

                <li class="list-group-item list-group-item-info d-flex justify-content-between align-items-center">
                    <strong>Naslov navigacijske trake 
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" data-html="true" title="<img src='./images/navbar_title.jpg' class='img-thumbnail' alt=''>" aria-hidden="true"></i>
                    </strong>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center ">
                    <?php echo isset($navbarTitle)&&!empty($navbarTitle) ? $navbarTitle : "Ovdje će biti ispisan naslov navigacijske trake."; ?>
                </li>

                <li class="list-group-item list-group-item-info d-flex justify-content-between align-items-center">
                    <strong>Info tekst 
                        <i class="fa fa-question-circle" data-toggle="tooltip" data-placement="right" data-html="true" title="<img src='./images/info_text.jpg' class='img-thumbnail' alt=''>" aria-hidden="true"></i>
                    </strong>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center ">
                    <?php echo isset($infoText)&&!empty($infoText) ? $infoText : "Ovdje će biti ispisan info tekst."; ?>
                </li>

                <li class="list-group-item list-group-item-secondary d-flex justify-content-between align-items-center ">
                    <strong></strong>
                    <div class='btn-group' role='group' aria-label='Button group'>
                        <?php

                        if (empty($siteTitle) && empty($navbarTitle) && empty($infoText)) {
                            echo '<button type="button" class="btn btn-success gumb_kategorija">Dodaj</button>';
                        } else {
                            echo '<button type="button" class="btn btn-info gumb_kategorija">Uredi</button>
                                  <button type="button" class="btn btn-danger gumb_kategorija">Briši</button>';
                        }

                        ?>
                        

                    </div>
                </li>
            </ul>

            <br>
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