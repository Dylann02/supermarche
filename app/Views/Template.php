<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Caisse Supermarché</title>
    <link rel="stylesheet" href="<?= base_url('css/style.css') ?>">
</head>
<body>

    <?php $caisse = session()->get('caisse'); ?>
    <?php $utilisateur = session()->get('utilisateur'); ?>
    
    <?php if ($utilisateur) : ?>
        <div class="user-info">
            <span>Connecté en tant que : <strong><?= esc($utilisateur['identifiant']) ?></strong></span>
            <span>|</span>
            <a href="<?= base_url('deconnecter') ?>">Déconnexion</a>
        </div>
    <?php endif ?>
    
    <?php if ($caisse) : ?>
        <div class="caisse-active">
            Caisse sélectionnée : <strong><?= esc($caisse['libelle'] ?? ('Caisse ' . $caisse['numero'])) ?></strong>
        </div>
    <?php endif ?>

    <nav>
    </nav>

    <main>
        <?= $this->renderSection('content') ?>
    </main>

</body>
</html>