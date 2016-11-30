<?php
namespace Echobool\Getui;

/**
 * Class ServerNotify
 * @package getuisdk
 */
class ServerNotify extends PBMessage
{
    /**
     * @param null $reader
     */
    public function __construct($reader = null)
    {
        parent::__construct($reader);
        $this->wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
        $this->fields['1'] = 'ServerNotify_NotifyType';
        $this->values['1'] = '';
        $this->fields['2'] = 'PBString';
        $this->values['2'] = '';
        $this->fields['3'] = 'PBString';
        $this->values['3'] = '';
        $this->fields['4'] = 'PBString';
        $this->values['4'] = '';
    }

    /**
     * @return mixed
     */
    public function type()
    {
        return $this->getValue('1');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setType($value)
    {
        return $this->setValue('1', $value);
    }

    /**
     * @return mixed
     */
    public function info()
    {
        return $this->getValue('2');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setInfo($value)
    {
        return $this->setValue('2', $value);
    }

    /**
     * @return mixed
     */
    public function extradata()
    {
        return $this->getValue('3');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setExtradata($value)
    {
        return $this->setValue('3', $value);
    }

    /**
     * @return mixed
     */
    public function seqId()
    {
        return $this->getValue('4');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setSeqId($value)
    {
        return $this->setValue('4', $value);
    }
}
