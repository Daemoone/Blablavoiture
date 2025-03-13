<?php if (isset($all_travels)) { ?>
    <?php foreach ($all_travels as $t) : ?>
        <?php
        $date_departure = strtotime($t['departure_date']);
        $date_arrival = strtotime($t['arrival_date']);
        ?>
        <div class="container mt-5">
            <div class="card shadow-sm mb-4">
                <div class="row align-items-center">
                    <!-- Colonne Départ -->
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <?= $t['departure_city_label'] . " " . $t['departure_department_number'] ?>
                            </div>
                            <div class="card-body">
                                <p><strong>Adresse de départ :</strong> <?= $t['departure_address'] ?></p>
                                <p><strong>Date de départ :</strong> <?= date('d/m/Y', $date_departure) ?> à <?= date('H:i', $date_departure) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Icône flèche -->
                    <div class="col-auto">
                        <i class="fa-solid fa-arrow-right fa-2x text-primary"></i>
                    </div>

                    <!-- Colonne Arrivée -->
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-header bg-success text-white">
                                <?= $t['arrival_city_label'] . " " . $t['arrival_department_number'] ?>
                            </div>
                            <div class="card-body">
                                <p><strong>Adresse d'arrivée :</strong> <?= $t['arrival_address'] ?></p>
                                <p><strong>Date d'arrivée :</strong> <?= date('d/m/Y', $date_arrival) ?> à <?= date('H:i', $date_arrival) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Bouton Consulter -->
                    <div class="col-auto">
                        <a href="<?= base_url('travel/consult/') . $t['travel_id']; ?>" class="d-block">
                            <button type="button" class="btn btn-primary">
                                Consulter
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
    <?php if (empty($all_travels)) { ?>
        <div class="container">
            <div class="row">
                <div class="col mt-4 mb-4">
                    <div class="card p-4 text-center">
                        <h2>Aucun trajet n'a été posté sur le site</h2>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } ?>