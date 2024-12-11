<div class="row">
    <div class="col">
        <form action="<?=base_url("/user/update")?>" method="POST" enctype="multipart/form-data">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">
                        Complétez votre profil
                    </h4>
                </div>
                <div class="card-body">
                    <!-- Tab panes -->
                    <div class="tab-content border p-3">
                        <div class="tab-pane active" id="profil" role="tabpanel" aria-labelledby="profil-tab" tabindex="0">
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Prénom</label>
                                        <input type="text" class="form-control" id="username" placeholder="username" value="<?= isset($utilisateur) ? $utilisateur['username'] : ""; ?>" name="username">
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="mail" class="form-label">Nom</label>
                                        <input type="text" class="form-control" id="last_name" placeholder="Nom" name="last_name" value="<?= isset($utilisateur) ? $utilisateur['last_name'] : "" ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="username" class="form-label">Téléphone</label>
                                        <input type="text" class="form-control" id="phone" name="phone" placeholder="numéro" value="<?= isset($utilisateur) ? $utilisateur['username'] : ""; ?>" >
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="mail" class="form-label">E-mail</label>
                                        <input type="text" class="form-control" id="mail" placeholder="mail" name="email" value="<?= isset($utilisateur) ? $utilisateur['email'] : "" ?>" <?= isset($utilisateur) ? "readonly" : "" ?> >
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Mot de passe</label>
                                        <input type="password" class="form-control" id="password" placeholder="password" value="" name="password">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3 d-flex align-items-center">
                                <label for="image" class="form-label me-2">Avatar</label>
                                <div id="preview">
                                    <?php
                                    $profileImageUrl = isset($utilisateur['avatar_url']) ? base_url($utilisateur['avatar_url']) : "#";
                                    ?>
                                    <img class="img-thumbnail me-2"alt="Aperçu de l'image"
                                         style="display: <?= isset($utilisateur['avatar_url']) ? "block" : "none" ?>; max-width: 100px;"
                                         src="<?= $profileImageUrl ?>">
                                </div>

                                <input class="form-control" type="file" name="profile_image" id="image">
                            </div>

                            <div class="mb-3 d-flex align-items-center">
                                <label for="image" class="form-label me-2">Permis</label>
                                <div id="preview">
                                    <?php
                                    $licenseImageUrl = isset($utilisateur['license_url']) ? base_url($utilisateur['license_url']) : "#";
                                    ?>
                                    <img class="img-thumbnail me-2"alt="Aperçu de l'image"
                                         style="display: <?= isset($utilisateur['license_url']) ? "block" : "none" ?>; max-width: 100px;"
                                         src="<?= $licenseImageUrl ?>">
                                </div>

                                <input class="form-control" type="file" name="license_image" id="image">
                            </div>

                            <div class="mb-3 d-flex align-items-center">
                                <label for="image" class="form-label me-2">Carte d'identité</label>
                                <div id="preview">
                                    <?php
                                    $cardImageUrl = isset($utilisateur['card_url']) ? base_url($utilisateur['card_url']) : "#";
                                    ?>
                                    <img class="img-thumbnail me-2"alt="Aperçu de l'image"
                                         style="display: <?= isset($utilisateur['card_url']) ? "block" : "none" ?>; max-width: 100px;"
                                         src="<?= $cardImageUrl ?>">
                                </div>

                                <input class="form-control" type="file" name="card_image" id="image">
                            </div>
                        </div>
                    </div>

                </div>

                <div class="card-footer text-end">

                    <?php if (isset($utilisateur)): ?>
                        <input type="hidden" name="id" value="<?= $utilisateur['id']; ?>">
                    <?php endif; ?>
                    <button type="submit" class="btn btn-primary">
                        <?= isset($utilisateur) ? "Sauvegarder" : "Enregistrer" ?>
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>