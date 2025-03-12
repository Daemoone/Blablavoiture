<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10 col-12">
        <div class="card shadow-lg rounded-3">
            <div class="card-header bg-warning text-grey text-center">
                <h1 class="mb-0">Renseignez votre trajet</h1>
            </div>
            <form action="<?= base_url('travel/create'); ?>" method="POST">
                <div class="card-body">
                    <!-- Nombre de sièges libres -->
                    <div class="mb-4">
                        <label for="nb_seat" class="form-label">Nombre de sièges libres</label>
                        <select id="nb_seat" class="form-select" name="total_seat" required>
                            <option selected>Nombre de sièges</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                        </select>
                    </div>

                    <!-- Ville de départ -->
                    <div class="mb-4">
                        <label for="city_departure" class="form-label">Votre ville de départ</label>
                        <select id="city_departure" class="form-control me-2 name_city" name="id_city_departure"></select>
                    </div>

                    <!-- Adresse de départ -->
                    <div class="mb-4">
                        <label for="adress_departure" class="form-label">Adresse de la récupération des covoitureurs</label>
                        <input type="text" class="form-control" id="adress_departure" name="adress_departure" placeholder="Adresse de départ" required>
                    </div>

                    <!-- Ville d'arrivée -->
                    <div class="mb-4">
                        <label for="city_arrival" class="form-label">Votre ville d'arrivée</label>
                        <select id="city_arrival" class="form-control me-2 name_city" name="id_city_arrival"></select>
                    </div>

                    <!-- Adresse d'arrivée -->
                    <div class="mb-4">
                        <label for="adress_arrival" class="form-label">Adresse du dépôt des covoitureurs</label>
                        <input type="text" class="form-control" id="adress_arrival" name="adress_arrival" placeholder="Adresse d'arrivée" required>
                    </div>

                    <!-- Date et heure de départ -->
                    <div class="mb-4">
                        <label for="date_departure" class="form-label">Date et heure de départ</label>
                        <input type="datetime-local" class="form-control" id="date_departure" name="date_departure" min="<?= date("Y-m-d\TH:i") ?>" required>
                    </div>

                    <!-- Date et heure d'arrivée prévue -->
                    <div class="mb-4">
                        <label for="date_arrival" class="form-label">Date et heure d'arrivée prévue</label>
                        <input type="datetime-local" class="form-control" id="date_arrival" name="date_arrival" min="<?= date("Y-m-d\TH:i") ?>" required>
                    </div>

                    <!-- Sélectionnez votre véhicule -->
                    <div class="mb-4">
                        <label for="car" class="form-label">Sélectionnez votre véhicule</label>
                        <select id="car" class="form-select" name="id_car" required>
                            <option disabled selected>Véhicule</option>
                            <?php foreach($car as $c): ?>
                                <option value="<?= $c['id']; ?>"><?= $c['marque'] . " - " . $c['modelname'] . " - " . $c['color']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Commentaire -->
                    <div class="mb-4">
                        <label for="comment" class="form-label">Avez-vous un commentaire ?</label>
                        <input type="text" class="form-control" id="comment" name="comment" placeholder="Entrez votre commentaire">
                    </div>

                </div>

                <!-- Footer avec bouton de sauvegarde -->
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary px-4 py-2">Sauvegarder</button>
                </div>
            </form>
        </div>
    </div>
</div>