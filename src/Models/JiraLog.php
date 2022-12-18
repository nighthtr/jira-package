<?php

declare(strict_types=1);

namespace Nighthtr\Jira\Models;

use Illuminate\Database\Eloquent\Concerns\HasTimestamps;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class JiraLog
 * @package Nighthtr\Jira\Models
 *
 * @property int $id
 * @property int $jira_post_id
 * @property string $issue_url
 * @property int $issue_id
 * @property array $fields
 * @property int $created
 * @property int $created_at
 * @property int $updated_at
 *
 * @property-read JiraPost|null $jiraPost
 */
class JiraLog extends Model
{
    use HasTimestamps;

    /**
     * @var string[]
     */
    protected $casts = [
        'id' => 'integer',
        'jira_post_id' => 'integer',
        'issue_url' => 'string',
        'issue_id' => 'integer',
        'fields' => 'array',
        'created' => 'integer',
        'created_at' => 'integer',
        'updated_at' => 'integer',
    ];

    /**
     * @return BelongsTo
     */
    public function jiraPost(): BelongsTo
    {
        return $this->belongsTo(JiraPost::class);
    }
}
