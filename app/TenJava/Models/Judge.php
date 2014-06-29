<?php
namespace TenJava\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * TenJava\Models\Judge
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property integer $github_id
 * @property string $github_name
 * @property boolean $admin
 */
class Judge extends Model {
    protected $guarded = ['id', 'updated_at', 'created_at'];
}