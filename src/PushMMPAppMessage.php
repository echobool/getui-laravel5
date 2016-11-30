<?php
namespace Echobool\Getui;

/**
 * Class PushMMPAppMessage
 * @package getuisdk
 */
class PushMMPAppMessage extends PBMessage
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
        $this->fields['2'] = 'PBString';
        $this->values['2'] = array();
        $this->fields['3'] = 'PBString';
        $this->values['3'] = array();
        $this->fields['4'] = 'PBString';
        $this->values['4'] = array();
        $this->fields['5'] = 'PBString';
        $this->values['5'] = '';
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
     * @param $offset
     * @return mixed
     */
    public function appIdList($offset)
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
    public function appendAppIdList($value)
    {
        $v = $this->addArrValue('2');
        $v->setValue($value);
    }

    /**
     * @param $index
     * @param $value
     */
    public function setAppIdList($index, $value)
    {
        $v = new $this->fields['2']();
        $v->setValue($value);
        $this->setArrValue('2', $index, $v);
    }

    /**
     *  remove last appIdList
     */
    public function removeLastAppIdList()
    {
        $this->removeLastArrValue('2');
    }

    /**
     * @return mixed
     */
    public function appIdListSize()
    {
        return $this->getArrSize('2');
    }

    /**
     * @param $offset
     * @return mixed
     */
    public function phoneTypeList($offset)
    {
        $v = $this->getArrValue('3', $offset);
        return $v->getValue();
    }

    /**
     * @param $value
     */
    public function appendPhoneTypeList($value)
    {
        $v = $this->addArrValue('3');
        $v->setValue($value);
    }

    /**
     * @param $index
     * @param $value
     */
    public function setPhoneTypeList($index, $value)
    {
        $v = new $this->fields['3']();
        $v->setValue($value);
        $this->setArrValue('3', $index, $v);
    }

    /**
     * Remove last phone type list
     */
    public function removeLastPhoneTypeList()
    {
        $this->removeLastArrValue('3');
    }

    /**
     * @return mixed
     */
    public function phoneTypeListSize()
    {
        return $this->getArrSize('3');
    }

    /**
     * @param $offset
     * @return mixed
     */
    public function provinceList($offset)
    {
        $v = $this->getArrValue('4', $offset);
        return $v->getValue();
    }

    /**
     * @param $value
     */
    public function appendProvinceList($value)
    {
        $v = $this->addArrValue('4');
        $v->setValue($value);
    }

    /**
     * @param $index
     * @param $value
     */
    public function setProvinceList($index, $value)
    {
        $v = new $this->fields['4']();
        $v->setValue($value);
        $this->setArrValue('4', $index, $v);
    }

    /**
     * remove last province list
     */
    public function removeLastProvinceList()
    {
        $this->removeLastArrValue('4');
    }

    /**
     * @return mixed
     */
    public function provinceListSize()
    {
        return $this->getArrSize('4');
    }

    /**
     * @return mixed
     */
    public function seqId()
    {
        return $this->getValue('5');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setSeqId($value)
    {
        return $this->setValue('5', $value);
    }
}
