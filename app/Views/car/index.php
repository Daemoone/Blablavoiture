<div class="row justify-content-center">
    <div class="col-lg-8 col-md-10 col-12">
        <div class="card shadow-lg rounded-3">
            <div class="card-header bg-success text-white text-center">
                <h1 class="mb-0">Entrez votre véhicule</h1>
            </div>
            <div class="card-body">
                <form action="<?= base_url('/car/create'); ?>" method="POST" enctype="multipart/form-data">
                    <?php if (isset($car['id'])) : ?>
                        <input type="hidden" name="id" value="<?= htmlspecialchars($car['id']); ?>">
                    <?php endif; ?>

                    <!-- Modèle du véhicule -->
                    <div class="mb-4">
                        <label for="id_model" class="form-label">Modèle</label>
                        <select class="form-select" id="id_model" name="id_modelcar" required>
                            <option disabled <?= isset($modelcar) ? "selected" : ""; ?>>Sélectionnez un modèle</option>
                            <?php foreach ($modelcar as $model) : ?>
                                <option value="<?= $model["id"]; ?>"><?= $model["name"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Couleur du véhicule -->
                    <div class="mb-4">
                        <label for="id_color" class="form-label">Couleur</label>
                        <select class="form-select" id="id_color" name="id_color" required>
                            <option disabled <?= isset($color) ? "selected" : ""; ?>>Sélectionnez une couleur</option>
                            <?php foreach ($color as $c) : ?>
                                <option value="<?= $c["id"]; ?>"><?= $c["name"]; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Bouton d'enregistrement -->
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary px-4 py-2">
                            <?= isset($utilisateur) && isset($car) ? "Sauvegarder" : "Enregistrer" ?>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
