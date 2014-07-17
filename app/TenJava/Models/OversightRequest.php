<?php
namespace TenJava\Models;

use Illuminate\Database\Eloquent\Model;

class OversightRequest extends Model {
    protected $table = "oversight_requests";
    protected $fillable = ["reason"];
}