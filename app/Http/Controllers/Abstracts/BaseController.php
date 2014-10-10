<?php
namespace TenJava\Http\Controllers\Abstracts;

use App;
use Config;
use Illuminate\Routing\Controller;
use TenJava\Tools\UI\NavigationItem;
use View;

abstract class BaseController extends Controller {

    const BASE_TITLE = 'ten.java';
    protected $activeNavTitle = null;
    protected $pageTitle = '';

    public function __construct() {
        View::share('titleAdd', $this->getPageTitle());
        View::share('nav', $this->getNavigation());
        View::share("hst", $this->hasSelectedTimes());
    }

    /**
     * @return string The current page title.
     */
    public function getPageTitle() {
        return ($this->pageTitle == "") ? self::BASE_TITLE : $this->pageTitle . " - " . self::BASE_TITLE;
    }

    /**
     * @param string $pageTitle
     */
    public function setPageTitle($pageTitle) {
        $this->pageTitle = $pageTitle;
        View::share('titleAdd', $this->getPageTitle());
    }

    public function getNavigation() {

        $navigation['primary'] = [
            new NavigationItem('Home', '/'),
            new NavigationItem('Forums', 'http://forums.tenjava.com'),
            new NavigationItem('Teams', '/teams'),
            new NavigationItem('Points', '/points'),
            new NavigationItem('Staff', '/staff'),
        ];

        /**if ($this->hasSelectedTimes() == 'notime') {
         * $navigation['primary'][1] = new NavigationItem("Choose Time", "/times/select");
         * } else if ($this->hasSelectedTimes() == 'timesdone') {
         * unset($navigation['primary'][1]);
         * }*/

        /*if ($this->auth->isStaff()) {
            $navigation['primary'][] = new NavigationItem("App list", "/list");
        }*/
        $navigation['primary'][] = new NavigationItem("About", "/about");

        foreach ($navigation['primary'] as $navItem) {
            /** @var $navItem \TenJava\Tools\UI\NavigationItem */
            if (starts_with(strtolower($navItem->getTitle()), strtolower($this->activeNavTitle))) {
                $navItem->setActive();
            }
        }

        return $navigation;
    }

    protected function hasSelectedTimes() {
        /*$appCount = Application::where("gh_id", $this->auth->getUserId())->where("judge", false)->first();
        if ($appCount == null) {
            return "noapp";
        } else {
            $timeSetting = ParticipantTimes::where("user_id", $appCount->id)->count();
            if ($timeSetting == 0) {
                return "notime";
            } else {
                return "timesdone";
            }
        }*/
        return "timesdone";
    }

    /**
     * @param string $title Active nav.
     */
    public function setActive($title) {
        $this->activeNavTitle = $title;
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
}
