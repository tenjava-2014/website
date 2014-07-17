<?php

namespace TenJava\Controllers\Judging;


use Redirect;
use Response;
use TenJava\Contest\JudgeClaimsInterface;
use TenJava\Contest\ParticipantRepositoryInterface;
use TenJava\Controllers\Abstracts\BaseJudgingController;
use TenJava\Security\HmacCreationInterface;
use View;

class LogViewController extends BaseJudgingController {

    /**
     * @var \TenJava\Security\HmacCreationInterface
     */
    private $hmac;

    public function __construct(JudgeClaimsInterface $claims, HmacCreationInterface $hmac, ParticipantRepositoryInterface $pri) {
        parent::__construct($claims, $pri);
        $this->hmac = $hmac;
    }

    public function showLogs() {
        $this->setPageTitle("Log viewer");
        $this->setActive("logs");
        return View::make("judging.pages.logs");
    }

    // <@jkcclemens> X-Pointer-Position

    public function testHmac() {
        $judgeId = $this->auth->getJudgeId();
        $data = ["judge_id" => $judgeId, "timestamp" => time()];
        $dataSig = $this->hmac->createSignature(json_encode($data), $_ENV['API_TOKEN']);
        return Response::json($data, 200, ["X-Signature" => $dataSig]);
    }

}