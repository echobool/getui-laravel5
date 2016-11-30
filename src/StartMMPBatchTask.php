<?php
namespace Echobool\Getui;

/**
 * Class StartMMPBatchTask
 * @package getuisdk
 */
class StartMMPBatchTask extends PBMessage
{
    /**
     * @param null $reader
     */
    public function __construct($reader = null)
    {
        parent::__construct($reader);
        $this->wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
        $this->fields['1'] = 'MMPMessage';
        $this->values['1'] = '';
        $this->fields['2'] = 'PBInt';
        $this->values['2'] = '';
        $this->fields['3'] = 'PBString';
        $this->values['3'] = '';
    }

    /**
     * @return mixed
     */
    public function message()
    {
        return $this->getValue('1');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setMessage($value)
    {
        return $this->setValue('1', $value);
    }

    /**
     * @return mixed
     */
    public function expire()
    {
        return $this->getValue('2');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setExpire($value)
    {
        return $this->setValue('2', $value);
    }

    /**
     * @return mixed
     */
    public function seqId()
    {
        return $this->getValue('3');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setSeqId($value)
    {
        return $this->setValue('3', $value);
    }
}
