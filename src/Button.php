<?php
namespace Echobool\Getui;

/**
 * Class Button
 * @package getuisdk
 */
class Button extends PBMessage
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
        $this->fields['2'] = 'PBInt';
        $this->values['2'] = '';
    }

    /**
     * @return mixed
     */
    public function text()
    {
        return $this->getValue('1');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setText($value)
    {
        return $this->setValue('1', $value);
    }

    /**
     * @return mixed
     */
    public function next()
    {
        return $this->getValue('2');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setNext($value)
    {
        return $this->setValue('2', $value);
    }
}
