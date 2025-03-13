<?php if (isset($reservations) && !empty($reservations)) { ?>
    <?php foreach ($reservations as $reservation) : ?>
        <div class="container mt-5">
            <div class="card shadow-sm mb-4">
                <div class="row align-items-center">
                    <!-- Départ du voyage 1 -->
                    <div class="col-md-5 mb-3">
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">Départ du voyage :</h5>
                            </div>
                            <div class="card-body">
                                <p class="fw-bold"><?= $reservation['adresses'][0] ?></p>
                                <p class="mb-0">le : <?= date('d/m/Y', $reservation['dates'][0]) ?> à <?= date('H:i', $reservation['dates'][0]) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Flèche de direction -->
                    <div class="col-auto mb-3">
                        <i class="fa-solid fa-arrow-right fa-2x text-primary"></i>
                    </div>

                    <!-- Départ du voyage 2 -->
                    <div class="col-md-5 mb-3">
                        <div class="card border-primary">
                            <div class="card-header bg-primary text-white">
                                <h5 class="card-title mb-0">Arrivée du voyage :</h5>
                            </div>
                            <div class="card-body">
                                <p class="fw-bold"><?= $reservation['adresses'][1] ?></p>
                                <p class="mb-0">le : <?= date('d/m/Y', $reservation['dates'][1]) ?> à <?= date('H:i', $reservation['dates'][1]) ?></p>
                            </div>
                        </div>
                    </div>

                    <!-- Boutons d'action -->
                    <div class="col-auto d-flex flex-column justify-content-center align-items-center mb-3">
                        <a href="<?= base_url('travel/consult/') . $reservation['travel_id']; ?>" class="mb-2">
                            <button type="button" class="btn btn-primary">
                                <i class="fa-solid fa-eye"></i> Consulter
                            </button>
                        </a>
                        <a href="<?= base_url('reservation/delete/') . $reservation['id']; ?>">
                            <button type="button" class="btn btn-danger text-white">
                                <i class="fa-solid fa-trash"></i> Supprimer
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
<?php } else { ?>
    <div class="container">
        <div class="row">
            <div class="col mt-4 mb-4">
                <div class="card p-4 text-center">
                    <h2>Vous n'avez réservé aucun trajet</h2>

                    <a href="<?= base_url('/travel/search'); ?>">
                    <button type="button" class="btn btn-info text-light">
                        <i class="fa-solid fa-car"></i>
                        Consulter des trajets
                    </button>
                </div>
            </a>
            </div>
        </div>
    </div>
<?php } ?>