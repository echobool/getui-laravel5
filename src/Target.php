<?php
namespace Echobool\Getui;

/**
 * Class Target
 * @package getuisdk
 */
class Target extends PBMessage
{
    /**
     * @param null $reader
     */
    public function __construct($reader = null)
    {
        parent::__construct($reader);
        $this->wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
        $this->fields['1'] = 'PBString';
        $this->values['1'] = '';
        $this->fields['2'] = 'PBString';
        $this->values['2'] = '';
    }

    /**
     * @return mixed
     */
    public function appId()
    {
        return $this->getValue('1');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setAppId($value)
    {
        return $this->setValue('1', $value);
    }

    /**
     * @return mixed
     */
    public function clientId()
    {
        return $this->getValue('2');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setClientId($value)
    {
        return $this->setValue('2', $value);
    }
}
