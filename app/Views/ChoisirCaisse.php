<?= $this->extend('Template') ?>

<?= $this->section('content') ?>

    <h4>Choisir Caisse</h4>

    <?php if (session()->getFlashdata('erreur')) : ?>
        <p style="color: red;"><?= esc(session()->getFlashdata('erreur')) ?></p>
    <?php endif ?>

    <form method="post" action="./accueil/valider">
        <?= csrf_field() ?>

        <label for="id_caisse">Choisir Caisse :</label><br>
        <select name="id_caisse" id="id_caisse" required>
            <option value="">-- Sélectionner --</option>
            <?php foreach ($caisses as $caisse) : ?>
                <option value="<?= $caisse['id'] ?>">
                    <?= esc($caisse['libelle'] ?? ('Caisse ' . $caisse['numero'])) ?>
                </option>
            <?php endforeach ?>
        </select>

        <br><br>

        <input type="submit" name="valider" value="Valider">

    </form>

<?= $this->endSection() ?>