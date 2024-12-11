
<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
            <h1>Renseignez votre trajet</h1>
            </div>
            <form action="<?= base_url('travel/createtravel'); ?>" method="POST">
                 <div class="card-body">
                     <div class="col">
                         <div class="row">
                             <div class="mb-4">
                                 <label for="nb_seat" class="form-label">Nombre de sièges libres</label>
                                 <select id="nb_seat" class="form-select" name="nb_seat" required>
                                     <option selected>nombre de sièges</option>
                                     <option value="1">1</option>
                                     <option value="2">2</option>
                                     <option value="3">3</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                        <div class="col">
                            <div class="row">
                                <div class="mb-4">
                                    <label for="city_departure" class="form-label">Votre ville de départ</label>
                                    <select id="city_departure" class="form-control me-2 name_city" name="id_city_departure"></select>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="row">
                                <div class="mb-4">
                                    <label for="adress_departure" class="form-label">
                                        L'adresse de la récupération des covoitureurs
                                    </label>
                                    <input type="text" class="form-control" id="adress_departure" name="adress_departure" placeholder="adresse de départ">
                                </div>
                            </div>
                        </div>
                     <div class="col">
                         <div class="row">
                             <div class="mb-4">
                                 <label for="city_arrival" class="form-label">Votre ville d'arrivée</label>
                                 <select id="city_arrival" class="form-control me-2 name_city" name="id_city_arrival"></select>
                             </div>
                         </div>
                     </div>
                     <div class="col">
                         <div class="row">
                             <div class="mb-4">
                                 <label for="adress_arrival" class="form-label">
                                     L'adresse du dépôt des covoitureurs
                                 </label>
                                 <input type="text" class="form-control" id="adress_arrival" name="adress_arrival" placeholder="adresse d'arrivée">
                             </div>
                         </div>
                     </div>
                     <div class="col">
                         <div class="row">
                             <div class="mb-4">
                                 <label for="date_departure" class="form-label">
                                     Date et heure de départ
                                 </label>
                                 <input type="datetime-local" class="form-control" id="date_departure" name="date_departure" min="<?= date("Y-m-d H:i") ?>">
                             </div>
                         </div>
                     </div>
                     <div class="col">
                         <div class="row">
                             <div class="mb-4">
                                 <label for="adress_arrival" class="form-label">
                                     Date et heure d'arrivée prévue
                                 </label>
                                 <input type="datetime-local" class="form-control" id="adress_arrival" name="date_arrival" min="<?= date("Y-m-d H:i") ?>" placeholder="adresse d'arrivée">
                             </div>
                         </div>
                     </div>
                     <div class="col">
                         <div class="row">
                             <div class="mb-4">
                                 <label for="car" class="form-label">Sélectionnez votre véhicule</label>
                                 <select id="car" class="form-select" name="id_car" required>
                                     <option disabled <?= !isset($car) ? "selected":""; ?> >Véhicule</option>
                                     <?php foreach($car as $c): ?>
                                         <option value="<?= $c['id']; ?>"><?= $c['marque'] . " - " . $c['modelname'] . " - " . $c['color']; ?>
                                         </option>
                                     <?php endforeach; ?>
                                 </select>
                             </div>
                         </div>
                    </div>
                     <div class="col">
                         <div class="row">
                             <div class="mb-4">
                                 <label for="comment" class="form-label">
                                     Avez-vous un commentaire ?
                                 </label>
                                 <input type="text" class="form-control" id="comment" name="comment" placeholder="rentrez votre commentaire">
                             </div>
                         </div>
                     </div>
                <div class="card-footer text-end">
                    <button type="submit" class="btn btn-primary">Sauvegarder
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

