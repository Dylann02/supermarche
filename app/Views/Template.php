<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Caisse Supermarché</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
        .caisse-active { background-color: #e8f4f8; padding: 10px; text-align: center; font-weight: bold; border-bottom: 2px solid #0066cc; }
        nav { background-color: #f0f0f0; padding: 10px; }
        main { padding: 20px; }
        form { margin: 20px 0; }
        select, input[type="submit"] { padding: 8px; margin: 10px 5px; font-size: 16px; }
        input[type="submit"] { background-color: #0066cc; color: white; border: none; cursor: pointer; border-radius: 4px; }
        input[type="submit"]:hover { background-color: #004499; }
        h4 { color: #0066cc; }
    </style>
</head>
<body>

    <?php $caisse = session()->get('caisse'); ?>
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