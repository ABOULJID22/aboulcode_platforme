allez commencer **uniquement par le test diagnostique**, le plus efficace est d’organiser le développement en une chaîne claire : **table → model → enums/options → logique métier → resource Filament → page résultat → widgets**. Filament fournit bien les briques adaptées pour ce parcours, notamment le **Wizard** pour un formulaire multi-étapes, les **Stats Overview Widgets** pour les indicateurs, et les widgets liés à une page `View` via le record courant. [filamentphp](https://filamentphp.com/docs/4.x/widgets/stats-overview) 

## Plan global

Je vous conseille de découper votre travail en **8 blocs** au lieu de coder directement la Resource. Cela vous évite de mélanger structure de données, logique métier et interface dans un seul fichier.

### Ordre recommandé
1. Définir la structure métier du diagnostic.
2. Créer la table `academic_diagnostics`.
3. Créer le modèle `AcademicDiagnostic`.
4. Créer les enums / classes d’options.
5. Créer le service de calcul du résultat.
6. Créer la `AcademicDiagnosticResource`.
7. Créer la page d’affichage du résultat.
8. Ajouter les widgets de résumé et de statistiques.

***

## Étape 1 : Définir les données métier

Avant toute migration, fixez les champs que le test doit vraiment enregistrer. Le test diagnostique doit produire un **profil académique initial**, pas encore l’orientation finale.

### Champs à valider
- `user_id`
- `macro_cycle`
- `academic_level`
- `track_branch`
- `institution_type`
- `specialty_family`
- `specialty_label`
- `biof_language`
- `last_grade`
- `status`
- `result_code`
- `result_label`
- `result_summary`
- `submitted_at`

Je vous conseille aussi d’ajouter un champ `result_payload` en JSON pour stocker plus tard des détails exploitables sans modifier la structure de table.

***

## Étape 2 : Créer la table

Créez ensuite la migration `academic_diagnostics`. Cette table sera la base du test diagnostique et devra rester indépendante du futur test personnalisé.

### Ce que la table doit contenir
- les données scolaires saisies,
- le statut du test (`draft`, `completed`),
- le résultat calculé,
- la date de soumission.

Le fait de stocker déjà le résultat dans la table simplifie l’affichage ultérieur dans la Resource et dans les widgets.

***

## Étape 3 : Créer le modèle

Après la migration, créez le modèle `AcademicDiagnostic`. Ce modèle doit porter la structure Eloquent et une petite partie de logique applicative.

### Dans le modèle
- relation `belongsTo(User::class)`
- `fillable`
- `casts` pour enums, bool, json, decimal
- méthode utilitaire éventuelle comme `isCompleted()`

Je vous recommande de **ne pas mettre toute la logique de calcul directement dans le modèle**. Le mieux est de prévoir un service dédié pour le résultat.

***

## Étape 4 : Créer les enums et options

Ensuite, centralisez les listes utilisées par Filament. Le Wizard dépend de valeurs dynamiques, donc il faut que les options soient propres et réutilisables.

### Fichiers à créer
- `MacroCycleEnum`
- `AcademicLevelEnum`
- `TrackBranchEnum`
- `InstitutionTypeEnum`
- `SpecialtyFamilyEnum`
- `AcademicOptions` ou `AcademicDiagnosticOptions`

### Rôle de la classe d’options
Elle doit fournir des méthodes du style :
- `levelsByCycle($cycle)`
- `branchesByCycleOrLevel($cycle, $level)`
- `institutionTypesByCycle($cycle)`

Cette approche est plus souple qu’un gros enum unique, surtout avec la diversité des parcours marocains.

***

## Étape 5 : Créer le service de calcul

Avant la Resource, préparez la logique du diagnostic dans une classe métier, par exemple `AcademicDiagnosticResultService`. Cela vous évite de surcharger la page Filament.

### Ce service doit
- recevoir les données du test,
- appliquer vos règles métier,
- retourner :
  - `result_code`
  - `result_label`
  - `result_summary`
  - `result_payload`

Exemple : un élève `lycee + sciences maths` peut produire un code orienté vers ingénierie, data, IA, alors qu’un profil économie peut ouvrir vers gestion de projet, business intelligence ou ERP. Ce calcul doit se faire au moment de la soumission, puis être stocké.

***

## Étape 6 : Créer la Resource Filament

Une fois la base prête, créez `AcademicDiagnosticResource`. Pour un parcours pas à pas, Filament permet d’utiliser le composant **Wizard**, très adapté aux formulaires séquentiels. [filamentphp](https://filamentphp.com/docs/3.x/forms/layout/wizard)

### Pages de la Resource
- `ListAcademicDiagnostics`
- `CreateAcademicDiagnostic`
- `ViewAcademicDiagnostic`
- `EditAcademicDiagnostic` si vous autorisez la modification

### Formulaire Wizard conseillé
- Étape 1 : cycle
- Étape 2 : niveau
- Étape 3 : branche / type d’établissement
- Étape 4 : détails complémentaires
- Étape 5 : résumé avant validation

Vous pouvez aussi prévoir une étape finale de récapitulatif, ce qui est une bonne pratique pour ce genre de formulaire guidé. [filamentphp](https://filamentphp.com/docs/3.x/forms/layout/wizard)

***

## Étape 7 : Afficher le résultat

Quand l’utilisateur termine le test, redirigez-le vers la page `ViewAcademicDiagnostic`. C’est l’option la plus simple pour afficher un premier résultat sans créer encore une page frontend sur mesure.

### La page résultat doit afficher
- les réponses choisies,
- le profil scolaire détecté,
- le code de résultat,
- les domaines compatibles,
- un petit résumé d’interprétation.

Cette page sera ensuite la base de votre future fusion avec le test personnalisé.

***

## Étape 8 : Ajouter les widgets

Quand la Resource fonctionne, ajoutez les widgets. Filament propose les **Stats Overview Widgets**, très utiles pour afficher des statistiques synthétiques sans écrire une vue complexe. Sur une page `View`, le widget peut accéder au record courant via une propriété publique `$record`. [filamentexamples](https://filamentexamples.com/tutorial/chart-on-view-page-based-on-current-record)

### Widgets recommandés

#### Widget 1 : Résumé du diagnostic
- cycle
- niveau
- branche
- statut

#### Widget 2 : Résultat du test
- `result_code`
- domaine principal recommandé
- nombre de domaines suggérés

#### Widget 3 : Progression utilisateur
- nombre total de tests diagnostiques passés
- dernier test complété
- date de soumission

Si vous ajoutez une liste dans la Resource, vous pouvez aussi afficher des badges et icônes dans les colonnes pour rendre le tableau plus clair, par exemple pour `status` ou `macro_cycle`. [filamentphp](https://filamentphp.com/docs/2.x/tables/columns/badge)

***

## Organisation pratique des fichiers

Voici l’ordre de création que je vous recommande dans le projet :

| Ordre | Élément | Exemple |
|---|---|---|
| 1 | Migration | `create_academic_diagnostics_table` |
| 2 | Model | `AcademicDiagnostic` |
| 3 | Enums | `MacroCycleEnum`, `AcademicLevelEnum` |
| 4 | Options | `AcademicDiagnosticOptions` |
| 5 | Service | `AcademicDiagnosticResultService` |
| 6 | Resource | `AcademicDiagnosticResource` |
| 7 | Pages | `CreateAcademicDiagnostic`, `ViewAcademicDiagnostic` |
| 8 | Widgets | `AcademicDiagnosticOverview`, `AcademicDiagnosticResultStats` |

***

## Feuille de route courte

Si vous voulez avancer sans vous disperser, suivez exactement cet ordre de travail :

1. Valider les champs finaux du test diagnostique.
2. Créer la migration.
3. Migrer la base.
4. Créer le modèle.
5. Créer les enums et la classe d’options.
6. Créer le service de calcul du résultat.
7. Créer la Resource Filament.
8. Implémenter le Wizard.
9. Enregistrer le résultat à la soumission.
10. Construire la page `View`.
11. Ajouter les widgets.
