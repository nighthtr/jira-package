<?php

declare(strict_types=1);

namespace Nighthtr\Jira\Models\Enum;

enum JiraPostStatus: int
{
    case NEW = 1;
    case APPROVED = 2;
    case DELETED = 3;
}