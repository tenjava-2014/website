<?php

class GitHubEmailOptOut implements EmailOptOutInterface {

    /**
     * @return boolean If visitor is opted in to email sharing.
     */
    public function isOptedIn() {
        return (!Session::has("opt-out"));
    }

    public function setIsOptedIn($optedIn) {
        if ($optedIn) {
            Session::forget("opt-out");
        } else {
            Session::put("opt-out", true);
        }
    }
}