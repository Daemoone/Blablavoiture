<<<<<<< HEAD
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
=======

    <?php foreach ($travel as $t): ?>
    <?php 
        $date_departure = strtotime($t['departure_date']);
        $date_arrival = strtotime($t['arrival_date']);
    ?>
    
    <div class="row justify-content-center mt-4">
        <div class="col-lg-8 col-md-10 col-12">
            <div class="card shadow-lg rounded-3">
                <div class="card-header bg-primary text-white text-center">
                    <h1 class="mb-0">Vous consultez ce trajet</h1>
                </div>
                <div class="card-body">
                    <div class="row justify-content-center ">
                        <div class="col-4">
                            <div class="mb-4 mt-3">
                        <h5><i class="fas fa-map-marker-alt"></i> Adresse et ville de départ :</h5>
                        <p class="mb-1"><?= $t['departure_address']; ?></p>
                        <p class="text-muted"><?= $t['departure_city_label'] . ' ' . $t['zip_code_departure'];; ?></p>
                        </div>
                        <div class="mb-4">
                            <h5><i class="fas fa-calendar-alt"></i> Date et heure de départ :</h5>
                            <p class="mb-1"><?= date('d/m/Y', $date_departure) ?> à <?= date('H:i', $date_departure) ?></p>
                        </div>
                        <div class="mb-4">
                            <h5><i class="fas fa-map-marker-alt"></i> Adresse et ville d'arrivée :</h5>
                            <p class="mb-1"><?= $t['arrival_address']; ?></p>
                            <p class="text-muted"><?= $t['arrival_city_label'] . ' ' . $t['zip_code_arrival']; ?></p>
                        </div>
                        <div class="mb-4">
                            <h5><i class="fas fa-calendar-check"></i> Date et heure d'arrivée :</h5>
                            <p class="mb-1"><?= date('d/m/Y', $date_arrival) ?> à <?= date('H:i', $date_arrival) ?></p>
                        </div>
                            </div>
                        <div class="col-4 mt-3">
                            <div class="mb-4">
                            <h5><i class="fas fa-circle-user"></i> Ce trajet est proposé par :</h5>
                            <p class="mb-1"><?= $t['user_username']; ?></p>
                        </div>
                        <div class="mb-4">
                            <h5><i class="fas fa-car"></i> A bord de :</h5>
                            <p class="mb-1"><?= $t['car_model_name'] . ' ' . $t['car_color'];; ?></p>
                        </div>
                        <div class="mb-4">
                            <h5><i class="fas fa-chair"></i> Nombre de sièges libres au départ :</h5>
                            <p class="mb-1"><?= $t['total_seat']; ?></p>
                        </div>
                        <div class="mb-4">
                            <h5><i class="fas fa-message"></i> Commentaire du conducteur :</h5>
                            <p class="mb-1"><?= $t['travel_comment']; ?></p>
                        </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
        <form action="<?= base_url('reservation/create') ?>" method="POST">
        <input type="hidden" value="<?= $t['travel_id'] ?>" name="id_travel">
        <input type="hidden" value="<?= $t['id_etape_departure'] ?>" name="id_etape_departure">
        <input type="hidden" value="<?= $t['id_etape_arrival'] ?>" name="id_etape_arrival">
        <div class="mb-4">
            <select id="nb_seat" class="form-select" name="total_seat" required>
                <option class="text-center" selected>Nombre de sièges que vous souhaitez réserver</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
            </select>
        </div>
        
        <div class="card-footer text-center">
            <?php if($reservation['total'] == '0') { ?>
                <button type="submit" class="btn btn-primary px-4 py-2">Réserver</button>
            <?php } else { ?>
                <p>Vous avez déjà réservé ce trajet</p>
                <a href="<?= base_url('travel/search') ?>"><button type="button" class="btn btn-primary">Retour vers tous les trajets disponibles</button></a>
            <?php } ?>
        </div>
    </form>
                </div>
            </div>
        </div>
    </div>
    
<?php endforeach; ?>
>>>>>>> modify
