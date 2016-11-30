<?php
namespace Echobool\Getui;

/**
 * Class MMPMessage
 * @package getuisdk
 */
class MMPMessage extends PBMessage
{
    /**
     * @param null $reader
     */
    public function __construct($reader = null)
    {
        parent::__construct($reader);
        $this->wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
        $this->fields['2'] = 'Transparent';
        $this->values['2'] = '';
        $this->fields['3'] = 'PBString';
        $this->values['3'] = '';
        $this->fields['4'] = 'PBInt';
        $this->values['4'] = '';
        $this->fields['5'] = 'PBInt';
        $this->values['5'] = '';
        $this->fields['6'] = 'PBInt';
        $this->values['6'] = '';
        $this->fields['7'] = 'PBBool';
        $this->values['7'] = '';
        $this->values['7'] = new PBBool();
        $this->values['7']->value = true;
        $this->fields['8'] = 'PBInt';
        $this->values['8'] = '';
    }

    /**
     * @return mixed
     */
    public function transparent()
    {
        return $this->getValue('2');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setTransparent($value)
    {
        return $this->setValue('2', $value);
    }

    /**
     * @return mixed
     */
    public function extraData()
    {
        return $this->getValue('3');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setExtraData($value)
    {
        return $this->setValue('3', $value);
    }

    /**
     * @return mixed
     */
    public function msgType()
    {
        return $this->getValue('4');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setMsgType($value)
    {
        return $this->setValue('4', $value);
    }

    /**
     * @return mixed
     */
    public function msgTraceFlag()
    {
        return $this->getValue('5');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setMsgTraceFlag($value)
    {
        return $this->setValue('5', $value);
    }

    /**
     * @return mixed
     */
    public function msgOfflineExpire()
    {
        return $this->getValue('6');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setMsgOfflineExpire($value)
    {
        return $this->setValue('6', $value);
    }

    /**
     * @return mixed
     */
    public function isOffline()
    {
        return $this->getValue('7');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setIsOffline($value)
    {
        return $this->setValue('7', $value);
    }

    /**
     * @return mixed
     */
    public function priority()
    {
        return $this->getValue('8');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setPriority($value)
    {
        return $this->setValue('8', $value);
    }
}
