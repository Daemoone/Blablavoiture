<?php if(isset($traveletape)) :?>
<?php $cars = $user->getCar();?>

<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10 col-12">
        <div class="card shadow-lg rounded-3">
            <div class="card-header bg-primary text-white text-center">
                <h1 class="mb-0">Mettez à jour votre trajet</h1>
            </div>
            <form action="<?= base_url('travel/update'); ?>" method="POST">
                <div class="card-body">
                    <!-- Nombre de sièges libres -->
                    <div class="mb-4">
                        <label for="nb_seat" class="form-label">Nombre de sièges libres</label>
                        <select id="nb_seat" class="form-select" name="total_seat" required>
                            <option value="1" <?= $traveletape['total_seat'] == "1" ? "selected" : "" ; ?>>1</option>
                            <option value="2" <?= $traveletape['total_seat'] == "2" ? "selected" : "" ; ?>>2</option>
                            <option value="3" <?= $traveletape['total_seat'] == "3" ? "selected" : "" ; ?>>3</option>
                        </select>
                    </div>

                    <!-- Ville de départ -->
                    <div class="mb-4">
                        <label for="city_departure" class="form-label">Votre ville de départ</label>
                        <select id="city_departure" class="form-control me-2 name_city" name="id_city_departure">
                            <option selected <?= $traveletape['id_city_departure']; ?>><?= $traveletape['departure_city_label']; ?></option>
                        </select>
                    </div>

                    <!-- Adresse de départ -->
                    <div class="mb-4">
                        <label for="adress_departure" class="form-label">Adresse du dépôt des covoitureurs</label>
                        <input type="text" class="form-control" id="adress_departure" name="adress_departure" placeholder="Adresse de départ" value="<?= $traveletape['departure_address'] ?>" required>
                    </div>

                    <!-- Ville d'arrivée -->
                    <div class="mb-4">
                        <label for="city_arrival" class="form-label">Votre ville d'arrivée</label>
                        <select id="city_arrival" class="form-control me-2 name_city" name="id_city_arrival">
                            <option selected <?= $traveletape['id_city_arrival']; ?>><?= $traveletape['arrival_city_label']; ?></option>
                        </select>
                    </div>

                    <!-- Adresse d'arrivée -->
                    <div class="mb-4">
                        <label for="adress_arrival" class="form-label">Adresse du dépôt des covoitureurs</label>
                        <input type="text" class="form-control" id="adress_arrival" name="adress_arrival" placeholder="Adresse d'arrivée" value="<?= $traveletape['arrival_address'] ?>" required>
                    </div>

                    <!-- Date et heure de départ -->
                    <div class="mb-4">
                        <label for="date_departure" class="form-label">Date et heure de départ</label>
                        <input type="datetime-local" class="form-control" id="date_departure" name="date_departure" min="<?= date("Y-m-d\TH:i") ?>" value="<?= $traveletape['departure_date'] ?>" required>
                    </div>

                    <!-- Date et heure d'arrivée prévue -->
                    <div class="mb-4">
                        <label for="date_arrival" class="form-label">Date et heure d'arrivée prévue</label>
                        <input type="datetime-local" class="form-control" id="date_arrival" name="date_arrival" min="<?= date("Y-m-d\TH:i") ?>" value="<?= $traveletape['arrival_date'] ?>" required>
                    </div>

                    <!-- Sélectionnez votre véhicule -->
                    <div class="mb-4">
                        <label for="car" class="form-label">Sélectionnez votre véhicule</label>
                        <select id="car" class="form-select" name="id_car"  required>
                            <?php foreach($cars as $car) : ?>
                                <option value="<?= $car['id'] ; ?>" <?= $car['id'] == $traveletape['car_id'] ? "selected" : "" ; ?>>  <?= $car['marque'] . " - " . $car['modelname'] . " - " . $car['color']; ?></option>
                            <?php endforeach ?>
                        </select>
                    </div>

                    <!-- Commentaire -->
                    <div class="mb-4">
                        <label for="comment" class="form-label">Votre commentaire</label>
                        <input type="text" class="form-control" id="comment" name="comment" placeholder="Entrez votre commentaire" value="<?= $traveletape['travel_comment'] ?>">
                    </div>

                </div>

                <!-- Footer avec bouton de sauvegarde -->
                <div class="card-footer text-end">
                    <input type="hidden" name="travel_id" value="<?= $traveletape['travel_id'] ?>">
                    <input type="hidden" name="id_etape_departure" value="<?= $traveletape['id_etape_departure'] ?>">
                    <input type="hidden" name="id_etape_arrival" value="<?= $traveletape['id_etape_arrival'] ?>">
                    <button type="submit" class="btn btn-primary px-4 py-2">Modifier</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php endif; ?>