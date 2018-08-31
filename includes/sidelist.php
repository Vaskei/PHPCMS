<div class="col-md-4">
    <!-- Search Widget -->

    <div class="card my-4">
        <h5 class="card-header">Pretraga</h5>
        <div class="card-body">
            <form action="search.php" method="post">
                <div class="input-group">
                    <input type="text" class="form-control" name="search" placeholder="Traži...">
                    <span class="input-group-btn">
                        <button class="btn btn-secondary" name="submit" type="submit">Go!</button>
                    </span>
                </div>
            </form>            
        </div>
    </div>

    <!-- Categories Widget -->
    <?php 
    
    $query = "SELECT * FROM categories";
    $rezultat = $db->query($query);
    if ($rezultat) {
        $polje = array();
        while ($redak = $rezultat->fetch_assoc()) {
            $polje[] = $redak['cat_title'];
        }
        list($podjela1, $podjela2) = array_chunk($polje, ceil(count($polje) / 2));
    }
    
    ?>
    <div class="card my-4">
        <h5 class="card-header">Kategorije</h5>
        <div class="card-body">
            <div class="row">
                <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">

                        <?php                         
                        foreach ($podjela1 as $key => $value) {
                            echo '<li><a href="#">' . $value . '</a></li>';
                        }                        
                        ?>

                    </ul>
                </div>
                <div class="col-lg-6">
                    <ul class="list-unstyled mb-0">

                        <?php                         
                        foreach ($podjela2 as $key => $value) {
                            echo '<li><a href="#">' . $value . '</a></li>';
                        }                        
                        ?>

                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- Side Widget -->
    <div class="card my-4">
        <h5 class="card-header">Info</h5>
        <div class="card-body">
            <?php echo isset($infoText)&&!empty($infoText) ? $infoText : "Ovdje će biti ispisan info tekst."; ?>
        </div>
    </div>

</div>