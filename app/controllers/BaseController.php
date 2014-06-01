<?php

use Tools\UI\NavigationItem;

class BaseController extends Controller {

    private $activeNavTitle = null;
    private $pageTitle = "";
    const BASE_TITLE = "ten.java 2014";
    /**
     * @var AuthProviderInterface
     */
    protected $auth;

    public function __construct() {
        $this->auth = App::make("AuthProviderInterface");
        View::share('titleAdd', $this->getPageTitle());
        View::share('nav', $this->getNavigation());
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

    public function getNavigation() {

        $navigation['primary'] = array(
            new NavigationItem("Home", "/"),
            new NavigationItem("Sign up", "/signup"),
            new NavigationItem("Points", "/points"),
            new NavigationItem("Team", "/judges"),
        );

        if ($this->auth->isStaff()) {
            $navigation['primary'][] = new NavigationItem("Admin", "/admin");
        }
        $navigation['primary'][] = new NavigationItem("About", "/about");

        foreach ($navigation['primary'] as $navItem) {
            if (starts_with(strtolower($navItem->getTitle()), strtolower($this->activeNavTitle))) {
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

    public function setActive($title) {
        $this->activeNavTitle = $title;
        View::share('nav', $this->getNavigation());
    }
}
