<?php
namespace TenJava\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * TenJava\Models\ParticipantFeedback
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $app_id
 * @property string $comment
 * @method static Builder|ParticipantFeedback whereId($value)
 * @method static Builder|ParticipantFeedback whereCreatedAt($value)
 * @method static Builder|ParticipantFeedback whereUpdatedAt($value)
 * @method static Builder|ParticipantFeedback whereAppId($value)
 * @method static Builder|ParticipantFeedback whereComment($value)
 */
class ParticipantFeedback extends Model {
    protected $table = 'participant_feedback';
    protected $fillable = ["comment"];
}