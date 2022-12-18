<?php

declare(strict_types=1);

namespace Nighthtr\Jira\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

/**
 * Class JiraLog
 * @package Nighthtr\Jira\Models
 *
 * @property int $id
 * @property int $jira_post_id
 * @property string $issue_url
 * @property int $issue_id
 * @property Collection $fields
 * @property int $created
 *
 * @property-read JiraPost|null $jiraPost
 */
class JiraLog extends Model
{
    const CREATED_AT = null;
    const UPDATED_AT = null;

    /**
     * @var string
     */
    protected $dateFormat = 'U';

    /**
     * @var string[]
     */
    protected $fillable = [
        'jira_post_id',
        'issue_url',
        'issue_id',
        'fields',
        'created',
    ];

    /**
     * @var string[]
     */
    protected $casts = [
        'id' => 'integer',
        'jira_post_id' => 'integer',
        'issue_url' => 'string',
        'issue_id' => 'integer',
        'fields' => AsCollection::class,
        'created' => 'integer',
    ];

    /**
     * @return BelongsTo
     */
    public function jiraPost(): BelongsTo
    {
        return $this->belongsTo(JiraPost::class);
    }
}
