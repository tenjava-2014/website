<?php
namespace TenJava\Commands;


use App;
use Carbon\Carbon;
use DateTime;
use DB;
use Guzzle\Http\Exception\RequestException;
use Guzzle\Http\Message\Request;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Message\ResponseInterface;
use Illuminate\Console\Command;
use Lang;
use TenJava\Models\Application;
use TenJava\Notification\FlareBotMessageBuilder;
use TenJava\Notification\IrcMessageBuilderInterface;
use TenJava\Notification\IrcNotifierInterface;
use TenJava\Time\ContestTimesInterface;


class TimeAnnounceCommand extends Command {
    const CHANNEL = "#ten.java";

    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'tenjava:timeannounce';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Announces time milestones.';
    /**
     * @var ContestTimesInterface
     */
    private $times;
    /**
     * @var IrcMessageBuilderInterface
     */
    private $message;
    /**
     * @var IrcNotifierInterface
     */
    private $irc;

    /**
     * Create a new command instance.
     *
     * @param ContestTimesInterface $times
     * @param IrcNotifierInterface $irc
     * @return \TenJava\Commands\TimeAnnounceCommand
     */
    public function __construct(ContestTimesInterface $times, IrcNotifierInterface $irc) {
        parent::__construct();
        $this->times = $times;
        $this->irc = $irc;
    }

    private function sync() {
        $syncTime = Carbon::now();
        $syncTime = 60 - $syncTime->second;
        $this->info("Synchronizing, please wait " . $syncTime . " seconds");
        sleep($syncTime);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire() {
        $this->sync();

        $times = array(
            "the start of timeslot 1" => $this->times->getT1StartTime(),
            "the start of timeslot 2" => $this->times->getT2StartTime(),
            "the start of timeslot 3" => $this->times->getT3StartTime(),
            "the end of timeslot 1" => $this->times->getT1EndTime(),
            "the end of timeslot 2" => $this->times->getT2EndTime(),
            "the end of timeslot 3" => $this->times->getT3EndTime(),
        );
        while (time() < $this->times->getT3EndTime()) {
            foreach ($times as $name => $ts) {
                if (time() > $ts) {
                    $this->info("Skipping " . $name);
                    continue;
                }
                $carbon = Carbon::createFromTimestampUTC($ts);
                $diff = $carbon->diffInSeconds();
                $this->comment("----------------------------------------");
                $this->info("Got diff of " . $diff . " for " . $name);
                if (true) {
                    // it's a minute
                    $minsLeft = $carbon->diffInMinutes();
                    $this->info("In minutes, that's " . $minsLeft);
                    $this->info("In hours, that's " . ($minsLeft / 60.0));
                    if ($minsLeft < 11 && $minsLeft >= 1) {
                        $msg = new FlareBotMessageBuilder();
                        $msg = $msg->insertBold()->insertNavyBlue()->insertText("[Time warning]")->insertBold()->insertReset()->insertText(" $minsLeft " . Lang::choice("themes.announce.min", $minsLeft) . " until " . $name);
                        $this->irc->sendMessage(self::CHANNEL, $msg);
                    } elseif ($minsLeft >= 60 && ($minsLeft % 60 == 0)) {
                        $this->info("It's an hour!");
                        // neat number of hours
                        $hoursLeft = $minsLeft / 60;
                        $msg = new FlareBotMessageBuilder();
                        $msg = $msg->insertBold()->insertNavyBlue()->insertText("[Time warning]")->insertBold()->insertReset()->insertText(" $hoursLeft " . Lang::choice("themes.announce.hour", $hoursLeft) . " until " . $name);
                        $this->irc->sendMessage(self::CHANNEL, $msg);
                    } elseif ($minsLeft == 0) {
                        $msg = new FlareBotMessageBuilder();
                        $msg = $msg->insertBold()->insertNavyBlue()->insertText("[Time warning]")->insertBold()->insertReset()->insertText("It's now " . $name);
                        $this->irc->sendMessage(self::CHANNEL, $msg);
                    }
                }
            }
            $this->sync();
        }

    }

}
