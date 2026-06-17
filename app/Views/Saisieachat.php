<?= $this->extend('Template') ?>

<?= $this->section('content') ?>

    <h4>Créer la page de saisie des achats</h4>

    <?php if (session()->getFlashdata('erreur')) : ?>
        <p class="error-message"><?= esc(session()->getFlashdata('erreur')) ?></p>
    <?php endif ?>

    <form method="post" action="achat/ajouter" class="form-saisie">
        <?= csrf_field() ?>

        <div class="form-group">
            <label for="id_produit">Produit</label>
            <select name="id_produit" id="id_produit" required>
                <option value="">-- Sélectionner --</option>
                <?php foreach ($produits as $produit) : ?>
                    <option value="<?= $produit['id'] ?>">
                        <?= esc($produit['designation']) ?>
                    </option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="form-group">
            <label for="quantite">Quantité</label>
            <input type="number" id="quantite" name="quantite" min="1" value="1">
        </div>

        <input type="submit" name="valider" value="Valider">
    </form>

    <h4 style="margin-top: 40px;">Panier</h4>

    <!-- Etape 2 : tableau du panier de l'achat en cours -->
    <table class="panier-table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Prix Unit</th>
                <th>Qté</th>
                <th>Montant</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($lignes as $ligne) : ?>
                <tr>
                    <td><?= esc($ligne['designation']) ?></td>
                    <td><?= number_format($ligne['prix_unitaire'], 0, ',', ' ') ?></td>
                    <td><?= $ligne['quantite'] ?></td>
                    <td><?= number_format($ligne['montant'], 0, ',', ' ') ?></td>
                </tr>
            <?php endforeach ?>
            <tr class="total-row">
                <td colspan="3" class="text-right"><strong>Total</strong></td>
                <td><strong><?= number_format($achat['total'], 0, ',', ' ') ?></strong></td>
            </tr>
        </tbody>
    </table>

    <?php if (!empty($lignes)) : ?>
        <div class="actions-buttons">
            <form method="post" action="achat/cloture" style="display: inline;">
                <?= csrf_field() ?>
                <input type="submit" name="cloture" value="Clôturer achat" class="btn-success">
            </form>
        </div>
    <?php endif ?>

<?= $this->endSection() ?>