<?php

namespace App\Console\Commands;

use App\Models\Exhibit;
use App\Models\UserProfile;
use Illuminate\Support\Facades\Route;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'generate:sitemap';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $sitemap = Sitemap::create();

        // Routes statiques
        $staticRoutes = [
            route('app.home'),
            route('app.conditions'),
            route('app.privacy'),
            route('app.research'),
        ];

        foreach ($staticRoutes as $url) {
            $sitemap->add(
                Url::create($url)
                    ->setPriority(0.7)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        }

        // Sections ancrées (non indispensables dans le sitemap mais tu peux les ajouter si ton équipe le veut)
        $anchors = ['#srm', '#about-us', '#contact'];
        foreach ($anchors as $anchor) {
            $sitemap->add(
                Url::create(route('app.home') . $anchor)
                    ->setPriority(0.5)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        }

        // Exhibits dynamiques
        Exhibit::where('status', 'enabled')->get()->each(function ($exhibit) use ($sitemap) {
            $sitemap->add(
                Url::create(route('app.exhibits.show', ['exhibit' => $exhibit->id]))
                    ->setLastModificationDate($exhibit->updated_at)
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            );
        });

        // Profiles et leurs contenus
        UserProfile::all()->each(function ($profile) use ($sitemap) {
            // Profil principal
            $sitemap->add(
                Url::create(route('app.profiles.show', ['profile' => $profile->id]))
                    ->setLastModificationDate($profile->updated_at)
                    ->setPriority(0.8)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
            );

            // Collections
            $sitemap->add(
                Url::create(route('app.profiles.collections.index', ['profile' => $profile->id]))
                    ->setPriority(0.6)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );

            // Exhibits liés au profil
            $sitemap->add(
                Url::create(route('app.profiles.exhibits.index', ['profile' => $profile->id]))
                    ->setPriority(0.6)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );

            // Website groups
            $sitemap->add(
                Url::create(route('app.profiles.website-groups.index', ['profile' => $profile->id]))
                    ->setPriority(0.6)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)
            );
        });

        // Générer le sitemap
        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');
    }
}
