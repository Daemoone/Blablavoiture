<div class="row">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h1>Entrez votre véhicule</h1>
            </div>
            <div class="card-header">
                <form action="<?= base_url('/car/create'); ?>" method="POST" enctype="multipart/form-data">
                    <?php if (isset($car['id'])) : ?>
                        <input type ="hidden" name="id" value="<?= htmlspecialchars($car['id']); ?>">
                    <?php endif; ?>
                    <div class="card-body">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <label for="model" class="form-label">Modèle</label>
                                    <select class="form-select" id="id_model" name="id_modelcar">
                                        <option disabled <?= isset($modelcar) ? "selected" : ""; ?>  >Sélectionnez un modèle</option>
                                        <?php foreach ($modelcar as $model) : ?>
                                            <option value="<?= $model["id"]; ?>"><?= $model["name"]; ?></option>
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
                                        <option disabled <?= isset($color) ? "selected" : ""; ?>
                                        >Sélectionnez une couleur</option>
                                        <?php foreach ($color as $c) : ?>
                                            <option value="<?= $c["id"]; ?>"><?= $c["name"]; ?></option>
                                        <?php endforeach; ?>
                                </div>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <?= isset($utilisateur) && isset($car) ? "Sauvegarder" : "Enregistrer" ?>
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>