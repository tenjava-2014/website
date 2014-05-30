<?php


class ErrorController extends BaseController {

    public function unauthorized() {
        $this->setPageTitle("Unauthorized!");
        return Response::view('errors.unauthorized', array(), 401);
    }

} 