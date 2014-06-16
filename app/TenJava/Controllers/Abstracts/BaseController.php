<?php
namespace TenJava\Controllers\Abstracts;

use App;
use Illuminate\Routing\Controller;
use TenJava\Models\ParticipantTimes;
use View;
use TenJava\Tools\UI\NavigationItem;
use TenJava\Models\Application;
use TenJava\Authentication\AuthProviderInterface;

abstract class BaseController extends Controller {

    private $activeNavTitle = null;
    private $pageTitle = "";
    const BASE_TITLE = "ten.java 2014";
    /**
     * @var AuthProviderInterface
     */
    protected $auth;

    public function __construct() {
        $this->auth = App::make("\\TenJava\\Authentication\\AuthProviderInterface");
        View::share('titleAdd', $this->getPageTitle());
        View::share('nav', $this->getNavigation());
        View::share("hst", $this->hasSelectedTimes());
    }

    protected function hasSelectedTimes() {
        $appCount = Application::where("gh_id", $this->auth->getUserId())->where("judge", false)->first();
        if ($appCount == null) {
            return "noapp";
        } else {
            $timeSetting = ParticipantTimes::where("user_id", $appCount->id)->count();
            if ($timeSetting == 0) {
                return "notime";
            } else {
                return "timesdone";
            }
        }
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
            new NavigationItem("Team", "/team"),
        );

	    if($this->hasSelectedTimes() == 'notime'){
		    $navigation['primary'][1] = new NavigationItem("Choose Time", "/times/select");
	    }else if($this->hasSelectedTimes() == 'timesdone'){
		    unset($navigation['primary'][1]);
	    }

        if ($this->auth->isStaff()) {
            $navigation['primary'][] = new NavigationItem("App list", "/list");
        }
        $navigation['primary'][] = new NavigationItem("About", "/about");

        foreach ($navigation['primary'] as $navItem) {
            /** @var $navItem \TenJava\Tools\UI\NavigationItem */
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
     * @return string The current page title.
     */
    public function getPageTitle() {
        return ($this->pageTitle == "") ? self::BASE_TITLE : $this->pageTitle . " - " . self::BASE_TITLE;
    }

    /**
     * @param string $title Active nav.
     */
    public function setActive($title) {
        $this->activeNavTitle = $title;
        View::share('nav', $this->getNavigation());
    }
}
