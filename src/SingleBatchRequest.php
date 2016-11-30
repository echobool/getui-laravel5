<?php
namespace Echobool\Getui;

/**
 * Class SingleBatchRequest
 * @package getuisdk
 */
class SingleBatchRequest extends PBMessage
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
        $this->fields['2'] = 'SingleBatchItem';
        $this->values['2'] = array();
    }

    /**
     * @return mixed
     */
    public function batchId()
    {
        return $this->getValue('1');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setBatchId($value)
    {
        return $this->setValue('1', $value);
    }

    /**
     * @param $offset
     * @return mixed
     */
    public function batchItem($offset)
    {
        return $this->getArrValue('2', $offset);
    }

    /**
     * @return mixed
     */
    public function addBatchItem()
    {
        return $this->addArrValue('2');
    }

    /**
     * @param $index
     * @param $value
     */
    public function setBatchItem($index, $value)
    {
        $this->setArrValue('2', $index, $value);
    }

    /**
     * Remove last batchItem
     */
    public function removeLastBatchItem()
    {
        $this->removeLastArrValue('2');
    }

    /**
     * @return mixed
     */
    public function batchItemSize()
    {
        return $this->getArrSize('2');
    }
}
