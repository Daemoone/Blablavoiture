<div class="container">
    <div class="row justify-content-center my-5">
        <div class="col-12 text-center">
            <h1 class="display-4 text-primary">Bienvenue sur notre site de covoiturage</h1>
            <p class="lead text-muted">Un moyen simple, rapide et écologique de voyager !</p>
        </div>
    </div>

    <?php if (isset($user)) { ?>
        <div class="row justify-content-center">
            <div class="col-md-8 col-lg-6">
                <div class="card shadow-lg rounded-3">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-4">Bienvenue, <?= htmlspecialchars($user->getUsername()) ?></h5>

                        <!-- Profil -->
                        <a href="<?= base_url('user') ?>" class="btn btn-primary w-100 mb-3">
                            <i class="fas fa-user me-2"></i> Renseignez votre profil et votre véhicule
                        </a>
                        <hr>
                        <?php $usercar = $user->getCar(); ?>
                        <?php if (isset($usercar)) { ?>
                            
                            <!-- Trajet -->
                            <a href="<?= base_url('travel/new') ?>" class="btn btn-success w-100 mb-3">
                                <i class="fas fa-route me-2"></i> Postez votre trajet
                            </a>

                            <!-- Consulter ses Trajets -->
                            <a href="<?= base_url('travel') ?>" class="btn btn-info w-100 mb-3">
                                <i class="fa-solid fa-calendar-days"></i> Consultez vos trajets
                            </a>

                            <!-- Consulter des Trajets -->
                            <a href="<?= base_url('travel/search') ?>" class="btn btn-info w-100 mb-3">
                                <i class="fa-solid fa-database"></i></i> Voir tous les trajets
                            </a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    <?php } else { ?>
        <div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-4">
            <div class="card shadow-lg rounded-3 border-0">
            

                <!-- Card Body 1: Connexion -->
                <div class="card-body text-center">
                    <h5 class="card-title mb-3 text-primary fs-3">Connectez-vous</h5>
                    <p class="mb-4 text-muted">Accédez à votre espace personnel.</p>
                    <a href="<?= base_url('login') ?>" class="btn btn-primary w-100 d-flex align-items-center justify-content-center">
                        <i class="fas fa-sign-in-alt me-2"></i> Se connecter
                    </a>
                </div>

                <p class="text-center fw-semibold">OU</p>

                <!-- Card Body 2: Création de compte -->
                <div class="card-body text-center">
                    <h5 class="card-title mb-3 text-primary">Créez un compte utilisateur</h5>
                    <p class="mb-4 text-muted">Rejoignez-nous et profitez de nos services.</p>
                    <a href="<?= base_url('login/register') ?>" class="btn btn-outline-primary w-100 d-flex align-items-center justify-content-center">
                        <i class="fas fa-user-plus me-2"></i> Créez votre compte
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

        
    <?php } ?>

</div>