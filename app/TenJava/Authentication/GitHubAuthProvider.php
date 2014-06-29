<?php
namespace TenJava\Authentication;

use Illuminate\Session\Store as SessionStore;
use Illuminate\Config\Repository as ConfigRepository;

/**
 * Class GitHubAuthProvider
 * @package TenJava\Authentication
 */
class GitHubAuthProvider implements AuthProviderInterface {

    /**
     * @var mixed
     */
    private $sessionData;
    /**
     * @var \Illuminate\Session\Store
     */
    private $session;
    /**
     * @var \Illuminate\Session\Store
     */
    private $judgeData;
    /**
     * @var \Illuminate\Config\Repository
     */
    private $config;

    /**
     * @param SessionStore $session
     * @param ConfigRepository $config
     */
    public function __construct(SessionStore $session, ConfigRepository $config) {
        $this->session = $session;
        $this->config = $config;
        $this->sessionData = $this->session->get("application_data");
        $this->judgeData = $this->session->get("judge");
    }

    /**
     * @return string Username.
     */
    public function getUsername() {
        return ($this->sessionData !== null) ? $this->sessionData['username'] : null;
    }

    /**
     * @return array Array of email addresses or null if unavailable.
     */
    public function getEmails() {
        return $this->sessionData['emails'];
    }

    /**
     * @return boolean If the user is staff.
     */
    public function isStaff() {
        return ($this->judgeData === null);
    }

    /**
     * @return boolean If the user is an admin.
     */
    public function isAdmin() {
        return ($this->getUserId() !== null) ? $this->judgeData['admin'] : false;
    }

    /**
     * @return boolean If visitor is logged in.
     */
    public function isLoggedIn() {
        return ($this->sessionData != null);
    }

    /**
     * @return int The user id.
     */
    public function getUserId() {
        return ($this->sessionData !== null) ? $this->sessionData['id'] : null;
    }
}