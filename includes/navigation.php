<?php

if (isset($_SESSION['id'])) {
    $id = $_SESSION['id'];
    $query = $db->prepare('SELECT * FROM users WHERE user_id=? LIMIT 1');
    $query->bind_param('d', $id);
    if ($query->execute()) {
        $result = $query->get_result();
        $row = $result->fetch_assoc();
        $userNickname = $row['user_nickname'];
    }
}

?>

<div class="container navigacija">
    <nav class="navbar navbar-expand-md navbar-dark bg-primary sticky-top py-2">
        <div class="container">
            <a class="navbar-brand" href="."><?php echo isset($navbarTitle)&&!empty($navbarTitle) ? $navbarTitle : "Naslov navigacijske trake"; ?></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive"
                aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item" id="index">
                        <a class="nav-link" href=".">Home
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <?php if (isset($_SESSION['role']) && $_SESSION['role'] == "admin") : ?>
                    <li class="nav-item">
                        <a class="nav-link" href="./admin">Admin</a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item dropdown" id="profile">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Profil
                        </a>
                        <div class="dropdown-menu bg-primary" aria-labelledby="navbarDropdown">

                            <?php if (isset($_SESSION['id'])) : ?>
                            <h6 class="dropdown-header text-white"> <?php echo $userNickname; ?></h6>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['id'])) : ?>
                            <a class="dropdown-item" href="user_panel">Opcije</a>                            
                            <div class="dropdown-divider"></div>
                            <?php endif; ?>

                            <?php if (!isset($_SESSION['id'])) : ?>
                            <a class="dropdown-item" href="login">Prijava</a>
                            <a class="dropdown-item" href="registration">Registracija</a>
                            <?php endif; ?>

                            <?php if (isset($_SESSION['id'])) : ?>
                            <a class="dropdown-item" href="logout">Odjava</a>
                            <?php endif; ?>

                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>