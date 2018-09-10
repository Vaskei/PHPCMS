<?php require_once "includes/admin_db.php"; ?>
<?php $title = "Admin - Indeks"; ?>
<?php require_once "includes/admin_header.php"; ?>


<!-- Navigation -->
<?php require_once "includes/admin_navigation.php"; ?>

<!-- Page Content -->
<div class="container-fluid h-100">
    <div class="row h-100">
        <?php require_once "includes/admin_sidebar.php"; ?>
        <main class="col bg-faded py-3">
            <h2>Dobrodošli <small class="text-muted"><?php echo isset($_SESSION['user']) ? $_SESSION['user'] : ""; ?></small></h2>
            <hr>
            <p>Na ovoj stranici možete obavljati administratorske funkcije.</p>
            <p>Da bi započeli, odaberite neke od opcija sa menija.</p>
        </main>
    </div>
</div>

<?php require_once "includes/admin_footer.php"; ?>