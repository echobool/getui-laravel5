<?php
namespace Echobool\Getui;

/**
 * Class PushListResult
 * @package getuisdk
 */
class PushListResult extends PBMessage
{
    /**
     * @param null $reader
     */
    public function __construct($reader = null)
    {
        parent::__construct($reader);
        $this->wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
        $this->fields['1'] = 'PushResult';
        $this->values['1'] = array();
    }

    /**
     * @param $offset
     * @return mixed
     */
    public function results($offset)
    {
        return $this->getArrValue('1', $offset);
    }

    /**
     * @return mixed
     */
    public function addResults()
    {
        return $this->addArrValue('1');
    }

    /**
     * @param $index
     * @param $value
     */
    public function setResults($index, $value)
    {
        $this->setArrValue('1', $index, $value);
    }

    /**
     * remove last result
     */
    public function removeLastResults()
    {
        $this->removeLastArrValue('1');
    }

    /**
     * @return mixed
     */
    public function resultsSize()
    {
        return $this->getArrSize('1');
    }
}
