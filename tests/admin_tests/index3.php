<?php require_once "includes/db.php"; ?>
<?php require_once "includes/header.php"; ?>

<!-- Navigation -->
<?php require_once "includes/navigation.php"; ?>

<!-- Page Content -->
<div class="container-fluid h-100">
    <div class="row wrapper h-100">
        <aside class="col-12 col-md-2 p-0 bg-dark">
            <nav class="navbar navbar-expand navbar-dark bg-dark flex-md-column flex-row align-items-start py-2">
                <div class="collapse navbar-collapse">
                    <ul class="flex-md-column flex-row navbar-nav w-100 justify-content-between" id="adminSidebar">
                        <li class="nav-item">
                            <a class="nav-link pl-0 text-nowrap" href="#">
                                <i class="fa fa-bullseye fa-fw"></i>
                                <span class="font-weight-bold d-none d-md-inline">Dashboard</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0 dropdown-toggle text-nowrap" href="#posts_dropdown" data-parent="#adminSidebar" data-toggle="collapse" data-target="#posts_dropdown"
                                aria-expanded="false">
                                <i class="fa fa-address-card-o fa-fw"></i>
                                <span class="d-none d-md-inline"> Posts</span>
                            </a>
                            <div class="collapse" id="posts_dropdown">
                                <ul class="flex-column">
                                    <a class="nav-link px-0 text-truncate" href="#">View All Posts</a>
                                    <a class="nav-link px-0 text-truncate" href="#">Add Post</a>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="#">
                                <i class="fa fa-book fa-fw"></i>
                                <span class="d-none d-md-inline">Link</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0 dropdown-toggle text-nowrap" href="#posts_dropdown1" data-parent="#adminSidebar" data-toggle="collapse" data-target="#posts_dropdown1"
                                aria-expanded="false">
                                <i class="fa fa-heart fa-fw"></i>
                                <span class="d-none d-md-inline"> Posts </span>
                            </a>
                            <div class="collapse" id="posts_dropdown1">
                                <ul class="flex-column">
                                    <a class="nav-link px-0 text-truncate" href="#">View All Posts</a>
                                    <a class="nav-link px-0 text-truncate" href="#">Add Post</a>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#">Action</a>
                                <a class="dropdown-item" href="#">Another action</a>
                                <a class="dropdown-item" href="#">Something else here</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Separated link</a>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="#">
                                <i class="fa fa-star fa-fw"></i>
                                <span class="d-none d-md-inline">Link</span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link pl-0" href="..">
                                <i class="fa fa-list fa-fw"></i>
                                <span class="d-none d-md-inline">Natrag</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </aside>
        <main class="col bg-faded py-3">
            <h2>Main</h2>
            <p>Sriracha biodiesel taxidermy organic post-ironic, Intelligentsia salvia mustache 90's code editing brunch. Butcher
                polaroid VHS art party, hashtag Brooklyn deep v PBR narwhal sustainable mixtape swag wolf squid tote bag.
                Tote bag cronut semiotics, raw denim deep v taxidermy messenger bag. Tofu YOLO Etsy, direct trade ethical
                Odd Future jean shorts paleo. Forage Shoreditch tousled aesthetic irony, street art organic Bushwick artisan
                cliche semiotics ugh synth chillwave meditation. Shabby chic lomo plaid vinyl chambray Vice. Vice sustainable
                cardigan, Williamsburg master cleanse hella DIY 90's blog.</p>

            <p>Ethical Kickstarter PBR asymmetrical lo-fi. Dreamcatcher street art Carles, stumptown gluten-free Kickstarter
                artisan Wes Anderson wolf pug. Godard sustainable you probably haven't heard of them, vegan farm-to-table
                Williamsburg slow-carb readymade disrupt deep v. Meggings seitan Wes Anderson semiotics, cliche American
                Apparel whatever. Helvetica cray plaid, vegan brunch Banksy leggings +1 direct trade. Wayfarers codeply PBR
                selfies. Banh mi McSweeney's Shoreditch selfies, forage fingerstache food truck occupy YOLO Pitchfork fixie
                iPhone fanny pack art party Portland.</p>
        </main>
    </div>
</div>

<?php require_once "includes/footer.php"; ?>