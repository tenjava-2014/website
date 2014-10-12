<?php namespace TenJava\Http\Controllers\Abstracts;

use TenJava\Tools\UI\NavigationItem;
use URL;

class BaseDonateController extends BaseController {
    const BASE_TITLE = 'ten.java secure';

    /**
     * @return string The current page title.
     */
    public function getPageTitle() {
        return ($this->pageTitle == '') ? self::BASE_TITLE : $this->pageTitle . ' - ' . self::BASE_TITLE;
    }

    public function getNavigation() {

        $navigation['primary'] = array(
            new NavigationItem('Donate', URL::route('donate')),
            new NavigationItem('Donate to Organizers', URL::route('send_money')),
            new NavigationItem('Return to Site', '/'),
        );

        foreach ($navigation['primary'] as $navItem) {
            /** @var $navItem \TenJava\Tools\UI\NavigationItem */
            if (strtolower($navItem->getTitle()) === strtolower($this->activeNavTitle)) {
                $navItem->setActive();
            }
        }
        return $navigation;
    }
}
