<?php

namespace TenJava\Composers;

use ArrayObject;
use Auth;
use Illuminate\Cache\Repository as CacheRepository;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Foundation\Application as App;
use Illuminate\Support\Collection;
use Illuminate\View\View;
use NumberFormatter;
use TenJava\Donation;
use TenJava\Team;

class GlobalComposer {

    public function __construct(App $app, CacheRepository $cache) {
        $this->tweets = $cache->get('tweets');
    }

    // TODO: Extract to util class

    public function compose(View $view) {
        $view->with('tweets', $this->tweets);
        $view->with('emailOptOut', $this->getEmailOptOut());
        $view->with('pointsData', $this->getPointsData());
        $view->with('formatter', new NumberFormatter('en_US', NumberFormatter::CURRENCY));
    }

    private function getEmailOptOut() {
        if (Auth::check()) {
            /** @var \TenJava\User $user */
            $user = Auth::user();
            return $user->getOptoutStatus();
        } else {
            return false;
        }
    }

    public function getPointsData() {
        $donations = Donation::notToOrganizers();
        $visible = $donations->visible();
        $recent = $visible->orderBy('updated_at', 'desc')->get();
        $visible = $visible->get();
        $recent = $this->getFirst($recent, 5);
        $sorted = $this->sortHighest($visible);
        $top = $this->getFirstAssociative($sorted, 5);
        return $this->arrayToObject([
            'donors' => $sorted->count(),
            'recent' => $this->arrayToObject($recent),
            'top' => $this->arrayToObject($top),
            'totalMoney' => $this->getTotalMoney(),
            'teams' => Team::all()->count()
        ]);
    }

    private function getFirst($object, $amount) {
        $i = 0;
        $new = [];
        foreach ($object as $obj) {
            $i++;
            if ($i > $amount) {
                break;
            }
            $new[] = $obj;
        }
        return $new;
    }

    /**
     * @param $donations
     * @return \Illuminate\Support\Collection
     */
    public function sortHighest($donations) {
        $sorted = new Collection();
        foreach ($donations as $donation) {
            /** @var Donation $donation */
            $key = $donation->user->username;
            $sorted->put($key, $sorted->pull($key, 0) + $donation->amount);
        }
        $good = [];
        foreach ($sorted as $key => $value) {
            $good[] = $this->arrayToObject([
                'username' => $key,
                'amount' => $value
            ]);
        }
        return $good;
    }

    private function arrayToObject(array $array) {
        return new ArrayObject($array, ArrayObject::ARRAY_AS_PROPS);
    }

    private function getFirstAssociative($object, $amount) {
        $i = 0;
        $new = [];
        foreach ($object as $obj => $value) {
            $i++;
            if ($i > $amount) {
                break;
            }
            $new[$obj] = $value;
        }
        return $new;
    }

    public function getTotalMoney() {
        $totalMoney = 0;
        foreach (Donation::notToOrganizers()->get() as $donation) {
            /** @var Donation $donation */
            $amount = $donation->amount;
            $totalMoney += ($donation->fee_applied ? $this->applyFee($amount) : $amount);
        }
        return $totalMoney;
    }

    private function applyFee($amount) {
        return $amount - (($amount * 0.29) + 0.3);
    }

}
