<?php
namespace Echobool\Getui;

/**
 * Class IGtLinkTemplate
 * @package getuisdk
 */
class IGtLinkTemplate extends IGtBaseTemplate
{

    /**
     *@var string
     */
    public $text;

    /**
     *@var string
     */
    public $title;

    /**
     *@var string
     */
    public $logo;
    /**
     * @var string
     */
    public $logoURL;

    /**
     *@var boolean
     */
    public $isRing;

    /**
     *@var boolean
     */
    public $isVibrate;

    /**
     *@var string
     */
    public $url;

    /**
     *@var boolean
     */
    public $isClearable;

    /**
     * @return array
     */
    public function getActionChain()
    {

        $actionChains = array();

        // ����actionChain
        $actionChain1 = new ActionChain();
        $actionChain1->setActionId(1);
        $actionChain1->setType(ActionChainType::REFER);
        $actionChain1->setNext(10000);

        //֪ͨ
        $actionChain2 = new ActionChain();
        $actionChain2->setActionId(10000);
        $actionChain2->setType(ActionChainType::NOTIFICATION);
        $actionChain2->setTitle($this->title);
        $actionChain2->setText($this->text);
        $actionChain2->setLogo($this->logo);
        $actionChain2->setLogoURL($this->logoURL);
        $actionChain2->setRing($this->isRing ? true : false);
        $actionChain2->setClearable($this->isClearable ? true : false);
        $actionChain2->setBuzz($this->isVibrate ? true : false);
        $actionChain2->setNext(10010);


        //goto
        $actionChain3 = new ActionChain();
        $actionChain3->setActionId(10010);
        $actionChain3->setType(ActionChainType::REFER);
        $actionChain3->setNext(10030);


        //����web
        $actionChain4 = new ActionChain();
        $actionChain4->setActionId(10030);
        $actionChain4->setType(ActionChainType::STARTWEB);
        $actionChain4->setUrl($this->url);
        $actionChain4->setNext(100);


        //����
        $actionChain5 = new ActionChain();
        $actionChain5->setActionId(100);
        $actionChain5->setType(ActionChainType::EOA);

        array_push($actionChains, $actionChain1, $actionChain2, $actionChain3, $actionChain4, $actionChain5);

        return $actionChains;
    }

    /**
     * @return string
     */
    public function getPushType()
    {
        return 'LinkMsg';
    }

    /**
     * @param $text
     */
    public function setText($text)
    {
        $this->text = $text;
    }

    /**
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param $logo
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;
    }

    /**
     * @param $logoURL
     */
    public function setLogoURL($logoURL)
    {
        $this->logoURL = $logoURL;
    }

    /**
     * @param $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

    /**
     * @param $isRing
     */
    public function setIsRing($isRing)
    {
        $this->isRing = $isRing;
    }

    /**
     * @param $isVibrate
     */
    public function setIsVibrate($isVibrate)
    {
        $this->isVibrate = $isVibrate;
    }

    /**
     * @param $isClearable
     */
    public function setIsClearable($isClearable)
    {
        $this->isClearable = $isClearable;
    }
}
