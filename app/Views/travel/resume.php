<?php if (isset($traveletape)) { ?>
    <?php foreach ($traveletape as $t) : ?>
        <?php
        $date_departure = strtotime($t['departure_date']);
        $date_arrival = strtotime($t['arrival_date']);
        ?>
        <div class="container mt-5">
            <div class="row align-items-center mb-4">
                <!-- Colonne Départ -->
                <div class="col-md-5">
                    <div class="card shadow-sm">
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
                    <div class="card shadow-sm">
                        <div class="card-header bg-success text-white">
                            <?= $t['arrival_city_label'] . " " . $t['arrival_department_number'] ?>
                        </div>
                        <div class="card-body">
                            <p><strong>Adresse d'arrivée :</strong> <?= $t['arrival_address'] ?></p>
                            <p><strong>Date d'arrivée :</strong> <?= date('d/m/Y', $date_arrival) ?> à <?= date('H:i', $date_arrival) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>

<?php } else { ?>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card">
                    <h2>Vous n'avez pas encore proposé de trajet</h2>
                </div>
            </div>
        </div>
    </div>
<?php } ?>