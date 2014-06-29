<?php
namespace TenJava\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * \TenJava\Models\RepoActions
 *
 * @property integer $id
 * @property \Carbon\Carbon $created_at
 * @property \Carbon\Carbon $updated_at
 * @property string $repo_name
 * @property string $action
 */
class RepoActions extends Model {
    protected $table = 'repo_actions';
    protected $guarded = ['created_at', 'id', 'updated_at'];
}