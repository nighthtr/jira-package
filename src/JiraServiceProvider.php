<?php

declare(strict_types=1);

namespace Nighthtr\Jira;

use Illuminate\Support\ServiceProvider;

/**
 * Class JiraServiceProvider
 * @package Nighthtr\Jira
 */
class JiraServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        $this->loadRoutesFrom(__DIR__.'/../routes/web.php');
    }
}