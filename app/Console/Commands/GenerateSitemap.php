<?php

namespace App\Console\Commands;

use App\Models\Product;
use Illuminate\Console\Command;

class GenerateSitemap extends Command
{
    protected $signature = 'app:generate-sitemap';

    protected $description = 'Generate XML Sitemap';

    public function handle()
    {
        $baseUrl = config('app.url');

        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . PHP_EOL;
        $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . PHP_EOL;

        /*
        |--------------------------------------------------------------------------
        | Static Pages
        |--------------------------------------------------------------------------
        */

        $pages = [
            [
                'loc' => '/',
                'priority' => '1.0',
                'changefreq' => 'daily',
            ],
            [
                'loc' => '/shop',
                'priority' => '0.9',
                'changefreq' => 'daily',
            ],
            [
                'loc' => '/pos/features',
                'priority' => '0.8',
                'changefreq' => 'weekly',
            ],
            [
                'loc' => '/pos/pricing',
                'priority' => '0.9',
                'changefreq' => 'weekly',
            ],
            [
                'loc' => '/pos/about',
                'priority' => '0.7',
                'changefreq' => 'monthly',
            ],
            [
                'loc' => '/pos/support',
                'priority' => '0.7',
                'changefreq' => 'monthly',
            ],
        ];

        foreach ($pages as $page) {

            $xml .= "  <url>\n";
            $xml .= "    <loc>{$baseUrl}{$page['loc']}</loc>\n";
            $xml .= "    <changefreq>{$page['changefreq']}</changefreq>\n";
            $xml .= "    <priority>{$page['priority']}</priority>\n";
            $xml .= "  </url>\n";

        }

        /*
        |--------------------------------------------------------------------------
        | Products
        |--------------------------------------------------------------------------
        */

        foreach (Product::all() as $product) {

            $xml .= "  <url>\n";
            $xml .= "    <loc>{$baseUrl}/product/{$product->slug}</loc>\n";
            $xml .= "    <lastmod>{$product->updated_at->toAtomString()}</lastmod>\n";
            $xml .= "    <changefreq>weekly</changefreq>\n";
            $xml .= "    <priority>0.9</priority>\n";
            $xml .= "  </url>\n";

        }

        $xml .= '</urlset>';

        file_put_contents(public_path('sitemap.xml'), $xml);

        $this->info('Sitemap generated successfully!');
    }
}