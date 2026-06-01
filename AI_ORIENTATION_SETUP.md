# Système de Rapport d'Orientation Basé sur l'IA

## Configuration

### 1. Clé API Gemini

Assurez-vous que votre fichier `.env` contient la clé API Gemini :

```env
GEMINI_API_KEY=votre_cle_api_gemini_ici
GEMINI_MODEL=gemini-1.5-flash
```

Pour obtenir une clé API :
1. Visitez https://ai.google.dev
2. Créez un projet et générez une clé API
3. Copiez la clé dans votre fichier `.env`

### 2. Architecture du Système

Le système utilise la classe `AIOrientationService` pour :

1. **Collecter les données** :
   - Données de l'étudiant (nom, niveau, âge, ville)
   - Résultats du test diagnostique
   - Résultats du test de personnalité

2. **Préparer le prompt** :
   - Formate les données de manière cohérente
   - Construit un prompt structuré pour l'IA
   - Spécifie le format JSON attendu

3. **Appeler l'API Gemini** :
   - Envoie le prompt à Gemini
   - Récupère la réponse JSON
   - Gère les erreurs

4. **Traiter la réponse** :
   - Parse le JSON retourné
   - Formate les données pour la vue
   - Fournit un rapport de secours en cas d'erreur

### 3. Fichiers Impliqués

- **Service Principal** : `App\Services\Orientation\AIOrientationService.php`
- **Page Filament** : `App\Filament\Pages\RapportOrientationComplet.php`
- **Vue** : `resources/views/filament/pages/rapport-orientation-complet.blade.php`
- **Données de Référence** : `App\Services\Orientation\MoroccanEducationReference.php`

### 4. Utilisation dans le Code

```php
use App\Services\Orientation\AIOrientationService;

// En assumant que vous avez les modèles chargés
$service = new AIOrientationService($diagnostic, $personality, $user);
$report = $service->generateFullReport();

// $report contient les 11 sections du rapport d'orientation
```

### 5. Structure du Rapport Retourné

```php
[
    'global_summary' => [...],           // Profil, score, forces, améliorations
    'competences_analysis' => [...],     // 10 domaines de compétences (%)
    'personality_analysis' => [...],     // Profil de personnalité
    'strengths_radar' => [...],         // Forces majeures et compétences à développer
    'compatibility_filiales' => [...],  // Compatibilité avec 11 filières marocaines
    'orientation_recommended' => [...], // 3 choix d'orientation
    'schools_recommended' => [...],     // Écoles marocaines recommandées
    'compatible_careers' => [...],      // Top 10 métiers
    'success_predictions' => [...],     // Prévisions de réussite
    'action_plan' => [...],             // Plan d'action sur 3 périodes
    'motivation_message' => '...'       // Message personnalisé motivant
]
```

### 6. Accès à la Page

La page est accessible via Filament :
- URL : `/admin/rapport-orientation-complet`
- Conditions d'accès :
  - Utilisateur doit être authentifié
  - Doit avoir complété TOUS les deux tests
  - Tests doivent avoir le statut 'completed'

### 7. Gestion des Erreurs

En cas d'erreur API :
- Un rapport de secours est fourni
- Les erreurs sont loggées dans `storage/logs/`
- L'utilisateur voit un message polite demandant de réessayer

### 8. Personnalisation du Prompt

Pour modifier la structure du rapport, éditez la méthode `buildPrompt()` dans `AIOrientationService.php`.

La structure JSON doit être cohérente avec :
- La méthode `formatResponse()` 
- Le template Blade `rapport-orientation-complet.blade.php`

### 9. Performance

- Temps de réponse : 3-10 secondes (dépend d'API Gemini)
- Cache recommandé pour les utilisateurs fréquents
- Considérez un rate limiting pour les appels API

### 10. Sécurité

- La clé API ne doit jamais être exposée en front-end
- Toujours utiliser les variables d'environnement
- Loggez les tentatives d'accès non autorisées
- Limitez les appels API par utilisateur
