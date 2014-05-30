<?php

use Tools\UI\NavigationItem;

class BaseController extends Controller {

    private static $activeNavTitle = null;
    private $pageTitle = "";
    const BASE_TITLE = "ten.java 2014";

    function __construct() {
        View::share('titleAdd', $this->getPageTitle());
    }

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout() {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    public static function getNavigation() {

        $navigation['primary'] = array(
            new NavigationItem("Home", "/"),
            new NavigationItem("Signup", "/signup"),
            new NavigationItem("Points", "/points"),
            new NavigationItem("Judges", "/judges"),
            new NavigationItem("About", "/about"),
        );

        foreach ($navigation['primary'] as $navItem) {
            if (starts_with($navItem->getTitle(), self::$activeNavTitle)) {
                $navItem->setActive();
            }
        }

        return $navigation;
    }

    /**
     * @param string $pageTitle
     */
    public function setPageTitle($pageTitle) {
        $this->pageTitle = $pageTitle;
        View::share('titleAdd', $this->getPageTitle());
    }

    /**
     * @return string
     */
    public function getPageTitle() {
        return ($this->pageTitle == "") ? self::BASE_TITLE : $this->pageTitle . " - " . self::BASE_TITLE;
    }

    public static function setActive($title) {
        self::$activeNavTitle = $title;
    }
}
