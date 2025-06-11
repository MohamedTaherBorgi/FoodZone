<section class="page-info new-block">
    <div class="fixed-bg" style="background: url('images/info-bg.jpg');"></div>
    <div class="overlay"></div>
    <div class="container">
        <h2>Domnoo menu</h2>
        <div class="clear-fix"></div>
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active"><a href="#">Menu</a></li>
        </ol>
    </div>
</section><!-- banner -->


<section class="shopping-cart new-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="table-responsive">
                    <table class="table cart-tbl">
                        <thead>
                            <tr>
                                <th class="p_dtl">ID Commande</th>
                                <th class="p_price">Adresse</th>
                                <th class="p_ttl">Statut</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include_once '../config/Database.php';

                            $userId = $_SESSION['user_id'];

                            $db = new Database();
                            $conn = $db->getConnection();

                            // Query commandes and their livraison statut for this user
                            $query = "
                                SELECT 
                                    c.idCommande, 
                                    c.adresseClient, 
                                    l.statut
                                FROM commande c
                                LEFT JOIN livraison l ON c.idCommande = l.idCommande
                                WHERE c.idClient = :userId
                                ORDER BY c.idCommande DESC
                            ";

                            $stmt = $conn->prepare($query);
                            $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                            $stmt->execute();

                            if ($stmt->rowCount() > 0) {
                                while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                    // Set badge class based on statut
                                    $badgeClass = match ($row['statut']) {
                                        'EN_ATTENTE' => 'badge badge-info-inverse',
                                        'EN_COURS' => 'badge badge-warning-inverse',
                                        'LIVREE' => 'badge badge-success-inverse',
                                        'ANNULEE' => 'badge badge-danger-inverse',
                                        default => 'badge badge-secondary'
                                    };

                                    echo "<tr>
                                        <td>{$row['idCommande']}</td>
                                        <td>{$row['adresseClient']}</td>
                                        <td><span class='{$badgeClass}'>{$row['statut']}</span></td>
                                    </tr>";
                                }
                            } else {
                                echo "<tr><td colspan='3'>Aucune commande trouvée.</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div class="clearfix"></div>
</section>

<section class="loc-cop-sum  new-block">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="block-stl10">
                    <h3>Find your location :</h3>
                    <p>Mauris nec semper justo, a accumsan est. Morbi massa libelementum.</p>
                    <form action="#">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="Search Location..">
                        </div>
                        <button class="btn btn5">Apply</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="block-stl10">
                    <h3>discount coupons :</h3>
                    <p>Mauris nec semper justo, a accumsan est. Morbi massa libelementum.</p>
                    <form action="#">
                        <div class="form-group">
                            <input type="text" class="form-control" placeholder="code type here..">
                        </div>
                        <button class="btn btn5">Apply</button>
                    </form>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-xs-12">
                <div class="block-stl10 odr-summary">
                    <h3>order summary :</h3>
                    <ul class="list-unstyled">
                        <li><span class="ttl">Subtotal</span> <span class="stts">$145</span></li>
                        <li><span class="ttl">Shipping</span> <span class="stts">Free Shipping</span></li>
                        <li><span class="ttl">Vat Tax (20%)</span> <span class="stts">$10</span></li>
                        <li><span class="ttl">Apply Discount Coupon</span> <span class="stts"><del>$40</del></span></li>
                    </ul>
                    <div class="ttl-all">
                        <span class="ttlnm">Total</span>
                        <span class="odr-stts">$110</span>
                    </div>
                </div>
                <button class="btn btn1 stl2">Check out</button>
            </div>
        </div>
    </div>
</section>