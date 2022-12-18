<?php

declare(strict_types=1);

namespace Nighthtr\Jira\Services\Dto;

class JiraLogFieldsDto extends Dto
{
    public ?string $name;
    public ?string $content;
}