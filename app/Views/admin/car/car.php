<div class="row">
    <div class="col">
        <form action="<?= base_url('admin/car/update'); ?>" method="POST" enctype="multipart/form-data">
            <?php if (isset($car['id'])) : ?>
                <input type ="hidden" name="id" value="<?= htmlspecialchars($car['id']); ?>">
            <?php endif; ?>
            <div class="card">
                <div class="card-header"><h3>Modification de la voiture</h3></div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="mb-3">
                        <label for="model" class="form-label">Modèle</label>
                        <select class="form-select" id="id_model" name="id_model">
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

        <div class="card-footer text-end">
            <?php if (isset($car)): ?>
                <input type="hidden" name="id" value="<?= $car['id']; ?>">
            <?php endif; ?>
            <button type="submit" class="btn btn-primary">
                <?= isset($car) ? "Sauvegarder" : "Enregistrer" ?>
            </button>
        </div>
        </form>
    </div>
</div>


