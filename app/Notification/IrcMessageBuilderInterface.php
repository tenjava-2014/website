<?php namespace TenJava\Notification;

interface IrcMessageBuilderInterface {
    /**
     * @return IrcMessageBuilderInterface
     */
    public function getText();

    /**
     * @return IrcMessageBuilderInterface
     */
    public function insertAquaLight();

    /**
     * @return IrcMessageBuilderInterface
     */
    public function insertBlack();

    /**
     * @return IrcMessageBuilderInterface
     */
    public function insertBold();

    /**
     * @return IrcMessageBuilderInterface
     */
    public function insertBrown();

    /**
     * @return IrcMessageBuilderInterface
     */
    public function insertDarkGray();

    /**
     * @return IrcMessageBuilderInterface
     */
    public function insertGreen();

    /**
     * @return IrcMessageBuilderInterface
     */
    public function insertHotPink();

    /**
     * @return IrcMessageBuilderInterface
     */
    public function insertLightGray();

    /**
     * @return IrcMessageBuilderInterface
     */
    public function insertLimeGreen();

    /**
     * @param string $text The text to munge
     * @return IrcMessageBuilderInterface
     */
    public function insertMungedText($text);

    /**
     * @return IrcMessageBuilderInterface
     */
    public function insertNavyBlue();

    /**
     * @return IrcMessageBuilderInterface
     */
    public function insertOlive();

    /**
     * @return IrcMessageBuilderInterface
     */
    public function insertPurple();

    /**
     * @return IrcMessageBuilderInterface
     */
    public function insertRed();

    /**
     * @return IrcMessageBuilderInterface
     */
    public function insertReset();

    /**
     * @return IrcMessageBuilderInterface
     */
    public function insertRoyalBlue();

    /**
     * @param string $text The text to strip and insert.
     * @return IrcMessageBuilderInterface
     */
    public function insertSecureText($text);

    /**
     * @return IrcMessageBuilderInterface
     */
    public function insertTeal();

    /**
     * @param $text
     * @return IrcMessageBuilderInterface
     */
    public function insertText($text);

    /**
     * @return IrcMessageBuilderInterface
     */
    public function insertWhite();

    /**
     * @return IrcMessageBuilderInterface
     */
    public function insertYellow();
}
