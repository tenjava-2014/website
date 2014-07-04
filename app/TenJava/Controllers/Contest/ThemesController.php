<?php
namespace TenJava\Controllers\Pages;

use TenJava\Controllers\Abstracts\BaseController;
use Carbon\Carbon;
use View;
use App;

class ThemesController extends BaseController {
    public function showThemes() {
        $this->setPageTitle("Contest themes");
        return View::make("pages.static.themes");
    }
} 
