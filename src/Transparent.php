<?php
namespace Echobool\Getui;

/**
 * Class Transparent
 * @package getuisdk
 */
class Transparent extends PBMessage
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
        $this->fields['4'] = 'PBString';
        $this->values['4'] = '';
        $this->fields['5'] = 'PBString';
        $this->values['5'] = '';
        $this->fields['6'] = 'PBString';
        $this->values['6'] = '';
        $this->fields['7'] = 'PushInfo';
        $this->values['7'] = '';
        $this->fields['8'] = 'ActionChain';
        $this->values['8'] = array();
        $this->fields['9'] = 'PBString';
        $this->values['9'] = array();
    }

    /**
     * @return mixed
     */
    public function id()
    {
        return $this->getValue('1');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setId($value)
    {
        return $this->setValue('1', $value);
    }

    /**
     * @return mixed
     */
    public function action()
    {
        return $this->getValue('2');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setAction($value)
    {
        return $this->setValue('2', $value);
    }

    /**
     * @return mixed
     */
    public function taskId()
    {
        return $this->getValue('3');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setTaskId($value)
    {
        return $this->setValue('3', $value);
    }

    /**
     * @return mixed
     */
    public function appKey()
    {
        return $this->getValue('4');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setAppKey($value)
    {
        return $this->setValue('4', $value);
    }

    /**
     * @return mixed
     */
    public function appId()
    {
        return $this->getValue('5');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setAppId($value)
    {
        return $this->setValue('5', $value);
    }

    /**
     * @return mixed
     */
    public function messageId()
    {
        return $this->getValue('6');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setMessageId($value)
    {
        return $this->setValue('6', $value);
    }

    /**
     * @return mixed
     */
    public function pushInfo()
    {
        return $this->getValue('7');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setPushInfo($value)
    {
        return $this->setValue('7', $value);
    }

    /**
     * @param $offset
     * @return mixed
     */
    public function actionChain($offset)
    {
        return $this->getArrValue('8', $offset);
    }

    /**
     * @return mixed
     */
    public function addActionChain()
    {
        return $this->addArrValue('8');
    }

    /**
     * @param $index
     * @param $value
     */
    public function setActionChain($index, $value)
    {
        $this->setArrValue('8', $index, $value);
    }

    /**
     * Remove last actionChain
     */
    public function removeLastActionChain()
    {
        $this->removeLastArrValue('8');
    }

    /**
     * @return mixed
     */
    public function actionChainSize()
    {
        return $this->getArrSize('8');
    }

    /**
     * @param $offset
     * @return mixed
     */
    public function condition($offset)
    {
        $v = $this->getArrValue('9', $offset);
        if (method_exists($v, 'getValue')) {
            return $v->getValue();
        }
        return false;
    }

    /**
     * @param $value
     */
    public function appendCondition($value)
    {
        $v = $this->addArrValue('9');
        if (method_exists($v, 'setValue')) {
            $v->setValue($value);
        }
    }

    /**
     * @param $index
     * @param $value
     */
    public function setCondition($index, $value)
    {
        $v = new $this->fields['9']();
        if (method_exists($v, 'setValue')) {
            $v->setValue($value);
        }
        $this->setArrValue('9', $index, $v);
    }

    /**
     * Remove last condition
     */
    public function removeLastCondition()
    {
        $this->removeLastArrValue('9');
    }

    /**
     * @return mixed
     */
    public function conditionSize()
    {
        return $this->getArrSize('9');
    }
}
