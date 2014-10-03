<?php
namespace TenJava\Http\Controllers\Authentication;

use Auth;
use Illuminate\Http\Request;
use Input;
use Redirect;
use Session;
use TenJava\AuthenticateUser;
use TenJava\Http\Controllers\Abstracts\BaseController;
use View;

// TODO: Email opt-out
class AuthController extends BaseController {

    /**
     * @var \TenJava\AuthenticateUser
     */
    private $authenticateUser;

    public function __construct(AuthenticateUser $authenticateUser) {
        parent::__construct();
        $this->authenticateUser = $authenticateUser;
    }

    public function loginWithGitHub(Request $request) {
        return $this->authenticateUser->execute($request->has('code'));
    }

    public function logout() {
        return $this->authenticateUser->logout();
    }

    public function showRefusal() {
        return View::make("pages.auth.refusal");
    }

}
