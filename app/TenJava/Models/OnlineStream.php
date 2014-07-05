<?php
namespace TenJava\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * TenJava\Models\OnlineStream
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $app_id
 * @property string $preview_template
 * @method static Builder|OnlineStream whereId($value)
 * @method static Builder|OnlineStream whereCreatedAt($value)
 * @method static Builder|OnlineStream whereUpdatedAt($value)
 * @method static Builder|OnlineStream whereAppId($value)
 * @method static Builder|OnlineStream wherePreviewTemplate($value)
 */
class OnlineStream extends Model {}