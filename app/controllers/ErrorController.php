<?php


class ErrorController extends BaseController {

    public function unauthorized() {
        $this->setPageTitle("Unauthorized");
        return Response::view('errors.unauthorized', array(), 401);
    }

    public function oauth() {
        $this->setPageTitle("OAuth error");
        return Response::view('errors.oauth', array(), 400);
    }

} 