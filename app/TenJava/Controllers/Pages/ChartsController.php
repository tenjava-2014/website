<?php
namespace TenJava\Controllers\Pages;

use TenJava\Controllers\Abstracts\BaseController;
use Response;

class ChartsController extends BaseController {

    public function showCharts() {
        $this->setPageTitle("Charts");
        return Response::view('pages.dynamic.charts');
    }

} 