<?php

namespace TenJava\Controllers\Judging;


use Redirect;
use Response;
use TenJava\Contest\JudgeClaimsInterface;
use TenJava\Controllers\Abstracts\BaseJudgingController;
use TenJava\Security\HmacCreationInterface;
use View;

class LogViewController extends BaseJudgingController {

    /**
     * @var \TenJava\Security\HmacCreationInterface
     */
    private $hmac;

    public function __construct(JudgeClaimsInterface $claims, HmacCreationInterface $hmac) {
        parent::__construct($claims);
        $this->hmac = $hmac;
    }

    public function showLogs() {
        $this->setPageTitle("Log viewer");
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