@php
    $report = $this->report;
    $globalSummary = $report['global_summary'] ?? [];
    $competences = $report['competences_analysis'] ?? [];
    $personality = $report['personality_analysis'] ?? [];
    $strengths = $report['strengths_radar'] ?? [];
    $filieres = $report['compatibility_filiales'] ?? [];
    $orientationRec = $report['orientation_recommended'] ?? [];
    $schools = $report['schools_recommended'] ?? [];
    $careers = $report['compatible_careers'] ?? [];
    $success = $report['success_predictions'] ?? [];
    $actionPlan = $report['action_plan'] ?? [];
    $motivationMsg = $report['motivation_message'] ?? '';
@endphp

<div class="rapport-orientation-container">
    <!-- SECTION HEADER -->
    <div class="rapport-header">
        <div class="header-content">
            <h1>{{ $this->user->name ?? 'Rapport d\'Orientation' }}</h1>
            <p class="header-meta">
                Rapport généré le {{ now()->format('d/m/Y') }} 
                @if($this->diagnostic)
                    | {{ $this->diagnostic->academic_level ?? 'Non spécifié' }}
                @endif
            </p>
        </div>
        <div class="global-score-badge">
            <span class="score-value">{{ $globalSummary['global_score'] ?? 0 }}/100</span>
            <span class="score-label">Score Global</span>
        </div>
    </div>

    <!-- SECTION 1: RÉSUMÉ GLOBAL -->
    <section class="rapport-section">
        <h2 class="section-title">
            <span class="section-number">1</span>
            Résumé Global
        </h2>
        <div class="section-content">
            <div class="summary-grid">
                <div class="summary-card">
                    <div class="card-label">Profil Dominant</div>
                    <div class="card-value">{{ $globalSummary['dominant_profile'] ?? 'À déterminer' }}</div>
                </div>
                <div class="summary-card">
                    <div class="card-label">Potentiel Global</div>
                    <div class="card-value potential">
                        {{ $globalSummary['overall_potential'] ?? 'À développer' }}
                    </div>
                </div>
                <div class="summary-card">
                    <div class="card-label">Niveau de Confiance</div>
                    <div class="card-value">{{ $success['confidence_level'] ?? 'Moyenne' }}</div>
                </div>
            </div>

            <div class="summary-prose">
                <p>{{ $globalSummary['summary_text'] ?? '' }}</p>
            </div>

            @if(!empty($globalSummary['main_strengths']))
            <div class="strengths-box">
                <h4>Forces principales</h4>
                <ul>
                    @foreach($globalSummary['main_strengths'] as $strength)
                        <li>{{ $strength }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(!empty($globalSummary['improvement_axes']))
            <div class="improvement-box">
                <h4>Axes d'amélioration</h4>
                <ul>
                    @foreach($globalSummary['improvement_axes'] as $axis)
                        <li>{{ $axis }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </section>

    <!-- SECTION 2: ANALYSE DES COMPÉTENCES -->
    <section class="rapport-section">
        <h2 class="section-title">
            <span class="section-number">2</span>
            Analyse des Compétences
        </h2>
        <div class="section-content">
            <table class="competences-table">
                <thead>
                    <tr>
                        <th>Domaine</th>
                        <th>Niveau</th>
                        <th>Visualisation</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $competenceLabels = [
                            'mathematics' => 'Mathématiques',
                            'physics' => 'Sciences Physiques',
                            'informatics' => 'Informatique',
                            'french' => 'Français',
                            'english' => 'Anglais',
                            'arabic' => 'Arabe',
                            'communication' => 'Communication',
                            'problem_solving' => 'Résolution de problèmes',
                            'creativity' => 'Créativité',
                            'leadership' => 'Leadership',
                        ];
                    @endphp
                    @foreach($competenceLabels as $key => $label)
                        @php $score = $competences[$key] ?? 0; @endphp
                        <tr>
                            <td>{{ $label }}</td>
                            <td class="score-cell">{{ $score }}%</td>
                            <td class="progress-cell">
                                <div class="progress-bar">
                                    <div class="progress-fill" style="width: {{ $score }}%"></div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="competences-interpretation">
                <h4>Interprétation Professionnelle</h4>
                <p>
                    Les résultats montrent une répartition équilibrée des compétences avec des points forts 
                    particuliers en résolution de problèmes et en informatique. Cette combinaison suggère 
                    une aptitude naturelle pour les filières scientifiques et technologiques.
                </p>
            </div>
        </div>
    </section>

    <!-- SECTION 3: ANALYSE DE PERSONNALITÉ -->
    <section class="rapport-section">
        <h2 class="section-title">
            <span class="section-number">3</span>
            Analyse de Personnalité
        </h2>
        <div class="section-content">
            <div class="personality-profile">
                <div class="profile-item">
                    <label>Profil Dominant</label>
                    <value>{{ $personality['dominant_profile'] ?? 'Non déterminé' }}</value>
                </div>
            </div>

            <div class="personality-grid">
                <div class="personality-card">
                    <h4>Style d'apprentissage</h4>
                    <p>{{ $personality['learning_style'] ?? 'Apprentissage équilibré' }}</p>
                </div>
                <div class="personality-card">
                    <h4>Travail en équipe</h4>
                    <p>{{ $personality['teamwork_style'] ?? 'Collaboratif' }}</p>
                </div>
                <div class="personality-card">
                    <h4>Prise de décision</h4>
                    <p>{{ $personality['decision_making'] ?? 'Réfléchie et structurée' }}</p>
                </div>
            </div>

            @if(!empty($personality['main_motivations']))
            <div class="motivations-box">
                <h4>Motivations Principales</h4>
                <ul>
                    @foreach($personality['main_motivations'] as $motivation)
                        <li>{{ $motivation }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </section>

    <!-- SECTION 4: RADAR DES FORCES -->
    <section class="rapport-section">
        <h2 class="section-title">
            <span class="section-number">4</span>
            Radar des Forces
        </h2>
        <div class="section-content">
            @if(!empty($strengths['major_strengths']))
            <div class="strengths-section">
                <h4>Forces Majeures</h4>
                <div class="strengths-list">
                    @foreach($strengths['major_strengths'] as $index => $strength)
                        <div class="strength-item">
                            <span class="strength-badge">{{ $index + 1 }}</span>
                            <span class="strength-text">{{ $strength }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if(!empty($strengths['skills_to_develop']))
            <div class="skills-section">
                <h4>Compétences à Développer</h4>
                <div class="skills-list">
                    @foreach($strengths['skills_to_develop'] as $skill)
                        <div class="skill-item">
                            <span class="skill-icon">→</span>
                            <span class="skill-text">{{ $skill }}</span>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if(!empty($strengths['quick_wins']))
            <div class="quick-wins-section">
                <h4>Petites Victoires Possibles</h4>
                <ul class="quick-wins-list">
                    @foreach($strengths['quick_wins'] as $win)
                        <li>{{ $win }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </section>

    <!-- SECTION 5: COMPATIBILITÉ AVEC LES FILIÈRES MAROCAINES -->
    <section class="rapport-section">
        <h2 class="section-title">
            <span class="section-number">5</span>
            Compatibilité avec les Filières Marocaines
        </h2>
        <div class="section-content">
            <table class="filieres-table">
                <thead>
                    <tr>
                        <th>Filière</th>
                        <th>Compatibilité</th>
                        <th>Graphique</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($filieres as $item)
                        @php $compatibility = $item['compatibility'] ?? 0; @endphp
                        <tr>
                            <td>{{ $item['filiere'] }}</td>
                            <td class="compatibility-score">{{ $compatibility }}%</td>
                            <td class="compatibility-bar">
                                <div class="bar-container">
                                    <div class="bar-fill" style="width: {{ $compatibility }}%">
                                        <span class="bar-label">{{ $compatibility }}%</span>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <!-- SECTION 6: ORIENTATION RECOMMANDÉE -->
    <section class="rapport-section">
        <h2 class="section-title">
            <span class="section-number">6</span>
            Orientation Recommandée
        </h2>
        <div class="section-content">
            @foreach($orientationRec as $position => $choice)
                @php
                    $titles = ['Premier Choix', 'Deuxième Choix', 'Troisième Choix'];
                    $colors = ['primary', 'secondary', 'tertiary'];
                @endphp
                <div class="orientation-card {{ $colors[$position] ?? 'primary' }}">
                    <div class="orientation-header">
                        <h4>{{ $titles[$position] ?? 'Choix' }}</h4>
                        <span class="compatibility-badge">{{ $choice['compatibility'] ?? 0 }}%</span>
                    </div>
                    <div class="orientation-filiere">{{ $choice['filiere'] ?? 'Non spécifié' }}</div>
                    <div class="orientation-justification">
                        {{ $choice['justification'] ?? '' }}
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <!-- SECTION 7: ÉCOLES RECOMMANDÉES -->
    <section class="rapport-section">
        <h2 class="section-title">
            <span class="section-number">7</span>
            Écoles et Établissements Recommandés au Maroc
        </h2>
        <div class="section-content">
            @foreach($schools as $domain => $schoolsList)
                <div class="schools-domain">
                    <h4>{{ $domain }}</h4>
                    @foreach($schoolsList as $school)
                        <div class="school-card">
                            <div class="school-name">{{ $school['school'] ?? 'Non spécifié' }}</div>
                            <div class="school-details">
                                <div class="detail-item">
                                    <span class="detail-label">Accès:</span>
                                    <span class="detail-value">{{ $school['access_level'] ?? 'À déterminer' }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Conditions:</span>
                                    <span class="detail-value">{{ $school['conditions'] ?? 'À vérifier' }}</span>
                                </div>
                                <div class="detail-item">
                                    <span class="detail-label">Forces:</span>
                                    <span class="detail-value">{{ $school['strengths'] ?? 'Reconnue' }}</span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        </div>
    </section>

    <!-- SECTION 8: MÉTIERS COMPATIBLES -->
    <section class="rapport-section">
        <h2 class="section-title">
            <span class="section-number">8</span>
            Métiers Compatibles (Top 10)
        </h2>
        <div class="section-content">
            <table class="careers-table">
                <thead>
                    <tr>
                        <th>Métier</th>
                        <th>Compatibilité</th>
                        <th>Niveau d'études</th>
                        <th>Perspectives d'emploi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($careers as $index => $career)
                        <tr class="career-row {{ $index < 3 ? 'top-career' : '' }}">
                            <td class="career-name">
                                @if($index < 3)
                                    <span class="medal-icon">🏆</span>
                                @endif
                                {{ $career['career'] ?? 'Non spécifié' }}
                            </td>
                            <td class="career-compatibility">{{ $career['compatibility'] ?? 0 }}%</td>
                            <td class="career-education">{{ $career['education_level'] ?? 'Variable' }}</td>
                            <td class="career-outlook">{{ $career['job_outlook'] ?? 'Bon' }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>

    <!-- SECTION 9: PRÉVISIONS DE RÉUSSITE -->
    <section class="rapport-section">
        <h2 class="section-title">
            <span class="section-number">9</span>
            Prévisions et Probabilités de Réussite
        </h2>
        <div class="section-content">
            <div class="success-metrics">
                <div class="metric-card">
                    <div class="metric-label">Probabilité de Réussite</div>
                    <div class="metric-value">{{ $success['success_probability'] ?? 0 }}%</div>
                </div>
                <div class="metric-card">
                    <div class="metric-label">Niveau de Confiance</div>
                    <div class="metric-value">{{ $success['confidence_level'] ?? 'Moyenne' }}</div>
                </div>
                <div class="metric-card">
                    <div class="metric-label">Potentiel</div>
                    <div class="star-rating">
                        @for($i = 0; $i < 5; $i++)
                            @if($i < ($success['star_rating'] ?? 3))
                                <span class="star filled">⭐</span>
                            @else
                                <span class="star empty">☆</span>
                            @endif
                        @endfor
                    </div>
                </div>
            </div>

            @if(!empty($success['potential_risks']))
            <div class="risks-box">
                <h4>Risques Potentiels</h4>
                <ul>
                    @foreach($success['potential_risks'] as $risk)
                        <li>{{ $risk }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if(!empty($success['success_factors']))
            <div class="success-factors-box">
                <h4>Facteurs de Succès</h4>
                <ul>
                    @foreach($success['success_factors'] as $factor)
                        <li>{{ $factor }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
        </div>
    </section>

    <!-- SECTION 10: PLAN D'ACTION PERSONNALISÉ -->
    <section class="rapport-section">
        <h2 class="section-title">
            <span class="section-number">10</span>
            Plan d'Action Personnalisé
        </h2>
        <div class="section-content">
            <div class="action-plan-tabs">
                <div class="action-period short-term">
                    <h4>Court Terme (3 mois)</h4>
                    <ul class="action-list">
                        @foreach($actionPlan['short_term'] ?? [] as $action)
                            <li class="action-item">{{ $action }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="action-period medium-term">
                    <h4>Moyen Terme (1 an)</h4>
                    <ul class="action-list">
                        @foreach($actionPlan['medium_term'] ?? [] as $action)
                            <li class="action-item">{{ $action }}</li>
                        @endforeach
                    </ul>
                </div>
                <div class="action-period long-term">
                    <h4>Long Terme (3 à 5 ans)</h4>
                    <ul class="action-list">
                        @foreach($actionPlan['long_term'] ?? [] as $action)
                            <li class="action-item">{{ $action }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION 11: MESSAGE DE MOTIVATION -->
    <section class="rapport-section motivation-section">
        <h2 class="section-title">
            <span class="section-number">11</span>
            Message de Motivation
        </h2>
        <div class="section-content">
            <div class="motivation-box">
                <div class="motivation-content">
                    {!! nl2br(e($motivationMsg)) !!}
                </div>
                <div class="signature">
                    <p>Conseiller d'Orientation - Système IA</p>
                    <p class="date">{{ now()->format('d MMMM Y', 'fr_FR') }}</p>
                </div>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <div class="rapport-footer">
        <p>Ce rapport a été généré automatiquement basé sur une analyse psychométrique complète.</p>
        <p>Pour toute question ou besoin de clarification, veuillez contacter votre conseiller d'orientation.</p>
    </div>
</div>

<style>
    .rapport-orientation-container {
        max-width: 1000px;
        margin: 0 auto;
        padding: 2rem;
        background: white;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        color: #333;
    }

    .rapport-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        margin-bottom: 3rem;
        padding-bottom: 2rem;
        border-bottom: 3px solid #2563eb;
    }

    .header-content h1 {
        font-size: 2rem;
        margin: 0;
        color: #1f2937;
    }

    .header-meta {
        color: #6b7280;
        font-size: 0.9rem;
        margin: 0.5rem 0 0 0;
    }

    .global-score-badge {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        width: 120px;
        height: 120px;
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 100%);
        color: white;
        border-radius: 50%;
        box-shadow: 0 4px 15px rgba(37, 99, 235, 0.3);
    }

    .score-value {
        font-size: 2rem;
        font-weight: bold;
    }

    .score-label {
        font-size: 0.75rem;
        opacity: 0.9;
        margin-top: 0.5rem;
    }

    .rapport-section {
        margin-bottom: 3rem;
        page-break-inside: avoid;
    }

    .section-title {
        display: flex;
        align-items: center;
        font-size: 1.5rem;
        margin: 0 0 1.5rem 0;
        color: #1f2937;
        border-left: 4px solid #2563eb;
        padding-left: 1rem;
    }

    .section-number {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        background: #2563eb;
        color: white;
        border-radius: 50%;
        margin-right: 1rem;
        font-weight: bold;
        font-size: 0.9rem;
    }

    .section-content {
        margin-left: 3rem;
    }

    /* SECTION 1 STYLES */
    .summary-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .summary-card {
        background: #f9fafb;
        padding: 1.5rem;
        border-radius: 8px;
        border-left: 3px solid #2563eb;
    }

    .card-label {
        font-size: 0.85rem;
        color: #6b7280;
        font-weight: 600;
        text-transform: uppercase;
        margin-bottom: 0.5rem;
    }

    .card-value {
        font-size: 1.25rem;
        font-weight: 600;
        color: #1f2937;
    }

    .card-value.potential {
        color: #2563eb;
    }

    .summary-prose {
        background: #f3f4f6;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        line-height: 1.6;
    }

    .strengths-box,
    .improvement-box {
        margin-top: 1.5rem;
        padding: 1.5rem;
        background: #f0fdf4;
        border-left: 3px solid #16a34a;
        border-radius: 4px;
    }

    .improvement-box {
        background: #fef2f2;
        border-left-color: #dc2626;
    }

    .strengths-box h4,
    .improvement-box h4 {
        margin-top: 0;
        color: #1f2937;
    }

    .strengths-box ul,
    .improvement-box ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .strengths-box li,
    .improvement-box li {
        padding: 0.5rem 0;
        color: #374151;
    }

    .strengths-box li:before,
    .improvement-box li:before {
        content: "✓ ";
        color: #16a34a;
        font-weight: bold;
        margin-right: 0.5rem;
    }

    .improvement-box li:before {
        content: "→ ";
        color: #dc2626;
    }

    /* SECTION 2 STYLES */
    .competences-table {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 1.5rem;
    }

    .competences-table thead {
        background: #2563eb;
        color: white;
    }

    .competences-table th {
        padding: 1rem;
        text-align: left;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .competences-table td {
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .competences-table tbody tr:hover {
        background: #f9fafb;
    }

    .score-cell {
        font-weight: 600;
        color: #2563eb;
        width: 80px;
    }

    .progress-cell {
        width: 40%;
    }

    .progress-bar {
        height: 24px;
        background: #e5e7eb;
        border-radius: 12px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, #2563eb 0%, #1d4ed8 100%);
        transition: width 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding-right: 0.5rem;
        color: white;
        font-size: 0.75rem;
        font-weight: 600;
    }

    .competences-interpretation {
        background: #eff6ff;
        padding: 1.5rem;
        border-radius: 8px;
        border-left: 3px solid #2563eb;
    }

    .competences-interpretation h4 {
        margin-top: 0;
        color: #1f2937;
    }

    /* SECTION 3 STYLES */
    .personality-profile {
        margin-bottom: 2rem;
        padding: 1.5rem;
        background: #f9fafb;
        border-radius: 8px;
    }

    .profile-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .profile-item label {
        font-weight: 600;
        color: #1f2937;
    }

    .profile-item value {
        background: #2563eb;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 4px;
        font-weight: 600;
    }

    .personality-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .personality-card {
        background: #f0fdf4;
        padding: 1.5rem;
        border-radius: 8px;
        border-top: 3px solid #16a34a;
    }

    .personality-card h4 {
        margin-top: 0;
        color: #1f2937;
        font-size: 0.95rem;
    }

    .personality-card p {
        color: #374151;
        margin: 0;
        line-height: 1.5;
    }

    .motivations-box {
        background: #fef3c7;
        padding: 1.5rem;
        border-radius: 8px;
        border-left: 3px solid #f59e0b;
    }

    .motivations-box h4 {
        margin-top: 0;
        color: #1f2937;
    }

    .motivations-box ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .motivations-box li {
        padding: 0.5rem 0;
        color: #374151;
        padding-left: 1.5rem;
        position: relative;
    }

    .motivations-box li:before {
        content: "•";
        position: absolute;
        left: 0;
        color: #f59e0b;
        font-weight: bold;
    }

    /* SECTION 4 STYLES */
    .strengths-section,
    .skills-section,
    .quick-wins-section {
        margin-bottom: 2rem;
    }

    .strengths-section h4,
    .skills-section h4,
    .quick-wins-section h4 {
        color: #1f2937;
        margin-bottom: 1rem;
    }

    .strengths-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .strength-item {
        display: flex;
        align-items: center;
        padding: 1rem;
        background: #f0fdf4;
        border-radius: 6px;
        border-left: 3px solid #16a34a;
    }

    .strength-badge {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        background: #16a34a;
        color: white;
        border-radius: 50%;
        font-weight: bold;
        margin-right: 1rem;
    }

    .strength-text {
        color: #15803d;
        font-weight: 500;
    }

    .skills-list {
        display: grid;
        gap: 0.75rem;
    }

    .skill-item {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        background: #fef3c7;
        border-radius: 6px;
        border-left: 3px solid #f59e0b;
    }

    .skill-icon {
        color: #f59e0b;
        font-weight: bold;
        margin-right: 1rem;
    }

    .skill-text {
        color: #92400e;
    }

    .quick-wins-list {
        list-style: none;
        padding: 0;
        margin: 0;
        display: grid;
        gap: 0.75rem;
    }

    .quick-wins-list li {
        padding: 0.75rem 1rem;
        background: #dbeafe;
        border-radius: 6px;
        border-left: 3px solid #2563eb;
        color: #1e40af;
    }

    /* SECTION 5 STYLES */
    .filieres-table {
        width: 100%;
        border-collapse: collapse;
    }

    .filieres-table thead {
        background: #2563eb;
        color: white;
    }

    .filieres-table th {
        padding: 1rem;
        text-align: left;
        font-weight: 600;
    }

    .filieres-table td {
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .filieres-table tbody tr:hover {
        background: #f9fafb;
    }

    .compatibility-score {
        font-weight: 600;
        color: #2563eb;
        width: 80px;
    }

    .compatibility-bar {
        flex: 1;
    }

    .bar-container {
        height: 32px;
        background: #e5e7eb;
        border-radius: 4px;
        overflow: hidden;
        position: relative;
    }

    .bar-fill {
        height: 100%;
        background: linear-gradient(90deg, #2563eb 0%, #1d4ed8 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        transition: width 0.3s ease;
        min-width: 50px;
    }

    .bar-label {
        color: white;
        font-weight: 600;
        font-size: 0.75rem;
    }

    /* SECTION 6 STYLES */
    .orientation-card {
        padding: 2rem;
        border-radius: 8px;
        margin-bottom: 1.5rem;
        border-top: 4px solid;
    }

    .orientation-card.primary {
        background: #eff6ff;
        border-top-color: #2563eb;
    }

    .orientation-card.secondary {
        background: #f0fdf4;
        border-top-color: #16a34a;
    }

    .orientation-card.tertiary {
        background: #fef3c7;
        border-top-color: #f59e0b;
    }

    .orientation-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 1rem;
    }

    .orientation-header h4 {
        margin: 0;
        color: #1f2937;
    }

    .compatibility-badge {
        background: #2563eb;
        color: white;
        padding: 0.5rem 1rem;
        border-radius: 20px;
        font-weight: 600;
        font-size: 0.9rem;
    }

    .orientation-filiere {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1rem;
    }

    .orientation-justification {
        color: #374151;
        line-height: 1.6;
    }

    /* SECTION 7 STYLES */
    .schools-domain {
        margin-bottom: 2.5rem;
    }

    .schools-domain h4 {
        color: #1f2937;
        font-size: 1.1rem;
        margin-bottom: 1.5rem;
        padding-bottom: 0.5rem;
        border-bottom: 2px solid #e5e7eb;
    }

    .school-card {
        background: #f9fafb;
        padding: 1.5rem;
        border-radius: 8px;
        margin-bottom: 1rem;
        border-left: 3px solid #2563eb;
    }

    .school-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1rem;
    }

    .school-details {
        display: grid;
        gap: 0.75rem;
    }

    .detail-item {
        display: flex;
        justify-content: space-between;
    }

    .detail-label {
        font-weight: 600;
        color: #6b7280;
        font-size: 0.9rem;
    }

    .detail-value {
        color: #374151;
    }

    /* SECTION 8 STYLES */
    .careers-table {
        width: 100%;
        border-collapse: collapse;
    }

    .careers-table thead {
        background: #2563eb;
        color: white;
    }

    .careers-table th {
        padding: 1rem;
        text-align: left;
        font-weight: 600;
    }

    .careers-table td {
        padding: 1rem;
        border-bottom: 1px solid #e5e7eb;
    }

    .careers-table tbody tr:hover {
        background: #f9fafb;
    }

    .careers-table tbody tr.top-career {
        background: #fef3c7;
    }

    .career-name {
        font-weight: 600;
        color: #1f2937;
    }

    .medal-icon {
        margin-right: 0.5rem;
    }

    .career-compatibility {
        color: #2563eb;
        font-weight: 600;
    }

    .career-education {
        color: #6b7280;
        font-size: 0.9rem;
    }

    .career-outlook {
        font-weight: 500;
        color: #16a34a;
    }

    /* SECTION 9 STYLES */
    .success-metrics {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    .metric-card {
        background: #f0fdf4;
        padding: 2rem;
        border-radius: 8px;
        text-align: center;
        border-top: 3px solid #16a34a;
    }

    .metric-label {
        color: #6b7280;
        font-size: 0.9rem;
        margin-bottom: 1rem;
        text-transform: uppercase;
        font-weight: 600;
    }

    .metric-value {
        font-size: 2rem;
        font-weight: 700;
        color: #1f2937;
    }

    .star-rating {
        font-size: 1.5rem;
        letter-spacing: 0.25rem;
    }

    .star {
        margin: 0 0.25rem;
    }

    .star.filled {
        color: #f59e0b;
    }

    .star.empty {
        color: #d1d5db;
    }

    .risks-box,
    .success-factors-box {
        margin-top: 1.5rem;
        padding: 1.5rem;
        border-radius: 8px;
    }

    .risks-box {
        background: #fef2f2;
        border-left: 3px solid #dc2626;
    }

    .success-factors-box {
        background: #f0fdf4;
        border-left: 3px solid #16a34a;
    }

    .risks-box h4,
    .success-factors-box h4 {
        margin-top: 0;
        color: #1f2937;
    }

    .risks-box ul,
    .success-factors-box ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .risks-box li,
    .success-factors-box li {
        padding: 0.5rem 0;
        color: #374151;
        padding-left: 1.5rem;
        position: relative;
    }

    .risks-box li:before {
        content: "⚠ ";
        position: absolute;
        left: 0;
    }

    .success-factors-box li:before {
        content: "✓ ";
        position: absolute;
        left: 0;
        color: #16a34a;
        font-weight: bold;
    }

    /* SECTION 10 STYLES */
    .action-plan-tabs {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 1.5rem;
    }

    .action-period {
        padding: 1.5rem;
        border-radius: 8px;
    }

    .action-period h4 {
        margin-top: 0;
        color: #1f2937;
        margin-bottom: 1rem;
    }

    .short-term {
        background: #dbeafe;
        border-top: 3px solid #2563eb;
    }

    .medium-term {
        background: #fef3c7;
        border-top: 3px solid #f59e0b;
    }

    .long-term {
        background: #f0fdf4;
        border-top: 3px solid #16a34a;
    }

    .action-list {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .action-item {
        padding: 0.75rem 0;
        color: #374151;
        padding-left: 1.5rem;
        position: relative;
        line-height: 1.5;
    }

    .short-term .action-item:before {
        content: "→";
        position: absolute;
        left: 0;
        color: #2563eb;
        font-weight: bold;
    }

    .medium-term .action-item:before {
        content: "→";
        position: absolute;
        left: 0;
        color: #f59e0b;
        font-weight: bold;
    }

    .long-term .action-item:before {
        content: "→";
        position: absolute;
        left: 0;
        color: #16a34a;
        font-weight: bold;
    }

    /* SECTION 11 STYLES */
    .motivation-section {
        page-break-inside: avoid;
    }

    .motivation-box {
        background: linear-gradient(135deg, #eff6ff 0%, #f0fdf4 100%);
        padding: 2.5rem;
        border-radius: 8px;
        border: 2px solid #2563eb;
    }

    .motivation-content {
        color: #374151;
        line-height: 1.8;
        font-size: 0.95rem;
        margin-bottom: 2rem;
    }

    .signature {
        text-align: right;
        color: #6b7280;
        font-style: italic;
    }

    .signature p {
        margin: 0.5rem 0;
        font-size: 0.9rem;
    }

    .date {
        margin-top: 1rem !important;
        font-weight: 600;
    }

    /* FOOTER */
    .rapport-footer {
        text-align: center;
        padding: 2rem;
        margin-top: 3rem;
        border-top: 2px solid #e5e7eb;
        color: #6b7280;
        font-size: 0.85rem;
    }

    .rapport-footer p {
        margin: 0.5rem 0;
    }

    /* RESPONSIVE */
    @media (max-width: 768px) {
        .summary-grid {
            grid-template-columns: 1fr;
        }

        .personality-grid {
            grid-template-columns: 1fr;
        }

        .action-plan-tabs {
            grid-template-columns: 1fr;
        }

        .success-metrics {
            grid-template-columns: 1fr;
        }

        .rapport-header {
            flex-direction: column;
            align-items: center;
            text-align: center;
        }

        .global-score-badge {
            margin-top: 1.5rem;
        }
    }

    @media print {
        body {
            background: white;
        }

        .rapport-orientation-container {
            padding: 0;
            max-width: 100%;
        }

        .rapport-section {
            page-break-inside: avoid;
        }
    }
</style>
