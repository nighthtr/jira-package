<?php

declare(strict_types=1);

namespace Nighthtr\Jira\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Nighthtr\Jira\Models\Enum\JiraPostStatus;

/**
 * Class JiraPost
 * @package Nighthtr\Jira\Models
 *
 * @property int $id
 * @property JiraPostStatus $status
 * @property string $name
 * @property string $content
 * @property int $date_created
 * @property int $date_updated
 *
 * @property-read JiraLog|null $jiraLog
 */
class JiraPost extends Model
{
    use HasTimestamps;

    const CREATED_AT = 'date_created';
    const UPDATED_AT = 'date_updated';

    /**
     * @var string[]
     */
    protected $casts = [
        'id' => 'integer',
        'status' => JiraPostStatus::class,
        'name' => 'string',
        'content' => 'string',
        'date_created' => 'datetime',
        'date_updated' => 'datetime',
    ];

    /**
     * @return HasOne
     */
    public function jiraLog(): HasOne
    {
        return $this->hasOne(JiraLog::class);
    }
}
