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
 * @property boolean $web_team
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Models\Judge whereId($value) 
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Models\Judge whereCreatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Models\Judge whereUpdatedAt($value) 
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Models\Judge whereGithubId($value) 
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Models\Judge whereGithubName($value) 
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Models\Judge whereAdmin($value) 
 * @method static \Illuminate\Database\Query\Builder|\TenJava\Models\Judge whereWebTeam($value) 
 */
class Judge extends Model {
    protected $guarded = ['id', 'updated_at', 'created_at'];
}