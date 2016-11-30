<?php
namespace Echobool\Getui;

/**
 * Class ReqServListResult
 * @package getuisdk
 */
class ReqServListResult extends PBMessage
{
    /**
     * @param null $reader
     */
    public function __construct($reader = null)
    {
        parent::__construct($reader);
        $this->wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
        $this->fields['1'] = 'PBInt';
        $this->values['1'] = '';
        $this->fields['2'] = 'PBString';
        $this->values['2'] = array();
        $this->fields['3'] = 'PBString';
        $this->values['3'] = '';
    }

    /**
     * @return mixed
     */
    public function code()
    {
        return $this->getValue('1');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setCode($value)
    {
        return $this->setValue('1', $value);
    }

    /**
     * @param $offset
     * @return mixed
     */
    public function host($offset)
    {
        $v = $this->getArrValue('2', $offset);
        if (method_exists($v, 'getValue')) {
            return $v->getValue();
        }
        return false;
    }

    /**
     * @param $value
     */
    public function appendHost($value)
    {
        $v = $this->addArrValue('2');
        if (method_exists($v, 'setValue')) {
            $v->setValue($value);
        }
    }

    /**
     * @param $index
     * @param $value
     */
    public function setHost($index, $value)
    {
        $v = new $this->fields['2']();
        if (method_exists($v, 'setValue')) {
            $v->setValue($value);
        }
        $this->setArrValue('2', $index, $v);
    }

    /**
     * remove last host
     */
    public function removeLastHost()
    {
        $this->removeLastArrValue('2');
    }

    /**
     * @return mixed
     */
    public function hostSize()
    {
        return $this->getArrSize('2');
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

