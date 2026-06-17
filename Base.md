# Création de la base SQLite – Caisse Supermarché (CodeIgniter 4)

## Etape 0 — Pré-requis : projet CI4 déjà initialisé
Si ce n'est pas encore fait (point "Initialiser Codeigniter" du TD) :
```
composer create-project codeigniter4/appstarter caisse_supermarche
cd caisse_supermarche
```

## Etape 1 — Configurer le fichier .env pour utiliser SQLite3
Ouvrir le fichier `.env` à la racine du projet (le dupliquer depuis `env` si besoin),
et décommenter/modifier la section base de données :

```
database.default.DBDriver = SQLite3
database.default.database = database.db
database.default.DBPrefix =
```

Avec ce driver, si on donne juste un nom de fichier (sans chemin), CodeIgniter
crée/cherche automatiquement le fichier dans `writable/database/database.db`.
Vérifier que le dossier `writable/database/` existe (sinon le créer).

## Etape 2 — Copier les fichiers de migration
Copier les 4 fichiers fournis dans `app/Database/Migrations/` de votre projet :
- `2026-06-17-100000_CreateProduitTable.php`
- `2026-06-17-100100_CreateCaisseTable.php`
- `2026-06-17-100200_CreateAchatTable.php`
- `2026-06-17-100300_CreateLigneAchatTable.php`

L'ordre des dates dans le nom de fichier est important : Produit et Caisse
doivent être créées avant Achat (clé étrangère id_caisse), et Achat avant
LigneAchat (clés étrangères id_achat et id_produit).

Si vous préférez générer les fichiers vous-même avec spark plutôt que copier
ceux fournis, la commande est :
```
php spark make:migration CreateProduitTable
```
(spark ajoute automatiquement l'horodatage devant le nom du fichier)

## Etape 3 — Exécuter les migrations
```
php spark migrate
```
Cette commande crée le fichier SQLite et les 4 tables dedans (produit,
caisse, achat, ligne_achat). On peut vérifier l'état avec :
```
php spark migrate:status
```

## Etape 4 — Copier les seeders
Copier les 3 fichiers fournis dans `app/Database/Seeds/` :
- `ProduitSeeder.php` (insère les 5 produits)
- `CaisseSeeder.php` (insère les 2 caisses)
- `DatabaseSeeder.php` (appelle les deux précédents)

## Etape 5 — Exécuter le seeder
```
php spark db:seed DatabaseSeeder
```

## Etape 6 — Vérifier le contenu de la base
Plusieurs façons de vérifier :
- Ouvrir `writable/database/database.db` avec "DB Browser for SQLite"
- Ou directement en ligne de commande : `sqlite3 writable/database/database.db "select * from produit;"`
- Ou créer rapidement une route/contrôleur de test qui fait
  `$produits = $this->db->table('produit')->get()->getResultArray();`

## Schéma retenu

| Table        | Colonnes principales                                                |
|--------------|------------------------------------------------------------------------|
| produit      | id, designation, prix, quantite_stock                               |
| caisse       | id, numero, libelle                                                 |
| achat        | id, id_caisse, date_achat, statut (en_cours/cloture), total          |
| ligne_achat  | id, id_achat, id_produit, quantite, prix_unitaire, montant           |

`ligne_achat` n'est pas demandée explicitement dans l'énoncé mais elle est
nécessaire pour stocker le détail d'un panier (un achat = plusieurs lignes
produit, comme dans le tableau Produit/Prix Unit/Qté/Montant de la maquette).
Le champ `statut` sur `achat` servira ensuite pour le bouton "clôturer achat"
du TD4.
