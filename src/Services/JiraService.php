<?php

declare(strict_types=1);

namespace Nighthtr\Jira\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Nighthtr\Jira\Models\Enum\JiraPostStatus;
use Nighthtr\Jira\Models\JiraLog;
use Nighthtr\Jira\Models\JiraPost;
use Nighthtr\Jira\Services\Dto\JiraLogDto;

/**
 * Class JiraService
 * @package Nighthtr\Jira\Services
 */
class JiraService
{
    /**
     * @param JiraLogDto $jiraLogDto
     * @return bool
     * @throws Exception
     */
    public function createJiraLog(JiraLogDto $jiraLogDto): bool
    {
        DB::beginTransaction();

        try {
            $jiraLog = new JiraLog();
            $jiraLog->fill($jiraLogDto->toArray());
            $jiraLog->save();

            $jiraPost = new JiraPost();
            $jiraPost->fill($jiraLog->fields->toArray());
            $jiraPost->status = JiraPostStatus::NEW;
            $jiraPost->save();

            $jiraLog->jiraPost()->associate($jiraPost);
            $jiraLog->save();

            DB::commit();
            return true;
        } catch (Exception $exception) {
            DB::rollBack();
            throw $exception;
        }

        return false;
    }
}