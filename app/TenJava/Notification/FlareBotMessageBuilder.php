<?php
namespace TenJava\Notification;

/**
 * Class FlareBotMessageBuilder
 * @package TenJava\Notification
 */
class FlareBotMessageBuilder implements IrcMessageBuilderInterface {

    /**
     * @var string Current text
     */
    private $text;
    /**
     * @var string
     */
    private $colorChar = "\x03";
    /**
     * @var string
     */
    private $boldChar = "\x02";

    /**
     * @return $this
     */
    public function insertWhite() {
        $this->text .= $this->colorChar . "0";
        return $this;
    }

    /**
     * @return $this
     */
    public function insertBlack() {
        $this->text .= $this->colorChar . "1";
        return $this;
    }

    /**
     * @return $this
     */
    public function insertNavyBlue() {
        $this->text .= $this->colorChar . "2";
        return $this;
    }

    /**
     * @return $this
     */
    public function insertGreen() {
        $this->text .= $this->colorChar . "3";
        return $this;
    }

    /**
     * @return $this
     */
    public function insertRed() {
        $this->text .= $this->colorChar . "4";
        return $this;
    }

    /**
     * @return $this
     */
    public function insertBrown() {
        $this->text .= $this->colorChar . "5";
        return $this;
    }

    /**
     * @return $this
     */
    public function insertPurple() {
        $this->text .= $this->colorChar . "6";
        return $this;
    }

    /**
     * @return $this
     */
    public function insertOlive() {
        $this->text .= $this->colorChar . "7";
        return $this;
    }

    /**
     * @return $this
     */
    public function insertYellow() {
        $this->text .= $this->colorChar . "8";
        return $this;
    }

    /**
     * @return $this
     */
    public function insertLimeGreen() {
        $this->text .= $this->colorChar . "9";
        return $this;
    }

    /**
     * @return $this
     */
    public function insertTeal() {
        $this->text .= $this->colorChar . "10";
        return $this;
    }

    /**
     * @return $this
     */
    public function insertAquaLight() {
        $this->text .= $this->colorChar . "11";
        return $this;
    }

    /**
     * @return $this
     */
    public function insertRoyalBlue() {
        $this->text .= $this->colorChar . "12";
        return $this;
    }

    /**
     * @return $this
     */
    public function insertHotPink() {
        $this->text .= $this->colorChar . "13";
        return $this;
    }

    /**
     * @return $this
     */
    public function insertDarkGray() {
        $this->text .= $this->colorChar . "14";
        return $this;
    }

    /**
     * @return $this
     */
    public function insertLightGray() {
        $this->text .= $this->colorChar . "15";
        return $this;
    }

    /**
     * @return $this
     */
    public function insertBold() {
        $this->text .= $this->boldChar;
        return $this;
    }

    /**
     * @param $text
     * @return $this
     */
    public function insertText($text) {
        $this->text .= $text;
        return $this;
    }

    /**
     * @param $text
     * @return $this
     */
    public function insertSecureText($text) {
        $toRemove = ["\r", "\n", "\x02", "\x03"]; // No newlines, CRs or formatting characters
        $text = str_replace($toRemove, "", $text);
        $this->text .= $text;
        return $this;
    }

    /**
     * @return $this
     */
    public function getText() {
        return $this->text;
    }

    /**
     * @param string $text The text to munge
     * @return IrcMessageBuilderInterface
     */
    public function insertMungedText($text) {
        $text = substr($text, 0, 1) . '[ZWS]' . substr($text, 1);
        $this->text .= $text;
        return $this;
    }
}