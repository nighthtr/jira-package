<?php

declare(strict_types=1);

namespace Nighthtr\Jira\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Nighthtr\Jira\Services\Dto\JiraLogDto;

/**
 * Class JiraRequest
 * @package Nighthtr\Jira\Requests
 */
class JiraRequest extends FormRequest
{
    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'issue_url' => 'required|string|max:255',
            'issue_id' => 'required|integer',
            'fields' => 'required|array',
            'fields.name' => 'required|string|max:255',
            'fields.content' => 'required|string',
            'created' => 'required|integer|max:2147483647',
        ];
    }

    /**
     * @return JiraLogDto
     */
    public function getJiraLogDto(): JiraLogDto
    {
        return JiraLogDto::create($this->toArray());
    }
}