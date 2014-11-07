<?php
namespace TenJava\Http\Controllers;

use Response;
use TenJava\Http\Controllers\Abstracts\BaseController;

class ErrorController extends BaseController {

    public function badRequest($reason) {
        $this->setPageTitle('Bad request');
        return Response::view('errors.request', ['reason' => $reason], 400);
    }

    public function missing() {
        $this->setPageTitle('Page not found');
        return Response::view('errors.missing', [], 404);
    }

    public function oauth() {
        $this->setPageTitle('OAuth error');
        return Response::view('errors.oauth', [], 400);
    }

    public function priorapp() {
        $this->setPageTitle('Prior registration required');
        return Response::view('errors.priorapp', [], 401);
    }

    public function unauthorized() {
        $this->setPageTitle('Unauthorized');
        return Response::view('errors.unauthorized', [], 401);
    }

}
