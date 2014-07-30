<?php
namespace TenJava\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * OversightRequest
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $claim_id
 * @property string $reason
 * @property integer $judge_id
 * @property-read JudgeClaim $claim
 * @property-read JudgeClaim $originalJudge
 * @method static Builder|OversightRequest whereId($value) 
 * @method static Builder|OversightRequest whereCreatedAt($value) 
 * @method static Builder|OversightRequest whereUpdatedAt($value) 
 * @method static Builder|OversightRequest whereClaimId($value) 
 * @method static Builder|OversightRequest whereReason($value) 
 * @method static Builder|OversightRequest whereJudgeId($value) 
 */
class OversightRequest extends Model {
    protected $table = "oversight_requests";
    protected $fillable = ["reason"];

    public function claim() {
        return $this->belongsTo("TenJava\\Models\\JudgeClaim", "claim_id", "id");
    }

    public function originalJudge() {
        return $this->belongsTo("TenJava\\Models\\Judge", "judge_id", "id");
    }
}