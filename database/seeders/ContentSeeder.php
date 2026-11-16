<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Content;

class ContentSeeder extends Seeder
{
    public function run(): void
    {
        $contents = [

            // =========================
            // PAGE À PROPOS
            // =========================

            [
                'content_key' => 'about.header.eyebrow',
                'content_value' => 'Qui sommes-nous ?',
                'type' => 'text',
                'page' => 'about',
            ],
            [
                'content_key' => 'about.header.title',
                'content_value' => 'Solidarités Plus RDC (SOLIPLUS)',
                'type' => 'text',
                'page' => 'about',
            ],
            [
                'content_key' => 'about.introduction',
                'content_value' => 'Solidarités Plus RDC est une organisation non gouvernementale engagée dans l’accompagnement des communautés vulnérables et le développement durable.',
                'type' => 'text',
                'page' => 'about',
            ],

            // MISSION
            [
                'content_key' => 'about.mission.title',
                'content_value' => 'Notre mission',
                'type' => 'text',
                'page' => 'about',
            ],
            [
                'content_key' => 'about.mission.description',
                'content_value' => 'Contribuer à l’amélioration des conditions de vie des populations vulnérables à travers des interventions adaptées et durables.',
                'type' => 'text',
                'page' => 'about',
            ],

            // VISION
            [
                'content_key' => 'about.vision.title',
                'content_value' => 'Notre vision',
                'type' => 'text',
                'page' => 'about',
            ],
            [
                'content_key' => 'about.vision.description',
                'content_value' => 'Construire des communautés résilientes, inclusives et capables de participer activement à leur développement.',
                'type' => 'text',
                'page' => 'about',
            ],

            // DOMAINES
            [
                'content_key' => 'about.domains.title',
                'content_value' => 'Nos domaines d’intervention',
                'type' => 'text',
                'page' => 'about',
            ],
            [
                'content_key' => 'about.domains.description',
                'content_value' => 'Protection, santé, droits humains et autonomisation socio-économique.',
                'type' => 'text',
                'page' => 'about',
            ],

            // APPROCHE
            [
                'content_key' => 'about.approach.title',
                'content_value' => 'Notre approche de terrain',
                'type' => 'text',
                'page' => 'about',
            ],
            [
                'content_key' => 'about.approach.description',
                'content_value' => 'Nous privilégions une approche participative, communautaire et centrée sur les besoins des bénéficiaires.',
                'type' => 'text',
                'page' => 'about',
            ],

            // SECTION PRIORITAIRE
            [
                'content_key' => 'about.priority.eyebrow',
                'content_value' => 'Notre engagement',
                'type' => 'text',
                'page' => 'about',
            ],
            [
                'content_key' => 'about.priority.title',
                'content_value' => 'Agir auprès des communautés',
                'type' => 'text',
                'page' => 'about',
            ],
            [
                'content_key' => 'about.priority.description',
                'content_value' => 'Nous travaillons avec les communautés pour répondre aux défis auxquels elles sont confrontées.',
                'type' => 'text',
                'page' => 'about',
            ],

            // CHIFFRES CLÉS
            [
                'content_key' => 'about.impact.experience',
                'content_value' => '20+',
                'type' => 'number',
                'page' => 'about',
            ],
            [
                'content_key' => 'about.impact.projects',
                'content_value' => '50+',
                'type' => 'number',
                'page' => 'about',
            ],
            [
                'content_key' => 'about.impact.collaborators',
                'content_value' => '500+',
                'type' => 'number',
                'page' => 'about',
            ],
        ];

        foreach ($contents as $content) {
            Content::updateOrCreate(
                ['content_key' => $content['content_key']],
                [
                    'content_value' => $content['content_value'],
                    'type' => $content['type'],
                    'page' => $content['page'],
                    'is_active' => true,
                ]
            );
        }
    }
}
