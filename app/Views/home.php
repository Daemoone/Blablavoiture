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
                            <i class="fas fa-user me-2"></i> Renseignez votre profil
                        </a>

                        <?php $usercar = $user->getCar(); ?>
                        <?php if (isset($usercar)) { ?>
                            <!-- Véhicule -->
                            <a href="<?= base_url('car') ?>" class="btn btn-success w-100 mb-3">
                                <i class="fas fa-car me-2"></i> Renseignez votre véhicule
                            </a>

                            <!-- Trajet -->
                            <a href="<?= base_url('travel/new') ?>" class="btn btn-warning w-100 mb-3">
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
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="card shadow-lg rounded-3">
                    <div class="card-body text-center">
                        <h5 class="card-title mb-4">Créez un compte utilisateur</h5>
                        <a href="<?= base_url('login/register') ?>" class="btn btn-primary w-100">
                            <i class="fas fa-user-plus me-2"></i> Créez votre compte
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>

</div>