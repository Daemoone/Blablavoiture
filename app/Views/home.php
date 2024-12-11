<div class="container">
    <div class="row">
        <div class="col text-center">
                <h1>Bienvenue sur notre site de covoiturage</h1>
        </div>
    </div>
</div>
<?php if (isset ($user)) { ?>
    <div class="col">
        <div class="card">
            <a href="<?= base_url('user') ?>">
            <button class="btn btn-primary mb-4" type="button">Profil</button>
            </a>

        <?php $usercar = $user->getCar();
        if(isset ($usercar)) { ?>
            <a href="<?= base_url('travel') ?>">
            <button class="btn btn-primary" type="button">Trajet</button>
            </a>
        <?php } ?>
    </div>
    </div>
<?php } else { ?>
    <div class="col">
        <div class="card">
            <a href="<?= base_url('login/register') ?>">
        <button class="btn btn-primary" type="button">Créez votre compte utilisateur</button>
        </a>
        </div>
    </div>
<?php } ?>
