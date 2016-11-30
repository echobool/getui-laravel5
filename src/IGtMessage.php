<?php
namespace Echobool\Getui;

/**
 * Class IGtMessage
 * @package getuisdk
 */
class IGtMessage
{
    /**
     * @var string
     */
    public $isOffline;
    /**
     * @var string
     */
    public $offlineExpireTime;

    /**
     * 0: No network;1: wifi; 2: 4G/3G/2G
     */
    /**
     * @var int
     */
    public $pushNetWorkType = 0;
    /**
     * @var array
     */
    public $data;

    /**
     * construct
     */
    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getIsOffline()
    {
        return $this->isOffline;
    }

    /**
     * @param $isOffline
     * @return mixed
     */
    public function setIsOffline($isOffline)
    {
        return $this->isOffline = $isOffline;
    }

    /**
     * @return string
     */
    public function getOfflineExpireTime()
    {
        return $this->offlineExpireTime;
    }

    /**
     * @param $offlineExpireTime
     * @return mixed
     */
    public function setOfflineExpireTime($offlineExpireTime)
    {
        return $this->offlineExpireTime = $offlineExpireTime;
    }

    /**
     * @return int
     */
    public function getPushNetWorkType()
    {
        return $this->pushNetWorkType;
    }

    /**
     * @param $pushNetWorkType
     * @return mixed
     */
    public function setPushNetWorkType($pushNetWorkType)
    {
        return $this->pushNetWorkType = $pushNetWorkType;
    }

    /**
     * @return array
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @param $data
     * @return mixed
     */
    public function setData($data)
    {
        return $this->data = $data;
    }
}
