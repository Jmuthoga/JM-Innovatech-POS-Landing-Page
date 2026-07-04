<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Product;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;

#[Signature('app:generate-sitemap')]
#[Description('Command description')]
class GenerateSitemap extends Command
{
    protected $signature = 'app:generate-sitemap';

    protected $description = 'Generate XML Sitemap';

    public function handle()
    {
        $sitemap = Sitemap::create();

        /*
        |--------------------------------------------------------------------------
        | Static Pages
        |--------------------------------------------------------------------------
        */

        $sitemap->add(
            Url::create('/')
                ->setPriority(1.0)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
        );

        $sitemap->add(
            Url::create('/shop')
                ->setPriority(0.9)
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)
        );

        $sitemap->add(
            Url::create('/pos/features')
                ->setPriority(0.8)
        );

        $sitemap->add(
            Url::create('/pos/pricing')
                ->setPriority(0.9)
        );

        $sitemap->add(
            Url::create('/pos/about')
                ->setPriority(0.6)
        );

        $sitemap->add(
            Url::create('/pos/support')
                ->setPriority(0.6)
        );

        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        Product::all()->each(function ($product) use ($sitemap) {

            $sitemap->add(

                Url::create("/product/{$product->slug}")
                    ->setLastModificationDate($product->updated_at)
                    ->setPriority(0.9)
                    ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)

            );

        });

        /*
        |--------------------------------------------------------------------------
        | Write XML
        |--------------------------------------------------------------------------
        */

        $sitemap->writeToFile(public_path('sitemap.xml'));

        $this->info('Sitemap generated successfully!');
    }
}
