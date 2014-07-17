<?php
namespace TenJava\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * TenJava\Models\JudgeClaim
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $judge_id
 * @property string $repo_name
 * @property Judge $judge
 * @property JudgeResult $result
 * @method static Builder|JudgeClaim whereId($value)
 * @method static Builder|JudgeClaim whereCreatedAt($value)
 * @method static Builder|JudgeClaim whereUpdatedAt($value)
 * @method static Builder|JudgeClaim whereJudgeId($value)
 * @method static Builder|JudgeClaim whereRepoName($value)
 */
class JudgeClaim extends Model {
    protected $table = "judge_claims";

    public function judge() {
        /** @see Judge */
        return $this->belongsTo("TenJava\\Models\\Judge", "judge_id", "id");
    }

    public function result() {
        /** @see JudgeResult */
        return $this->hasOne("TenJava\\Models\\JudgeResult", "claim_id", "id");
    }

    public function oversight() {
        return $this->hasOne("TenJava\\Models\\OversightRequest", "claim_id", "id");
    }
}