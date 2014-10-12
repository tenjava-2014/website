<?php
namespace TenJava\Http\Controllers\Pages;

use App;
use Auth;
use Carbon\Carbon;
use Config;
use Input;
use Redirect;
use Response;
use TenJava\Contest\TwitchRepositoryInterface;
use TenJava\Http\Controllers\Abstracts\BaseController;
use View;

class HomeController extends BaseController {

    public function adminTest() {
        return Response::json(["env" => App::environment()]);
    }

    public function ajaxCommits() {
        return View::make("partials.commits", ["commits" => []]);
    }

    public function index() {
        parent::setActive("Home");
        $this->setPageTitle("Home");
        $carbonDiff = Carbon::createFromTimeStamp(Config::get("contest-times.t1"));
        $carbonDiff = str_replace("from now", "remaining", $carbonDiff->diffForHumans());

        $viewData = [
            'carbonDiff' => $carbonDiff,
        ];
        $viewName = "pages.static.home";
        return View::make($viewName)->with($viewData);
    }

    public function showStreams(TwitchRepositoryInterface $twitch) {
        $viewData['twitch'] = $twitch->getOnlineStreamers();
        return View::make("pages.dynamic.streams")->with($viewData);
    }

    public function staffTest() {
        return "Staff only test endpoint. " . Auth::user()->username;
    }

    public function terms() {
        return View::make('pages.static.terms');
    }

    public function wiki() {
        return Redirect::to("https://github.com/tenjava/resources/wiki");
    }

}
