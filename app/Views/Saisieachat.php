<?= $this->extend('Template') ?>

<?= $this->section('content') ?>

    <h4>Créer la page de saisie des achats</h4>

    <?php if (session()->getFlashdata('erreur')) : ?>
        <p style="color: red;"><?= esc(session()->getFlashdata('erreur')) ?></p>
    <?php endif ?>

    <form method="post" action="achat/ajouter">
        <?= csrf_field() ?>

        <table border="0" cellpadding="6">
            <tr>
                <td><label for="id_produit">Produit</label></td>
                <td>
                    <select name="id_produit" id="id_produit" required>
                        <option value="">-- Sélectionner --</option>
                        <?php foreach ($produits as $produit) : ?>
                            <option value="<?= $produit['id'] ?>">
                                <?= esc($produit['designation']) ?>
                            </option>
                        <?php endforeach ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td><label for="quantite">Quantité</label></td>
                <td><input type="number" id="quantite" name="quantite" min="1" value="1"></td>
            </tr>
        </table>

        <br>

        <input type="submit" name="valider" value="Valider">

    </form>

    <br><br>

    <!-- Etape 2 : tableau du panier de l'achat en cours -->
    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>Produit</th>
            <th>Prix Unit</th>
            <th>Qté</th>
            <th>Montant</th>
        </tr>
        <?php foreach ($lignes as $ligne) : ?>
            <tr>
                <td><?= esc($ligne['designation']) ?></td>
                <td><?= number_format($ligne['prix_unitaire'], 0, ',', ' ') ?></td>
                <td><?= $ligne['quantite'] ?></td>
                <td><?= number_format($ligne['montant'], 0, ',', ' ') ?></td>
            </tr>
        <?php endforeach ?>
        <tr>
            <td colspan="3" style="text-align: right;"><strong>Total</strong></td>
            <td><strong><?= number_format($achat['total'], 0, ',', ' ') ?></strong></td>
        </tr>
    </table>

<?= $this->endSection() ?>