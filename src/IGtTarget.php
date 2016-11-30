<?php
namespace Echobool\Getui;

/**
 * Class IGtTarget
 * @package getuisdk
 */
class IGtTarget
{
    /**
     * @var string $appId
     */
    public $appId;
    /**
     * @var string $clientId
     */
    public $clientId;
    /**
     * @var string $alias
     */
    public $alias;

    /**
     * construct
     */
    public function __construct()
    {

    }

    /**
     * @return string
     */
    public function getAppId()
    {
        return $this->appId;
    }

    /**
     * @param $appId
     * @return mixed
     */
    public function setAppId($appId)
    {
        return $this->appId = $appId;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }

    /**
     * @param $clientId
     * @return mixed
     */
    public function setClientId($clientId)
    {
        return $this->clientId = $clientId;
    }

    /**
     * @param $alias
     * @return mixed
     */
    public function setAlias($alias)
    {
        return $this->alias = $alias;
    }

    /**
     * @return string
     */
    public function getAlias()
    {
        return $this->alias;
    }
}
