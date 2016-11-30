<?php
namespace Echobool\Getui;

/**
 * Class Payload
 * @package getuisdk
 */
class Payload
{
    /**
     * @var string
     */
    public $APS = 'aps';
    /**
     * @var array
     */
    public $params;
    /**
     * @var string
     */
    public $alert;
    /**
     * @var string
     */
    public $badge;
    /**
     * @var string
     */
    public $sound = '';
    /**
     * @var string
     */
    public $alertBody;
    /**
     * @var string
     */
    public $alertActionLocKey;
    /**
     * @var string
     */
    public $alertLocKey;
    /**
     * @var string
     */
    public $alertLocArgs;
    /**
     * @var string
     */
    public $alertLaunchImage;
    /**
     * @var string
     */
    public $contentAvailable;

    /**
     * @return array
     */
    public function getParams()
    {
        return $this->params;
    }

    /**
     * @param $params
     */
    public function setParams($params)
    {
        $this->params = $params;
    }

    /**
     * @param $key
     * @param $obj
     * @throws \InvalidArgumentException
     */
    public function addParam($key, $obj)
    {
        if ($this->params === null) {
            $this->params = array();
        }
        if ($this->APS === strtolower($key)) {
            throw new \InvalidArgumentException('the key can not be aps');
        }
        $this->params[$key] = $obj;
    }

    /**
     * @return string
     */
    public function getAlert()
    {
        return $this->alert;
    }

    /**
     * @param $alert
     */
    public function setAlert($alert)
    {
        $this->alert = $alert;
    }

    /**
     * @return string
     */
    public function getBadge()
    {
        return $this->badge;
    }

    /**
     * @param $badge
     */
    public function setBadge($badge)
    {
        $this->badge = $badge;
    }

    /**
     * @return string
     */
    public function getSound()
    {
        return $this->sound;
    }

    /**
     * @param $sound
     */
    public function setSound($sound)
    {
        $this->sound = $sound;
    }

    /**
     * @return string
     */
    public function getAlertBody()
    {
        return $this->alertBody;
    }

    /**
     * @param $alertBody
     */
    public function setAlertBody($alertBody)
    {
        $this->alertBody = $alertBody;
    }

    /**
     * @return string
     */
    public function getAlertActionLocKey()
    {
        return $this->alertActionLocKey;
    }

    /**
     * @param $alertActionLocKey
     */
    public function setAlertActionLocKey($alertActionLocKey)
    {
        $this->alertActionLocKey = $alertActionLocKey;
    }

    /**
     * @return string
     */
    public function getAlertLocKey()
    {
        return $this->alertLocKey;
    }

    /**
     * @param $alertLocKey
     */
    public function setAlertLocKey($alertLocKey)
    {
        $this->alertLocKey = $alertLocKey;
    }

    /**
     * @return string
     */
    public function getAlertLaunchImage()
    {
        return $this->alertLaunchImage;
    }

    /**
     * @param $alertLaunchImage
     */
    public function setAlertLaunchImage($alertLaunchImage)
    {
        $this->alertLaunchImage = $alertLaunchImage;
    }

    /**
     * @return string
     */
    public function getAlertLocArgs()
    {
        return $this->alertLocArgs;
    }

    /**
     * @param $alertLocArgs
     */
    public function setAlertLocArgs($alertLocArgs)
    {
        $this->alertLocArgs = $alertLocArgs;
    }

    /**
     * @return string
     */
    public function getContentAvailable()
    {
        return $this->contentAvailable;
    }

    /**
     * @param $contentAvailable
     */
    public function setContentAvailable($contentAvailable)
    {
        $this->contentAvailable = $contentAvailable;
    }

    /**
     * @param $key
     * @param $value
     * @param $obj
     * @return mixed
     */
    public function putIntoJson($key, $value, $obj)
    {
        if ($value !== null) {
            $obj[$key] = $value;
        }
        return $obj;
    }

    /**
     * @return string
     */
    public function toString()
    {
        $object = array();
        $apsObj = array();
        if ($this->getAlert() !== null) {
            $apsObj['alert'] = urlencode($this->getAlert());
        } else {
            if ($this->getAlertBody() !== null || $this->getAlertLocKey() !== null) {
                $alertObj = array();
                $alertObj = $this->putIntoJson('body', ($this->getAlertBody()), $alertObj);
                $alertObj = $this->putIntoJson('action-loc-key', ($this->getAlertActionLocKey()), $alertObj);
                $alertObj = $this->putIntoJson('loc-key', ($this->getAlertLocKey()), $alertObj);
                $alertObj = $this->putIntoJson('launch-image', ($this->getAlertLaunchImage()), $alertObj);
                if ($this->getAlertLocArgs() !== null) {
                    $array = array();
                    foreach ($this->getAlertLocArgs() as $str) {
                        $array[] = $str;
                    }
                    $alertObj['loc-args'] = $array;
                }
                $apsObj['alert'] = $alertObj;
            }
        }
        if ($this->getBadge() !== null) {
            $apsObj['badge'] = $this->getBadge();
        }
        if ('com.gexin.ios.silence' !== ($this->getSound())) {
            $apsObj = $this->putIntoJson('sound', ($this->getSound()), $apsObj);
        }
        if ($this->getContentAvailable() === 1) {
            $apsObj['content-available'] = 1;
        }
        $object[$this->APS] = $apsObj;
        if ($this->getParams() !== null) {
            foreach ($this->getParams() as $key => $value) {
                $object[($key)] = ($value);
            }
        }
        return json_encode($object, JSON_UNESCAPED_UNICODE);
    }
}
