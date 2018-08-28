<?php session_start() ?>
<?php require_once "includes/admin_db.php"; ?>
<?php $title = "Admin - Informacije"; ?>
<?php require_once "includes/admin_header.php"; ?>

<!-- Navigation -->
<?php require_once "includes/admin_navigation.php"; ?>

<!-- Page Content -->
<div class="container-fluid h-100">
    <div class="row h-100">
        <?php require_once "includes/admin_sidebar.php"; ?>
        <main class="col bg-faded py-3">
            <h2>
                Informacije
                <?php
                if (isset($_SESSION['msg']) && $_SESSION['msg'] != '') {
                    echo $_SESSION['msg'];
                    unset($_SESSION['msg']);
                }
                ?>                                             
            </h2>

            <hr>

            <!-- Informacije za admin-a -->

        </main>
    </div>
</div>

<?php require_once "includes/admin_footer.php"; ?>