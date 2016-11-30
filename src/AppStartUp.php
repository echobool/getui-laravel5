<?php
namespace Echobool\Getui;

/**
 * Class AppStartUp
 * @package getuisdk
 */
class AppStartUp extends PBMessage
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
        $this->fields['3'] = 'PBString';
        $this->values['3'] = '';
    }

    /**
     * @return mixed
     */
    public function android()
    {
        return $this->getValue('1');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setAndroid($value)
    {
        return $this->setValue('1', $value);
    }

    /**
     * @return mixed
     */
    public function symbia()
    {
        return $this->getValue('2');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setSymbia($value)
    {
        return $this->setValue('2', $value);
    }

    /**
     * @return mixed
     */
    public function ios()
    {
        return $this->getValue('3');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setIOS($value)
    {
        return $this->setValue('3', $value);
    }
}
