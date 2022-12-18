<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;
use Nighthtr\Jira\Controllers\JiraController;

Route::post('jira', [JiraController::class, 'create']);