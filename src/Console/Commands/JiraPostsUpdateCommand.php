<?php

namespace Nighthtr\Jira\Console\Commands;

use Illuminate\Console\Command;
use Nighthtr\Jira\Services\JiraService;

/**
 * Class JiraPostsUpdateCommand
 * @package Nighthtr\Jira\Console\Commands
 */
class JiraPostsUpdateCommand extends Command
{
    /**
     * @var string
     */
    protected $signature = 'jira:posts-update';

    /**
     * @var string
     */
    protected $description = 'Jira posts update';

    /**
     * @param JiraService $jiraService
     */
    public function __construct(
        private readonly JiraService $jiraService,
    )
    {
        parent::__construct();
    }

    /**
     * @return int
     */
    public function handle()
    {
        $this->jiraService->postsUpdate();

        return Command::SUCCESS;
    }
}
