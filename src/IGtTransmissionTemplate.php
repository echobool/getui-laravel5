<?php
namespace Echobool\Getui;

/**
 * Class IGtTransmissionTemplate
 * @package getuisdk
 */
class IGtTransmissionTemplate extends IGtBaseTemplate
{
    /**
     * @var string $transmissionType
     */
    public $transmissionType;
    /**
     * @var string $transmissionContent
     */
    public $transmissionContent;

    /**
     * @return array
     */
    public function getActionChain()
    {

        $actionChains = array();

        $actionChain1 = new ActionChain();
        $actionChain1->setActionId(1);
        $actionChain1->setType(ActionChainType::REFER);
        $actionChain1->setNext(10030);

        //appStartUp
        $appStartUp = new AppStartUp();
        $appStartUp->setAndroid('');
        $appStartUp->setSymbia('');
        $appStartUp->setIOS('');
        $actionChain2 = new ActionChain();
        $actionChain2->setActionId(10030);
        $actionChain2->setType(ActionChainType::STARTAPP);
        $actionChain2->setAppId('');
        $actionChain2->setAutostart((string) $this->transmissionType === '1');
        $actionChain2->setAppStartUpId($appStartUp);
        $actionChain2->setFailedAction(100);
        $actionChain2->setNext(100);

        $actionChain3 = new ActionChain();
        $actionChain3->setActionId(100);
        $actionChain3->setType(ActionChainType::EOA);


        array_push($actionChains, $actionChain1, $actionChain2, $actionChain3);

        return $actionChains;
    }

    /**
     * @return string
     */
    public function getTransmissionContent()
    {
        return $this->transmissionContent;
    }

    /**
     * @return string
     */
    public function getPushType()
    {
        return 'TransmissionMsg';
    }

    /**
     * @param $transmissionType
     */
    public function setTransmissionType($transmissionType)
    {
        $this->transmissionType = $transmissionType;
    }

    /**
     * @param $transmissionContent
     */
    public function setTransmissionContent($transmissionContent)
    {
        $this->transmissionContent = $transmissionContent;
    }
}
