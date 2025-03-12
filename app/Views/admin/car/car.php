<div class="row">
    <div class="col">
        <form action="<?= isset($car) ? base_url('admin/car/update') : base_url('admin/car/create'); ?>" method="POST">
            <div class="card">
                <div class="card-header"><h3><?= isset($car) ? "Mise à jour" : "Création"?> de la voiture</h3></div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="model" class="form-label">Modèle</label>
                        <select class="form-select" id="id_model" name="id_modelcar">
                            <option disabled <?= isset($car) ? "" : "selected" ?> >Sélectionnez un modèle</option>
                            <?php foreach ($modelcar as $model) : ?>
                                <option <?= (isset($car) && ($car['id_modelcar'] == $model['id'])) ? "selected" : ""; ?> value="<?= $model["id"]; ?>"><?= $model["name"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                    <label for="color" class="form-label">Couleur</label>
                    <select class="form-select" id="id_color" name="id_color">
                        <option disabled <?= isset($car) ? "" : "selected" ?> value="" ?>
                        Sélectionnez une couleur</option>
                        <?php foreach ($color as $c) : ?>
                            <option value="<?= $c["id"]; ?>"><?= $c["name"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="user" class="form-label">Utilisateur</label>
                        <select class="form-select" id="id_user" name="id_user">
                        <option disabled <?= isset($car) ? "" : "selected" ?> value="" >Sélectionnez l'utilisateur</option>
                        <?php foreach ($users as $u) : ?>
                            <option value="<?= $u["id"]; ?>"><?= $u["username"]; ?></option>
                        <?php endforeach; ?>
                        </select>
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


