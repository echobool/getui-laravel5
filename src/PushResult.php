<?php
namespace Echobool\Getui;

/**
 * Class PushResult
 * @package getuisdk
 */
class PushResult extends PBMessage
{
    /**
     * @param null $reader
     */
    public function __construct($reader = null)
    {
        parent::__construct($reader);
        $this->wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
        $this->fields['1'] = 'PushResult_EPushResult';
        $this->values['1'] = '';
        $this->fields['2'] = 'PBString';
        $this->values['2'] = '';
        $this->fields['3'] = 'PBString';
        $this->values['3'] = '';
        $this->fields['4'] = 'PBString';
        $this->values['4'] = '';
        $this->fields['5'] = 'PBString';
        $this->values['5'] = '';
        $this->fields['6'] = 'PBString';
        $this->values['6'] = '';
        $this->fields['7'] = 'PBString';
        $this->values['7'] = '';
    }

    /**
     * @return mixed
     */
    public function result()
    {
        return $this->getValue('1');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setResult($value)
    {
        return $this->setValue('1', $value);
    }

    /**
     * @return mixed
     */
    public function taskId()
    {
        return $this->getValue('2');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setTaskId($value)
    {
        return $this->setValue('2', $value);
    }

    /**
     * @return mixed
     */
    public function messageId()
    {
        return $this->getValue('3');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setMessageId($value)
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

    /**
     * @return mixed
     */
    public function target()
    {
        return $this->getValue('5');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setTarget($value)
    {
        return $this->setValue('5', $value);
    }

    /**
     * @return mixed
     */
    public function info()
    {
        return $this->getValue('6');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setInfo($value)
    {
        return $this->setValue('6', $value);
    }

    /**
     * @return mixed
     */
    public function traceId()
    {
        return $this->getValue('7');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setTraceId($value)
    {
        return $this->setValue('7', $value);
    }
}
