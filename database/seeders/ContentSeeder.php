<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Enums\Status as EnumStatus;
use App\Enums\ContentType as EnumContentType;
use App\Enums\ContentKey as EnumContentKey;
use App\Models\Content;
use DB;

class ContentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Content::firstOrCreate([
            'key' => EnumContentKey::PRIVACY_POLICY,
        ], [
            'type' => EnumContentType::PAGE,
            'status' => EnumStatus::ENABLED,
            'content' => [
                'en' => 'Privacy Policy',
                'fr' => 'Privacy Policy',
            ]
        ]);
        Content::firstOrCreate([
            'key' => EnumContentKey::TERMS_CONDITIONS,
        ], [
            'type' => EnumContentType::PAGE,
            'status' => EnumStatus::ENABLED,
            'content' => [
                'en' => 'Terms and Conditions',
                'fr' => 'Termes et Conditions',
            ]
        ]);
        Content::firstOrCreate([
            'key' => EnumContentKey::ABOUT_US,
        ], [
            'type' => EnumContentType::COMPONENT,
            'status' => EnumStatus::ENABLED,
            'content' => [
                'en' => 'artolog is an unoficial archive* for your art documentation. You may choose to keep it in your private folders, share it, publish it for all to see or to be seen solely by registered art galeries and institutions.
                '
                .'Why make a collective archive? Because websites get lost in the void of the web. By consolidating, there\'s a potential to link the public to exhibits they\'re interested in.
                '
                .'What\'s the plan? Explore ways to easily find artwork and artists of interest. Add tools for artists and galleries. Find ways for artists to profit from their work and ideas.
                '
                .'artolog is a work inprogress and hopes to provide artists and galeries tools to better assist them. Your suggestions, comments and hopes for the plateform are welcomed.
                '
                .'To the artolog account
                ',
                'fr' => 'artolog est une archive non officielle* pour votre documentation artistique. Vous pouvez choisir de le conserver dans vos dossiers privés, de le partager, de le publier pour que tout le monde puisse le voir ou pour qu\'il soit vu uniquement par les galeries d\'art et les institutions enregistrées.
                '
                .'Pourquoi faire une archive collective ? Parce que les sites web se perdent dans le vide du web. En regroupant, il est possible de relier le public aux expositions qui l\'intéressent.
                '
                .'Quel est le plan? Explorez les moyens de trouver facilement des œuvres d\'art et des artistes qui vous intéressent. Ajoutez des outils pour les artistes et les galeries. Trouvez des façons pour les artistes de tirer profit de leur travail et de leurs idées.
                '
                .'artolog est un travail en cours et espère fournir aux artistes et aux galeries des outils pour mieux les accompagner. Vos suggestions, commentaires et espoirs pour la plateforme sont les bienvenus.
                '
                .'Vers le compte artolog
                ',
            ],
        ]);
        Content::firstOrCreate([
            'key' => EnumContentKey::THANKS,
        ], [
            'type' => EnumContentType::COMPONENT,
            'status' => EnumStatus::ENABLED,
            'content' => [
                'en' => 'Thanks',
                'fr' => 'Remerciements',
            ],
        ]);
    }
}
