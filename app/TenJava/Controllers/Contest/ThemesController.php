<?php
namespace TenJava\Controllers\Contest;

use TenJava\Controllers\Abstracts\BaseController;
use View;

class ThemesController extends BaseController {
    public function showThemes() {
        $this->setPageTitle("Contest themes");
        return View::make("pages.static.themes");
    }
} 
