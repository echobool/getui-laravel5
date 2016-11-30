<?php
namespace Echobool\Getui;

/**
 * Class IGtNotyPopLoadTemplate
 * @package getuisdk
 */
class IGtNotyPopLoadTemplate extends IGtBaseTemplate
{
    /**
     * @var string
     */
    public $notyIcon;
    /**
     * @var string
     */
    public $logoURL;
    /**
     * @var string
     */
    public $notyTitle;
    /**
     * @var string
     */
    public $notyContent;
    /**
     * @var bool
     */
    public $isCleared = true;
    /**
     * @var bool
     */
    public $isBelled = true;
    /**
     * @var bool
     */
    public $isVibrationed = true;
    /**
     * @var string
     */
    public $popTitle;
    /**
     * @var string
     */
    public $popContent;
    /**
     * @var string
     */
    public $popImage;
    /**
     * @var string
     */
    public $popButton1;
    /**
     * @var string
     */
    public $popButton2;
    /**
     * @var string
     */
    public $loadIcon;
    /**
     * @var string
     */
    public $loadTitle;
    /**
     * @var string
     */
    public $loadUrl;
    /**
     * @var bool
     */
    public $isAutoInstall = false;
    /**
     * @var bool
     */
    public $isActived = false;
    /**
     * @var string
     */
    public $symbianMark = '';
    /**
     * @var string
     */
    public $androidMark = '';
    /**
     * @var string
     */
    public $iosMark = '';

    /**
     * @return array
     */
    public function getActionChain()
    {
        $actionChains = array();
        $actionChain1 = new ActionChain();
        $actionChain1->setActionId(1);
        $actionChain1->setType(ActionChainType::REFER);
        $actionChain1->setNext(10000);
        $actionChain2 = new ActionChain();
        $actionChain2->setActionId(10000);
        $actionChain2->setType(ActionChainType::NOTIFICATION);
        $actionChain2->setTitle($this->notyTitle);
        $actionChain2->setText($this->notyContent);
        $actionChain2->setLogo($this->notyIcon);
        $actionChain2->setLogoURL($this->logoURL);
        $actionChain2->setRing($this->isBelled);
        $actionChain2->setClearable($this->isCleared);
        $actionChain2->setBuzz($this->isVibrationed);
        $actionChain2->setNext(10010);

        $actionChain3 = new ActionChain();
        $actionChain3->setActionId(10010);
        $actionChain3->setType(ActionChainType::REFER);
        $actionChain3->setNext(10020);

        $button1 = new Button();
        $button1->setText($this->popButton1);
        $button1->setNext(10040);
        $button2 = new Button();
        $button2->setText($this->popButton2);
        $button2->setNext(100);

        $actionChain4 = new ActionChain();
        $actionChain4->setActionId(10020);
        $actionChain4->setType(ActionChainType::POPUP);
        $actionChain4->setTitle($this->popTitle);
        $actionChain4->setText($this->popContent);
        $actionChain4->setImg($this->popImage);
        $actionChain4->setButtons(0, $button1);
        $actionChain4->setButtons(1, $button2);
        $actionChain4->setNext(6);

        $appStartUp = new AppStartUp();
        $appStartUp->setAndroid($this->androidMark);
        $appStartUp->setIOS($this->iosMark);
        $appStartUp->setSymbia($this->symbianMark);
        $actionChain5 = new ActionChain();
        $actionChain5->setActionId(10040);
        $actionChain5->setType(ActionChainType::APPDOWNLOAD);
        $actionChain5->setName($this->loadTitle);
        $actionChain5->setUrl($this->loadUrl);
        $actionChain5->setLogo($this->loadIcon);
        $actionChain5->setAutoInstall($this->isAutoInstall);
        $actionChain5->setAutostart($this->isActived);
        $actionChain5->setAppStartUpId($appStartUp);
        $actionChain5->setNext(6);

        $actionChain6 = new ActionChain();
        $actionChain6->setActionId(100);
        $actionChain6->setType(ActionChainType::EOA);

        array_push(
            $actionChains,
            $actionChain1,
            $actionChain2,
            $actionChain3,
            $actionChain4,
            $actionChain5,
            $actionChain6
        );
        return $actionChains;
    }

    /**
     * @param $notyIcon
     */
    public function setNotyIcon($notyIcon)
    {
        $this->notyIcon = $notyIcon;
    }

    /**
     * @param $notyTitle
     */
    public function setNotyTitle($notyTitle)
    {
        $this->notyTitle = $notyTitle;
    }

    /**
     * @param $logoURL
     */
    public function setLogoURL($logoURL)
    {
        $this->logoURL = $logoURL;
    }

    /**
     * @param $notyContent
     */
    public function setNotyContent($notyContent)
    {
        $this->notyContent = $notyContent;
    }

    /**
     * @param $isCleared
     */
    public function setIsCleared($isCleared)
    {
        $this->isCleared = $isCleared;
    }

    /**
     * @param $isBelled
     */
    public function setIsBelled($isBelled)
    {
        $this->isBelled = $isBelled;
    }

    /**
     * @param $isVibrationed
     */
    public function setIsVibrationed($isVibrationed)
    {
        $this->isVibrationed = $isVibrationed;
    }

    /**
     * @param $popTitle
     */
    public function setPopTitle($popTitle)
    {
        $this->popTitle = $popTitle;
    }

    /**
     * @param $popContent
     */
    public function setPopContent($popContent)
    {
        $this->popContent = $popContent;
    }

    /**
     * @param $popImage
     */
    public function setPopImage($popImage)
    {
        $this->popImage = $popImage;
    }

    /**
     * @param $popButton1
     */
    public function setPopButton1($popButton1)
    {
        $this->popButton1 = $popButton1;
    }

    /**
     * @param $popButton2
     */
    public function setPopButton2($popButton2)
    {
        $this->popButton2 = $popButton2;
    }

    /**
     * @param $loadIcon
     */
    public function setLoadIcon($loadIcon)
    {
        $this->loadIcon = $loadIcon;
    }

    /**
     * @param $loadTitle
     */
    public function setLoadTitle($loadTitle)
    {
        $this->loadTitle = $loadTitle;
    }

    /**
     * @param $loadUrl
     */
    public function setLoadUrl($loadUrl)
    {
        $this->loadUrl = $loadUrl;
    }

    /**
     * @param $isAutoInstall
     */
    public function setIsAutoInstall($isAutoInstall)
    {
        $this->isAutoInstall = $isAutoInstall;
    }

    /**
     * @param $isActived
     */
    public function setIsActived($isActived)
    {
        $this->isActived = $isActived;
    }

    /**
     * @param $symbianMark
     */
    public function setSymbianMark($symbianMark)
    {
        $this->symbianMark = $symbianMark;
    }

    /**
     * @param $androidMark
     */
    public function setAndroidMark($androidMark)
    {
        $this->androidMark = $androidMark;
    }

    /**
     * @param $iosMark
     */
    public function setIOSMark($iosMark)
    {
        $this->iosMark = $iosMark;
    }

    /**
     * @return string
     */
    public function getPushType()
    {
        return 'NotyPopLoadTemplate';
    }
}
