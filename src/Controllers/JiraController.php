<?php

declare(strict_types=1);

namespace Nighthtr\Jira\Controllers;

use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\Routing\ResponseFactory;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Nighthtr\Jira\Requests\JiraRequest;
use Nighthtr\Jira\Services\JiraService;

/**
 * Class JiraController
 * @package Nighthtr\Jira\Controllers
 */
class JiraController extends Controller
{
    public function __construct(
        private readonly JiraService $jiraService,
    )
    {
    }

    /**
     * @param JiraRequest $request
     * @return Application|ResponseFactory|Response
     * @throws Exception
     */
    public function create(JiraRequest $request): Response|Application|ResponseFactory
    {
        if ($this->jiraService->createJiraLog($request->getJiraLogDto())) {
            return response(null, 204);
        }

        return response(null, 400);
    }
}