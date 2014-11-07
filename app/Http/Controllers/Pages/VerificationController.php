<?php
namespace TenJava\Http\Controllers\Pages;

use Auth;
use Carbon\Carbon;
use Config;
use Input;
use TenJava\Http\Controllers\Abstracts\BaseController;
use TenJava\Security\HmacCreationInterface;
use View;

class VerificationController extends BaseController {
    /**
     * @var HmacCreationInterface
     */
    private $hmac;

    /**
     * @param HmacCreationInterface $hmac
     */
    public function __construct(HmacCreationInterface $hmac) {
        parent::__construct();
        $this->hmac = $hmac;
    }

    public function getVerificationKey() {
        $this->setPageTitle('Verification Key');
        $data = Auth::id() . "-" . Auth::user()->username;
        $key = $this->hmac->createSignature($data, Config::get("gh-data.verification-key"));
        return View::make('pages.dynamic.winner-verification')->with(['key' => $key]);
    }

}
