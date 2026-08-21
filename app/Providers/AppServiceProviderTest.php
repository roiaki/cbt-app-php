use PHPUnit\Framework\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use App\Providers\AppServiceProvider;

<?php

namespace Tests\App\Providers;


class AppServiceProviderTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        // Mock the Schema and URL facades
        Schema::shouldReceive('defaultStringLength')->zeroOrMoreTimes();
        URL::shouldReceive('forceScheme')->zeroOrMoreTimes();
    }

    public function testBootSetsDefaultStringLength()
    {
        Schema::shouldReceive('defaultStringLength')
            ->once()
            ->with(191);

        $provider = new AppServiceProvider(app());
        $provider->boot();
    }

    public function testBootForcesHttpSchemeInNonProduction()
    {
        config(['app.env' => 'local']);
        URL::shouldReceive('forceScheme')
            ->once()
            ->with('http');

        $provider = new AppServiceProvider(app());
        $provider->boot();
    }

    public function testBootForcesHttpsSchemeInProduction()
    {
        config(['app.env' => 'production']);
        URL::shouldReceive('forceScheme')
            ->once()
            ->with('https');

        $provider = new AppServiceProvider(app());
        $provider->boot();
    }
}