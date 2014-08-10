<?php
namespace TenJava\Authentication;

use Illuminate\Session\Store as SessionStore;
use Illuminate\Config\Repository as ConfigRepository;
use TenJava\Models\Judge;

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
     * @var UserImpersonationInterface
     */
    private $impersonation;

    /**
     * @param SessionStore $session
     * @param ConfigRepository $config
     * @param UserImpersonationInterface $impersonation
     */
    public function __construct(SessionStore $session, ConfigRepository $config, UserImpersonationInterface $impersonation) {
        $this->session = $session;
        $this->config = $config;
        $this->sessionData = $this->session->get("application_data");
        $this->judgeData = $this->session->get("judge");
        $this->impersonation = $impersonation;
    }

    /**
     * @return string Username.
     */
    public function getUsername() {
        if ($this->impersonation->isImpersonatingJudge()) {
            return $this->impersonation->getJudgeUsername();
        }
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
        if ($this->impersonation->isImpersonatingJudge()) {
            return true;
        }
        return ($this->judgeData !== null);
    }

    /**
     * @return boolean If the user is an admin.
     */
    public function isAdmin() {
        if ($this->impersonation->isImpersonatingJudge()) {
            return false;
        }
        return ($this->getUserId() !== null) ? $this->judgeData['admin'] : false;
    }

    /**
     * @return boolean If visitor is logged in.
     */
    public function isLoggedIn() {
        return ($this->sessionData != null || $this->impersonation->isImpersonatingJudge());
    }

    /**
     * @return int The user id.
     */
    public function getUserId() {
        return ($this->sessionData !== null) ? $this->sessionData['id'] : null;
    }

    /**
     * @return array Array of judges.
     */
    public function getAllJudges() {
        return Judge::all()->toArray();
    }


    /**
     * @return int|null The user's judge id or null if they're not a judge.
     */
    public function getJudgeId() {
        if ($this->impersonation->isImpersonatingJudge()) {
            return $this->impersonation->getJudgeId();
        }
        return ($this->judgeData !== null) ? $this->judgeData['id'] : null;
    }
}