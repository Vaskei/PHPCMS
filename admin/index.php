<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

<!-- Navigation -->
<?php include "includes/navigation.php"; ?>

<!-- Page Content -->

<div class="container-fluid">
    <div class="row no-gutters">
        <div class="col-3 bg-dark sidebar">
            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                <a class="nav-link active" id="v-pills-home-tab" data-toggle="pill" href="#v-pills-home" role="tab"
                    aria-controls="v-pills-home" aria-selected="true">Home</a>
                <a class="nav-link" id="v-pills-profile-tab" data-toggle="pill" href="#v-pills-profile" role="tab"
                    aria-controls="v-pills-profile" aria-selected="false">Profile</a>
                <a class="nav-link" id="v-pills-messages-tab" data-toggle="pill" href="#v-pills-messages" role="tab"
                    aria-controls="v-pills-messages" aria-selected="false">Messages</a>
                <a class="nav-link" id="v-pills-settings-tab" data-toggle="pill" href="#v-pills-settings" role="tab"
                    aria-controls="v-pills-settings" aria-selected="false">Settings</a>
            </div>
        </div>
        <div class="col-9 content mx-auto">
            <div class="tab-content" id="v-pills-tabContent">
                <div class="tab-pane fade p-4 show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
                    <?php include "includes/sidebar.php"; ?>
                </div>
                <div class="tab-pane fade p-4" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
                    <table class="table table-secondary table-bordered table-hover">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">First</th>
                            <th scope="col">Last</th>
                            <th scope="col">Handle</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <th scope="row">1</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">2</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">3</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        <tr>
                            <th scope="row">4</th>
                            <td>Mark</td>
                            <td>Otto</td>
                            <td>@mdo</td>
                        </tr>
                        <tr>
                            <th scope="row">5</th>
                            <td>Jacob</td>
                            <td>Thornton</td>
                            <td>@fat</td>
                        </tr>
                        <tr>
                            <th scope="row">6</th>
                            <td>Larry</td>
                            <td>the Bird</td>
                            <td>@twitter</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade p-4" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
                    <?php 

                    $query = "SELECT * FROM posts";
                    $rezultat = $db->query($query);
                    if ($rezultat) {
                        while ($redak = $rezultat->fetch_assoc()) {
                            $post_naslov = $redak['post_title'];
                            $post_autor = $redak['post_author'];
                            $post_vrijeme = $redak['post_date'];
                            $post_slika = $redak['post_image'];
                            $post_sadrzaj = $redak['post_content'];

                            ?>

                    <!-- Blog Post -->
                    <div class="card mb-4">
                        <img class="card-img-top" src="images/<?php echo $post_slika; ?>" alt="Card image cap">
                        <div class="card-body">
                            <h2 class="card-title">
                                <?php echo $post_naslov; ?>
                            </h2>
                            <p class="card-text">
                                <?php echo $post_sadrzaj; ?>
                            </p>
                            <a href="#" class="btn btn-primary">Read More &rarr;</a>
                        </div>
                        <div class="card-footer text-muted">
                            Posted on
                            <?php echo $post_vrijeme ?> by
                            <a href="#">
                                <?php echo $post_autor; ?>
                            </a>
                        </div>
                    </div>
                    <?php 
                                }
                            }

                            ?>
                </div>
                <div class="tab-pane fade p-4" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
                    <table class="table table-dark">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">First</th>
                                <th scope="col">Last</th>
                                <th scope="col">Handle</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th scope="row">1</th>
                                <td>Mark</td>
                                <td>Otto</td>
                                <td>@mdo</td>
                            </tr>
                            <tr>
                                <th scope="row">2</th>
                                <td>Jacob</td>
                                <td>Thornton</td>
                                <td>@fat</td>
                            </tr>
                            <tr>
                                <th scope="row">3</th>
                                <td>Larry</td>
                                <td>the Bird</td>
                                <td>@twitter</td>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include "includes/footer.php"; ?>