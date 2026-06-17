<?= $this->extend('Template') ?>

<?= $this->section('content') ?>

<div class="login-container">
    <div class="login-box">
        
        <h2>Connexion</h2>

        <?php if (session()->getFlashdata('erreur')) : ?>
            <p class="error-message"><?= esc(session()->getFlashdata('erreur')) ?></p>
        <?php endif ?>

        <form method="post" action="connexion/verifier">
            <?= csrf_field() ?>

            <div class="form-group">
                <label for="identifiant">Identifiant :</label>
                <input type="text" id="identifiant" name="identifiant" required autocomplete="username">
            </div>

            <div class="form-group">
                <label for="mot_de_passe">Mot de passe :</label>
                <input type="password" id="mot_de_passe" name="mot_de_passe" required autocomplete="current-password">
            </div>

            <input type="submit" name="valider" value="Connexion">
        </form>

        <div class="text-muted mt-20 info-test">
            <strong>Identifiants de test :</strong><br>
            Utilisateur : <code>admin</code><br>
            Mot de passe : <code>1234</code>
        </div>
        
    </div>
</div>

<?= $this->endSection() ?>