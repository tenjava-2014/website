<?php


/**
 * Interface AuthProviderInterface
 * Represents an auth provider.
 */
interface AuthProviderInterface {

    /**
     * @return boolean If visitor is logged in.
     */
    public function isLoggedIn();

    /**
     * @return string Username.
     */
    public function getUsername();

    /**
     * @return array Array of email addresses or null if unavailable.
     */
    public function getEmails();

    /**
     * @return boolean If the user is staff/
     */
    public function isStaff();

    /**
     * @return boolean If the user is an admin.
     */
    public function isAdmin();

} 