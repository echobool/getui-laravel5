<?php
namespace Echobool\Getui;

/**
 * Class SimpleAlertMsg
 * @package getuisdk
 */
class SimpleAlertMsg implements ApnMsg
{
    /**
     * @var string
     */
    public $alertMsg;

    /**
     * @return string
     */
    public function getAlertMsg()
    {
        return $this->alertMsg;
    }
}
