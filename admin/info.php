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

            <!-- Informacije -->

            <h5>
                <i class="fa fa-graduation-cap fa-fw" aria-hidden="true"></i> Student: <small class="text-muted">Goran Ferenc</small>
            </h5>
            <hr>

            <h5>
                <i class="fa fa-book fa-fw" aria-hidden="true"></i> Kolegij: <small class="text-muted">PHP programiranje</small>
            </h5>
            <hr>

            <h5>
                <i class="fa fa-user-md fa-fw" aria-hidden="true"></i> Nositelj kolegija: <small class="text-muted">dr. sc. Sanja Brekalo, v. pred.</small>
            </h5>
            <hr>

            <h5>
                <i class="fa fa-calendar fa-fw" aria-hidden="true"></i> Godina: <small class="text-muted">2018.</small>
            </h5>
            <hr>

        </main>
    </div>
</div>

<?php require_once "includes/admin_footer.php"; ?>

<?php 
echo '<script>
    document.querySelector("#admin_info").classList.add("active");
</script>';
?>