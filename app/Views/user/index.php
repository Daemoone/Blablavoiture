
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
<<<<<<< HEAD
                             tabindex="0">
=======
                            tabindex="0">
>>>>>>> modify
                            <form action="<?= base_url("/user/update") ?>" method="POST" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" id="username" placeholder="username"
<<<<<<< HEAD
                                               value="<?= isset($utilisateur) ? $utilisateur['username'] : ""; ?>"
                                               name="username">
=======
                                            value="<?= isset($utilisateur) ? $utilisateur['username'] : ""; ?>"
                                            name="username">
>>>>>>> modify
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="mail" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="last_name" placeholder="Nom"
<<<<<<< HEAD
                                               name="last_name"
                                               value="<?= isset($utilisateur) ? $utilisateur['last_name'] : "" ?>">
=======
                                            name="last_name"
                                            value="<?= isset($utilisateur) ? $utilisateur['last_name'] : "" ?>">
>>>>>>> modify
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Téléphone</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
<<<<<<< HEAD
                                               placeholder="numéro"
                                               value="<?= isset($utilisateur) ? $utilisateur['username'] : ""; ?>">
=======
                                            placeholder="numéro"
                                            value="<?= isset($utilisateur) ? $utilisateur['username'] : ""; ?>">
>>>>>>> modify
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="mail" class="form-label">E-mail</label>
                                        <input type="text" class="form-control" id="mail" placeholder="mail"
<<<<<<< HEAD
                                               name="email"
                                               value="<?= isset($utilisateur) ? $utilisateur['email'] : "" ?>" <?= isset($utilisateur) ? "readonly" : "" ?> >
=======
                                            name="email"
                                            value="<?= isset($utilisateur) ? $utilisateur['email'] : "" ?>" <?= isset($utilisateur) ? "readonly" : "" ?> >
>>>>>>> modify
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Mot de passe</label>
                                        <input type="password" class="form-control" id="password" placeholder="password"
<<<<<<< HEAD
                                               value="" name="password">
=======
                                            value="" name="password">
>>>>>>> modify
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
<<<<<<< HEAD
                                         style="display: <?= isset($utilisateur['avatar_url']) ? "block" : "none" ?>; max-width: 100px;"
                                         src="<?= $profileImageUrl ?>">
=======
                                        style="display: <?= isset($utilisateur['avatar_url']) ? "block" : "none" ?>; max-width: 100px;"
                                        src="<?= $profileImageUrl ?>">
>>>>>>> modify
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
<<<<<<< HEAD
                                         style="display: <?= isset($utilisateur['license_url']) ? "block" : "none" ?>; max-width: 100px;"
                                         src="<?= $licenseImageUrl ?>">
=======
                                        style="display: <?= isset($utilisateur['license_url']) ? "block" : "none" ?>; max-width: 100px;"
                                        src="<?= $licenseImageUrl ?>">
>>>>>>> modify
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
<<<<<<< HEAD
                                         style="display: <?= isset($utilisateur['card_url']) ? "block" : "none" ?>; max-width: 100px;"
                                         src="<?= $cardImageUrl ?>">
=======
                                        style="display: <?= isset($utilisateur['card_url']) ? "block" : "none" ?>; max-width: 100px;"
                                        src="<?= $cardImageUrl ?>">
>>>>>>> modify
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
<<<<<<< HEAD
                                                  enctype="multipart/form-data">
                                                <?php if (isset($car['id'])) : ?>
                                                    <input type="hidden" name="id"
                                                           value="<?= htmlspecialchars($car['id']); ?>">
=======
                                                enctype="multipart/form-data">
                                                <?php if (isset($car['id'])) : ?>
                                                    <input type="hidden" name="id"
                                                        value="<?= htmlspecialchars($car['id']); ?>">
>>>>>>> modify
                                                <?php endif; ?>

                                                <!-- Modèle du véhicule -->
                                                <div class="mb-4">
                                                    <label for="id_model" class="form-label">Modèle</label>
                                                    <select class="form-select" id="id_model" name="id_modelcar"
                                                            required>
<<<<<<< HEAD
                                                        <option disabled <?= isset($modelcar) ? "selected" : ""; ?>>
                                                            Sélectionnez un modèle
                                                        </option>
                                                        <?php foreach ($modelcar as $model) : ?>
                                                            <option value="<?= $model["id"]; ?>"><?= $model["name"]; ?></option>
=======
                                                        <option disabled <?= isset($brand) ? "selected" : ""; ?>>
                                                            Sélectionnez un modèle
                                                        </option>
                                                        <?php foreach ($brand as $b) : ?>
                                                            <option value="<?= $b["id"]; ?>"><?= $b["model"] . ' - ' . $b["brand"]; ?></option>
>>>>>>> modify
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
<<<<<<< HEAD
                                                <div class="text-center">
=======
                                                <div class="text-center mb-3">
>>>>>>> modify
                                                    <button type="submit" class="btn btn-primary px-4 py-2">
                                                        <?= isset($utilisateur) && isset($car) ? "Sauvegarder" : "Enregistrer" ?>
                                                    </button>
                                                </div>
                                            </form>
<<<<<<< HEAD
=======
                                            <div class="card-footer text-center">
                                                <div class="fw-bold mb-3">Votre/Vos véhicule(s)</div>
                                                <!-- Table pour afficher les véhicules -->
                                                <table class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Marque</th>
                                                            <th>Modèle</th>
                                                            <th>Couleur</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php foreach($car as $c) { ?>
                                                            <tr>
                                                                <td><?= $c['marque'] ?></td>
                                                                <td><?= $c['modelname'] ?></td>
                                                                <td><?= $c['color'] ?></td>
                                                                <td>
                                                                    <!-- Bouton Supprimer -->
                                                                    <form action="<?= base_url('/car/deletecar/' . $c['id']); ?>" method="GET" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer ce véhicule ?');">
                                                                        <button type="submit" class="btn btn-danger btn-sm">
                                                                            Supprimer
                                                                        </button>
                                                                    </form>
                                                                </td>
                                                            </tr>
                                                        <?php } ?>
                                                    </tbody>
                                                </table>
                                            </div>
>>>>>>> modify
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