<?php foreach ($travel as $t): ?>
<?php $date_departure = strtotime($t['departure_date']);
    $date_arrival = strtotime($t['arrival_date']); ?>
<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10 col-12">
        <div class="card shadow-lg rounded-3">
            <div class="card-header bg-primary text-white text-center">
                <h1 class="mb-0">Vous consultez ce trajet</h1>
            </div>
            <div class="card-body">
                <h5>Adresse de départ :</h5>
                <div><?= $t['departure_address'];?> </div>
            </div>
            <div class="card-body">
                <h5>Ville de départ :</h5>
                <div><?= $t['departure_city_label'];?> </div>
            </div>
            <div class="card-body">
                <h5>Date et heure de départ :</h5>
                <div><?= date('d/m/Y', $date_departure) ?> à <?= date('H:i', $date_departure) ?></div>
            </div>
            <div class="card-body">
                <h5>Date et heure d'arrivée :</h5>
                <div><?= date('d/m/Y', $date_arrival) ?> à <?= date('H:i', $date_arrival) ?></div>
            </div>
            <div class="card-body">
                <h5>Adresse et ville d'arrivée :</h5>
                <div></div>
            </div>
        </div>
    </div>
</div>
<?php endforeach;?>