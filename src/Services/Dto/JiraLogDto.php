<?php

declare(strict_types=1);

namespace Nighthtr\Jira\Services\Dto;

/**
 * Class JiraLogDto
 * @package Nighthtr\Jira\Services\Dto
 */
class JiraLogDto extends Dto
{
    /**
     * @var string|null
     */
    public ?string $issue_url;

    /**
     * @var int|null
     */
    public ?int $issue_id;

    /**
     * @var JiraLogFieldsDto|null
     */
    public ?JiraLogFieldsDto $fields;

    /**
     * @var int|null
     */
    public ?int $created;
}