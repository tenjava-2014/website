<?php
namespace TenJava\Authentication;

use Illuminate\Session\Store as SessionStore;

/**
 * Class GitHubEmailOptOut
 * @package TenJava\Authentication
 */
class GitHubEmailOptOut implements EmailOptOutInterface {

    /**
     * @var \Illuminate\Session\Store
     */
    private $session;

    /**
     * @param SessionStore $session
     */
    public function __construct(SessionStore $session) {
        $this->session = $session;
    }

    /**
     * @return boolean If visitor is opted in to email sharing.
     */
    public function isOptedIn() {
        return (!$this->session->has("opt-out"));
    }


    /**
     * @param bool $optedIn Whether or not we should set the user as opted in.
     */
    public function setIsOptedIn($optedIn) {
        if ($optedIn) {
            $this->session->forget("opt-out");
        } else {
            $this->session->put("opt-out", true);
        }
    }
}