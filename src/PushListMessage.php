<?php
namespace Echobool\Getui;

/**
 * Class PushListMessage
 * @package getuisdk
 */
class PushListMessage extends PBMessage
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
        $this->fields['3'] = 'Target';
        $this->values['3'] = array();
    }

    /**
     * @return mixed
     */
    public function seqId()
    {
        return $this->getValue('1');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setSeqId($value)
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
     * @param $offset
     * @return mixed
     */
    public function targets($offset)
    {
        return $this->getArrValue('3', $offset);
    }

    /**
     * @return mixed
     */
    public function addTargets()
    {
        return $this->addArrValue('3');
    }

    /**
     * @param $index
     * @param $value
     */
    public function setTargets($index, $value)
    {
        $this->setArrValue('3', $index, $value);
    }

    /**
     * remove last err value
     */
    public function removeLastTargets()
    {
        $this->removeLastArrValue('3');
    }

    /**
     * @return mixed
     */
    public function targetsSize()
    {
        return $this->getArrSize('3');
    }
}
