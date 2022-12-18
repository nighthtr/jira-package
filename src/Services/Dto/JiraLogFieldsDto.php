<?php

declare(strict_types=1);

namespace Nighthtr\Jira\Services\Dto;

/**
 * Class JiraLogFieldsDto
 * @package Nighthtr\Jira\Services\Dto
 */
class JiraLogFieldsDto extends Dto
{
    /**
     * @var string|null
     */
    public ?string $name;

    /**
     * @var string|null
     */
    public ?string $content;
}