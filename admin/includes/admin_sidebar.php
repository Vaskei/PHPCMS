<aside class="col-12 col-md-2 p-0 bg-primary">
    <nav class="navbar flex-md-column flex-row align-items-start navbar-expand-md navbar-dark py-2">
        <!-- <a class="navbar-brand" href=".">
            <i class="fa fa-address-card-o fa-fw"></i>&nbsp;Pregled
        </a> -->
        <span class="navbar-brand">
            <i class="fa fa-address-card-o fa-fw"></i>&nbsp;Pregled
        </span>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#adminSidebar">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="adminSidebar">
            <ul class="flex-column navbar-nav">
                <li class="nav-item">
                    <a class="nav-link pl-0 dropdown-toggle" href="#menu1" data-parent="#adminSidebar" data-toggle="collapse" data-target="#menu1"
                        aria-expanded="false">
                        <i class="fa fa-book fa-fw"></i>&nbsp;Članci
                    </a>
                    <div class="collapse" id="menu1">
                        <ul class="flex-column nav">
                            <a class="nav-link" href="#">
                                <i class="fa fa-files-o fa-fw"></i>&nbsp;Svi članci
                            </a>
                            <a class="nav-link" href="#">
                                <i class="fa fa-plus-square fa-fw"></i>&nbsp;Dodaj članak
                            </a>
                        </ul>
                    </div>
                </li>
                <li class="nav-item <?php echoActiveClass("categories") ?>">
                    <a class="nav-link pl-0" href="categories">
                        <i class="fa fa-list fa-fw"></i>&nbsp;Kategorije
                    </a>
                </li>
                <li class="nav-item <?php echoActiveClass("comments") ?>">
                    <a class="nav-link pl-0" href="comments">
                        <i class="fa fa-comments fa-fw"></i>&nbsp;Komentari
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0 dropdown-toggle" href="#menu2" data-parent="#adminSidebar" data-toggle="collapse" data-target="#menu2">
                        <i class="fa fa-users fa-fw"></i>&nbsp;Korisnici
                    </a>
                    <div class="collapse" id="menu2">
                        <ul class="flex-column nav">
                            <a class="nav-link" href="#">Sub 1</a>
                            <a class="nav-link" href="#">Sub 2</a>
                        </ul>
                    </div>
                </li>
                <li class="nav-item <?php echoActiveClass("site_options") ?>">
                    <a class="nav-link pl-0" href="site_options">
                        <i class="fa fa-cog fa-fw"></i>&nbsp;Postavke
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link pl-0" href="..">
                        <i class="fa fa-arrow-left fa-fw"></i>&nbsp;Natrag
                    </a>
                </li>
            </ul>
        </div>
    </nav>
</aside>