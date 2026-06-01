<?php

namespace App\Console\Commands;

use App\Models\AcademicDiagnostic;
use App\Models\TestPersonnalise;
use App\Models\User;
use App\Services\Orientation\AIOrientationService;
use Illuminate\Console\Command;

class TestAIOrientationReport extends Command
{
    protected $signature = 'test:orientation-report {user_id=1}';
    protected $description = 'Test the AI orientation report generation';

    public function handle()
    {
        $userId = $this->argument('user_id');
        $user = User::find($userId);

        if (!$user) {
            $this->error("User with ID {$userId} not found");
            return 1;
        }

        $diagnostic = AcademicDiagnostic::where('user_id', $userId)
            ->latest('submitted_at')
            ->first();

        $personality = TestPersonnalise::where('user_id', $userId)
            ->latest('submitted_at')
            ->first();

        if (!$diagnostic) {
            $this->error("No diagnostic test found for user {$userId}");
            return 1;
        }

        if (!$personality) {
            $this->error("No personality test found for user {$userId}");
            return 1;
        }

        if (!$diagnostic->isCompleted() || !$personality->isCompleted()) {
            $this->error("Tests are not completed");
            return 1;
        }

        try {
            $this->info("Generating orientation report for {$user->name}...");
            
            $service = new AIOrientationService($diagnostic, $personality, $user);
            $report = $service->generateFullReport();

            $this->line('');
            $this->info('✓ Report generated successfully!');
            $this->line('');

            // Afficher un résumé
            if (isset($report['global_summary'])) {
                $summary = $report['global_summary'];
                $this->line('RÉSUMÉ GLOBAL:');
                $this->line("  Profil: {$summary['dominant_profile']}");
                $this->line("  Score: {$summary['global_score']}/100");
                $this->line("  Potentiel: {$summary['overall_potential']}");
                $this->line('');
            }

            if (isset($report['orientation_recommended'])) {
                $this->line('ORIENTATIONS RECOMMANDÉES:');
                foreach ($report['orientation_recommended'] as $index => $orientation) {
                    $rank = $index + 1;
                    $this->line("  {$rank}. {$orientation['filiere']} ({$orientation['compatibility']}%)");
                }
                $this->line('');
            }

            if (isset($report['action_plan'])) {
                $this->line('PLAN D\'ACTION:');
                $this->line('  Court terme (3 mois):');
                foreach ($report['action_plan']['short_term'] as $action) {
                    $this->line("    - {$action}");
                }
                $this->line('');
            }

            $this->info('Report structure validated!');
            return 0;

        } catch (\Exception $e) {
            $this->error("Error generating report: " . $e->getMessage());
            return 1;
        }
    }
}
