<?php


class GitHubAuthProvider implements AuthProviderInterface {

    private $sessionData;

    public function __construct() {
        $this->sessionData = Session::get("application_data");
    }

    /**
     * @return string Username.
     */
    public function getUsername() {
        return $this->sessionData['username'];
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
        return in_array($this->getUsername(), Config::get("user-access.staff"));
    }

    /**
     * @return boolean If the user is an admin.
     */
    public function isAdmin() {
        return in_array($this->getUsername(), Config::get("user-access.admins"));
    }

    /**
     * @return boolean If visitor is logged in.
     */
    public function isLoggedIn() {
        return ($this->sessionData != null);
    }
}