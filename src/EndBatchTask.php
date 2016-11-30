<?php
namespace Echobool\Getui;

/**
 * Class EndBatchTask
 * @package getuisdk
 */
class EndBatchTask extends PBMessage
{
    /**
     * @param object $reader
     */
    public function __construct($reader)
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
    public function taskId()
    {
        return $this->getValue('1');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setTaskId($value)
    {
        return $this->setValue('1', $value);
    }

    /**
     * @return mixed
     */
    public function seqId()
    {
        return $this->getValue('2');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setSeqId($value)
    {
        return $this->setValue('2', $value);
    }
}
