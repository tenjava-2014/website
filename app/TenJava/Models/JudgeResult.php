<?php
namespace TenJava\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * TenJava\Models\JudgeResult
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $claim_id
 * @property integer $idea_originality
 * @property integer $idea_theme_conformance
 * @property integer $idea_complexity
 * @property integer $idea_fun
 * @property integer $idea_expansion
 * @property integer $execution_user_friendliness
 * @property integer $execution_absence_bugs
 * @property integer $execution_general_mechanics
 * @property integer $code_bukkit_api
 * @property integer $code_java
 * @property integer $code_documentation
 * @property string $liked
 * @property string $improve
 * @property-read JudgeClaim $claim
 * @method static Builder|JudgeResult whereId($value)
 * @method static Builder|JudgeResult whereCreatedAt($value)
 * @method static Builder|JudgeResult whereUpdatedAt($value)
 * @method static Builder|JudgeResult whereClaimId($value)
 * @method static Builder|JudgeResult whereIdeaOriginality($value)
 * @method static Builder|JudgeResult whereIdeaThemeConformance($value)
 * @method static Builder|JudgeResult whereIdeaComplexity($value)
 * @method static Builder|JudgeResult whereIdeaFun($value)
 * @method static Builder|JudgeResult whereIdeaExpansion($value)
 * @method static Builder|JudgeResult whereExecutionUserFriendliness($value)
 * @method static Builder|JudgeResult whereExecutionAbsenceBugs($value)
 * @method static Builder|JudgeResult whereExecutionGeneralMechanics($value)
 * @method static Builder|JudgeResult whereCodeBukkitApi($value)
 * @method static Builder|JudgeResult whereCodeJava($value)
 * @method static Builder|JudgeResult whereCodeDocumentation($value)
 * @method static Builder|JudgeResult whereLiked($value)
 * @method static Builder|JudgeResult whereImprove($value)
 */
class JudgeResult extends Model {
    protected $table = "judge_results";

    public function claim() {
        return $this->belongsTo("TenJava\\Models\\JudgeClaim", "claim_id", "id");
    }
}