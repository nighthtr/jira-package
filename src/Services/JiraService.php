<?php

declare(strict_types=1);

namespace Nighthtr\Jira\Services;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
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
    const STOP_WORDS = [
        '$$$',
        'Доступное',
        'Сделки',
        'Получатели',
        'Дешевый',
        'Ставки',
        'Наличные',
        'Деньги',
        'Крипта',
        'Test',
    ];

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

            Log::error('Ошибка сохранения JiraLog', [
                'extra' => [
                    'error' => $exception->getMessage(),
                    'data' => $jiraLogDto->toArray(),
                ],
            ]);
        }

        return false;
    }

    /**
     * @return void
     */
    public function postsUpdate(): void
    {
        JiraPost::query()
            ->where('status', JiraPostStatus::NEW)
            ->each(function (JiraPost $jiraPost) {
                try {
                    $jiraPost->status = $this->hasStopWords($jiraPost) ? JiraPostStatus::DELETED : JiraPostStatus::APPROVED;

                    $jiraPost->save();
                } catch (Exception $exception) {
                    Log::error('Ошибка обновления JiraPost', [
                        'extra' => [
                            'error' => $exception->getMessage(),
                            'jira_post_id' => $jiraPost->id,
                        ],
                    ]);
                }
            });
    }

    /**
     * @param JiraPost $jiraPost
     * @return bool
     */
    private function hasStopWords(JiraPost $jiraPost): bool
    {
        if (Str::contains($jiraPost->name, self::STOP_WORDS)
            || Str::contains($jiraPost->content, self::STOP_WORDS)
        ) {
            return true;
        }

        return false;
    }
}