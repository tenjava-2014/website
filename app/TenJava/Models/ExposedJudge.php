<?php
namespace TenJava\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class ExposedJudge
 * This is identical, except we expose the claims.
 * @package TenJava\Models
 */
class ExposedJudge extends Judge {
    protected $table = "judges";
    protected $visible = ["claims"];
}