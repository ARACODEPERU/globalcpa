<?php

namespace Tests\Console;

use App\Console\Commands\GenerateSitemapCommand;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GenerateSitemapCommandTest extends TestCase
{
    use RefreshDatabase;

    public function test_sitemap_generate_runs_without_fatal(): void
    {
        $this->artisan(GenerateSitemapCommand::class)
            ->assertSuccessful();
    }
}
