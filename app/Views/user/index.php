
<div class="row">
    <div class="col">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="card-title">
                        Complétez votre profil
                    </h2>
                </div>
                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="profil-tab" data-bs-toggle="tab"
                                    data-bs-target="#profil" type="button" role="tab" aria-controls="profil"
                                    aria-selected="true">Profil
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="voiture-tab" data-bs-toggle="tab"
                                    data-bs-target="#voiture" type="button" role="tab" aria-controls="voiture"
                                    aria-selected="false">Voiture
                            </button>
                        </li>
                    </ul>
                    <!-- Tab panes -->
                    <div class="tab-content border p-3">
                        <div class="tab-pane active" id="profil" role="tabpanel" aria-labelledby="profil-tab"
                             tabindex="0">
                            <form action="<?= base_url("/user/update") ?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" id="username" placeholder="username"
                                               value="<?= isset($utilisateur) ? $utilisateur['username'] : ""; ?>"
                                               name="username">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="mail" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="last_name" placeholder="Nom"
                                               name="last_name"
                                               value="<?= isset($utilisateur) ? $utilisateur['last_name'] : "" ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Téléphone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                               placeholder="numéro"
                                               value="<?= isset($utilisateur) ? $utilisateur['username'] : ""; ?>">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="mail" class="form-label">E-mail</label>
                                        <input type="text" class="form-control" id="mail" placeholder="mail"
                                               name="email"
                                               value="<?= isset($utilisateur) ? $utilisateur['email'] : "" ?>" <?= isset($utilisateur) ? "readonly" : "" ?> >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Mot de passe</label>
                                        <input type="password" class="form-control" id="password" placeholder="password"
                                               value="" name="password">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 d-flex align-items-center">
                                <label for="image" class="form-label me-2">Avatar</label>
                                <div id="preview">
                                    <?php
                                    $profileImageUrl = isset($utilisateur['avatar_url']) ? base_url($utilisateur['avatar_url']) : "#";
                                    ?>
                                    <img class="img-thumbnail me-2" alt="Aperçu de l'image"
                                         style="display: <?= isset($utilisateur['avatar_url']) ? "block" : "none" ?>; max-width: 100px;"
                                         src="<?= $profileImageUrl ?>">
                                </div>

                                <input class="form-control" type="file" name="profile_image" id="avatar_image">
                            </div>

                            <div class="mb-3 d-flex align-items-center">
                                <label for="image" class="form-label me-2">Permis</label>
                                <div id="preview">
                                    <?php
                                    $licenseImageUrl = isset($utilisateur['license_url']) ? base_url($utilisateur['license_url']) : "#";
                                    ?>
                                    <img class="img-thumbnail me-2" alt="Aperçu de l'image"
                                         style="display: <?= isset($utilisateur['license_url']) ? "block" : "none" ?>; max-width: 100px;"
                                         src="<?= $licenseImageUrl ?>">
                                </div>

                                <input class="form-control" type="file" name="license_image" id="license_image">
                            </div>

                            <div class="mb-3 d-flex align-items-center">
                                <label for="image" class="form-label me-2">Carte d'identité</label>
                                <div id="preview">
                                    <?php
                                    $cardImageUrl = isset($utilisateur['card_url']) ? base_url($utilisateur['card_url']) : "#";
                                    ?>
                                    <img class="img-thumbnail me-2" alt="Aperçu de l'image"
                                         style="display: <?= isset($utilisateur['card_url']) ? "block" : "none" ?>; max-width: 100px;"
                                         src="<?= $cardImageUrl ?>">
                                </div>

                                <input class="form-control" type="file" name="card_image" id="card_image">
                            </div>
                                <div class="card-footer text-end">

                                    <?php if (isset($utilisateur)): ?>
                                        <input type="hidden" name="id" value="<?= $utilisateur['id']; ?>">
                                    <?php endif; ?>
                                    <button type="submit" class="btn btn-primary">
                                        <?= isset($utilisateur) ? "Sauvegarder" : "Enregistrer" ?>
                                    </button>
                                </div>
                            </form>
                        </div>
                        <div class="tab-pane" id="voiture" role="tabpanel" aria-labelledby="voiture-tab" tabindex="0">
                            <div class="row justify-content-center">
                                <div class="col-lg-8 col-md-10 col-12">
                                    <div class="card shadow-lg rounded-3">
                                        <div class="card-header bg-success text-white text-center">
                                            <h1 class="mb-0">Entrez votre véhicule</h1>
                                        </div>
                                        <div class="card-body">
                                            <form action="<?= base_url('/car/create'); ?>" method="POST"
                                                  enctype="multipart/form-data">
                                                <?php if (isset($car['id'])) : ?>
                                                    <input type="hidden" name="id"
                                                           value="<?= htmlspecialchars($car['id']); ?>">
                                                <?php endif; ?>

                                                <!-- Modèle du véhicule -->
                                                <div class="mb-4">
                                                    <label for="id_model" class="form-label">Modèle</label>
                                                    <select class="form-select" id="id_model" name="id_modelcar"
                                                            required>
                                                        <option disabled <?= isset($modelcar) ? "selected" : ""; ?>>
                                                            Sélectionnez un modèle
                                                        </option>
                                                        <?php foreach ($modelcar as $model) : ?>
                                                            <option value="<?= $model["id"]; ?>"><?= $model["name"]; ?></option>
                                                        <?php endforeach; ?>
                                                    </select>
                                                </div>

                                                <!-- Couleur du véhicule -->
                                                <div class="mb-4">
                                                    <label for="id_color" class="form-label">Couleur</label>
                                                    <select class="form-select" id="id_color" name="id_color"
                                                            required>
                                                        <option disabled <?= isset($color) ? "selected" : ""; ?>>
                                                            Sélectionnez une couleur
                                                        </option>
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
                        </div>
                    </div>
                </div>
            </div>
    </div>
</div>