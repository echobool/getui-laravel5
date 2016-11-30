<?php
namespace Echobool\Getui;

/**
 * Class IGtBaseTemplate
 * @package getuisdk
 */
class IGtBaseTemplate
{
    /**
     * @var string
     */
    public $appId;
    /**
     * @var string
     */
    public $appkey;
    /**
     * @var string
     */
    public $pushInfo;
    /**
     * @var string
     */
    public $duration;

    /**
     * @return string
     */
    public function getTransparent()
    {
        $transparent = new Transparent();
        $transparent->setId('');
        $transparent->setMessageId('');
        $transparent->setTaskId('');
        $transparent->setAction('pushmessage');
        $transparent->setPushInfo($this->getPushInfo());
        $transparent->setAppId($this->appId);
        $transparent->setAppKey($this->appkey);
        $actionChainList = $this->getActionChain();

        foreach ($actionChainList as $index => $actionChain) {
            $transparent->addActionChain();
            $transparent->setActionChain($index, $actionChain);
        }

        $transparent->appendCondition($this->getDurcondition());

        return $transparent->serializeToString();

        //return $transparent->condition(0);
    }

    /**
     * @return array
     */
    public function getActionChain()
    {
        $list = [];
        return $list;
    }

    /**
     * @return string
     */
    public function getDurcondition()
    {
        return 'duration=' . $this->duration;
    }

    /**
     * @return string
     */
    public function getDuration()
    {
        return $this->duration;
    }

    /**
     * @param $begin
     * @param $end
     * @throws \InvalidArgumentException
     */
    public function setDuration($begin, $end)
    {
        date_default_timezone_set('asia/shanghai');
        /*  //for test
            var_dump(date('Y-m-d H:i:s',strtotime($begin)));
            var_dump(date('Y-m-d H:i:s',strtotime($end)));
        */
        $ss = (string)strtotime($begin) * 1000;
        $e = (string)strtotime($end) * 1000;
        if ($ss <= 0 || $e <= 0) {
            throw new \InvalidArgumentException('DateFormat: yyyy-MM-dd HH:mm:ss');
        }
        if ($ss > $e) {
            throw new \InvalidArgumentException('startTime should be smaller than endTime');
        }

        $this->duration = $ss . '-' . $e;

    }

    /**
     * @return null
     */
    public function getTransmissionContent()
    {
        return null;
    }

    /**
     * @return null
     */
    public function getPushType()
    {
        return null;
    }

    /**
     * @return PushInfo|string
     */
    public function getPushInfo()
    {
        if ($this->pushInfo === null) {
            $this->pushInfo = new PushInfo();
            //$this->pushInfo->setInvalidAPN(true);
            //$this->pushInfo->setInvalidMPN(true);
        }

        return $this->pushInfo;
    }

    /**
     * @param $actionLocKey
     * @param $badge
     * @param $message
     * @param $sound
     * @param $payload
     * @param $locKey
     * @param $locArgs
     * @param $launchImage
     * @param int $contentAvailable
     * @throws \Exception
     */
    public function setPushInfo($actionLocKey, $badge, $message, $sound, $payload, $locKey, $locArgs, $launchImage, $contentAvailable = 0)
    {
        $this->pushInfo = new PushInfo();
        $this->pushInfo->setInvalidAPN(true);
        $this->pushInfo->setInvalidMPN(true);
        $apn = new IGtAPNPayload();

        $alertMsg = new DictionaryAlertMsg();
        if ($actionLocKey !== null && $actionLocKey !== '') {
            $alertMsg->actionLocKey = $actionLocKey;
        }
        if ($message !== null && $message !== '') {
            $alertMsg->body = $message;
        }
        if ($locKey !== null && $locKey !== '') {
            $alertMsg->locKey = $locKey;
        }
        if ($locArgs !== null && $locArgs !== '') {
            $alertMsg->locArgs[] = $locArgs;
        }

        if ($launchImage !== null && $launchImage !== '') {
            $alertMsg->launchImage = $launchImage;
        }
        $apn->alertMsg = $alertMsg;

        if ($badge !== null) {
            $apn->badge = $badge;
        }
        if ($sound !== null && $sound !== '') {
            $apn->sound = $sound;
        }
        if ($contentAvailable !== null) {
            $apn->contentAvailable = $contentAvailable;
        }
        if ($payload !== null && $payload !== '') {
            $apn->addCustomMsg('payload', $payload);
        }
        $this->setApnInfo($apn);
    }

    /**
     * @param $payload
     * @throws \Exception
     */
    public function setApnInfo($payload)
    {
        if ($payload === null) {
            return;
        }
        $payload = $payload->getPayload();
        if ($payload === null || $payload === '') {
            return;
        }
        $len = strlen($payload);
        if ($len > IGtAPNPayload::$PAYLOAD_MAX_BYTES) {
            throw new \InvalidArgumentException('APN payload length overlength ('
                . $len . '>' . IGtAPNPayload::$PAYLOAD_MAX_BYTES . ')');
        }
        $this->pushInfo = new PushInfo();
        $this->pushInfo->setApnJson($payload);
        $this->pushInfo->setInvalidAPN(false);
    }

    /**
     * @param $appId
     */
    public function setAppId($appId)
    {
        $this->appId = $appId;
    }

    /**
     * @param $appkey
     */
    public function setAppKey($appkey)
    {
        $this->appkey = $appkey;
    }

    /**
     * @param $str
     * @return int
     */
    public function abslength($str)
    {
        if ($str === '') {
            return 0;
        }
        if (function_exists('mb_strlen')) {
            return mb_strlen($str, 'utf-8');
        } else {
            preg_match_all('/./u', $str, $ar);
            return count($ar[0]);
        }
    }
}
