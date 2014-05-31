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
        return (array_key_exists("username", $this->sessionData)) ? $this->sessionData['username'] : null;
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
        return ($this->getUsername() !== null) ? in_array($this->getUsername(), Config::get("user-access.staff")) : false;
    }

    /**
     * @return boolean If the user is an admin.
     */
    public function isAdmin() {
        return ($this->getUsername() !== null) ? in_array($this->getUsername(), Config::get("user-access.admins")) : false;
    }

    /**
     * @return boolean If visitor is logged in.
     */
    public function isLoggedIn() {
        return ($this->sessionData != null);
    }
}