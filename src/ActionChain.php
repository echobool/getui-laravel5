<?php

namespace Echobool\Getui;

/**
 * Class ActionChain
 * @package getuisdk
 */
class ActionChain extends PBMessage
{
    /**
     * @param object $reader
     */
    public function __construct($reader = null)
    {
        parent::__construct($reader);
        $this->wired_type = PBMessage::WIRED_LENGTH_DELIMITED;
        $this->fields['1'] = 'PBInt';
        $this->values['1'] = '';
        $this->fields['2'] = 'ActionChainType';
        $this->values['2'] = '';
        $this->fields['3'] = 'PBInt';
        $this->values['3'] = '';
        $this->fields['100'] = 'PBString';
        $this->values['100'] = '';
        $this->fields['101'] = 'PBString';
        $this->values['101'] = '';
        $this->fields['102'] = 'PBString';
        $this->values['102'] = '';
        $this->fields['103'] = 'PBString';
        $this->values['103'] = '';
        $this->fields['104'] = 'PBBool';
        $this->values['104'] = '';
        $this->fields['105'] = 'PBBool';
        $this->values['105'] = '';
        $this->fields['106'] = 'PBBool';
        $this->values['106'] = '';
        $this->fields['107'] = 'PBString';
        $this->values['107'] = '';
        $this->fields['120'] = 'PBString';
        $this->values['120'] = '';
        $this->fields['121'] = 'Button';
        $this->values['121'] = array();
        $this->fields['140'] = 'PBString';
        $this->values['140'] = '';
        $this->fields['141'] = 'AppStartUp';
        $this->values['141'] = '';
        $this->fields['142'] = 'PBBool';
        $this->values['142'] = '';
        $this->fields['143'] = 'PBInt';
        $this->values['143'] = '';
        $this->fields['160'] = 'PBString';
        $this->values['160'] = '';
        $this->fields['161'] = 'PBString';
        $this->values['161'] = '';
        $this->fields['162'] = 'PBBool';
        $this->values['162'] = '';
        $this->values['162'] = new PBBool();
        $this->values['162']->value = false;
        $this->fields['180'] = 'PBString';
        $this->values['180'] = '';
        $this->fields['181'] = 'PBString';
        $this->values['181'] = '';
        $this->fields['182'] = 'PBInt';
        $this->values['182'] = '';
        $this->fields['183'] = 'ActionChainSMSStatus';
        $this->values['183'] = '';
        $this->fields['200'] = 'PBInt';
        $this->values['200'] = '';
        $this->fields['201'] = 'PBInt';
        $this->values['201'] = '';
        $this->fields['220'] = 'PBString';
        $this->values['220'] = '';
        $this->fields['223'] = 'PBBool';
        $this->values['223'] = '';
        $this->fields['225'] = 'PBBool';
        $this->values['225'] = '';
        $this->fields['226'] = 'PBBool';
        $this->values['226'] = '';
        $this->fields['227'] = 'PBBool';
        $this->values['227'] = '';
        $this->fields['241'] = 'PBString';
        $this->values['241'] = '';
        $this->fields['242'] = 'PBString';
        $this->values['242'] = '';
        $this->fields['260'] = 'PBBool';
        $this->values['260'] = '';
        $this->fields['280'] = 'PBString';
        $this->values['280'] = '';
        $this->fields['281'] = 'PBString';
        $this->values['281'] = '';
        $this->fields['300'] = 'PBBool';
        $this->values['300'] = '';
        $this->fields['320'] = 'PBString';
        $this->values['320'] = '';
        $this->fields['340'] = 'PBInt';
        $this->values['340'] = '';
        $this->fields['360'] = 'PBString';
        $this->values['360'] = '';
    }

    /**
     * @return mixed
     */
    public function actionId()
    {
        return $this->getValue('1');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setActionId($value)
    {
        return $this->setValue('1', $value);
    }

    /**
     * @return mixed
     */
    public function type()
    {
        return $this->getValue('2');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setType($value)
    {
        return $this->setValue('2', $value);
    }

    /**
     * @return mixed
     */
    public function next()
    {
        return $this->getValue('3');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setNext($value)
    {
        return $this->setValue('3', $value);
    }

    /**
     * @return mixed
     */
    public function logo()
    {
        return $this->getValue('100');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setLogo($value)
    {
        return $this->setValue('100', $value);
    }

    /**
     * @return mixed
     */
    public function logoURL()
    {
        return $this->getValue('101');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setLogoURL($value)
    {
        return $this->setValue('101', $value);
    }

    /**
     * @return mixed
     */
    public function title()
    {
        return $this->getValue('102');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setTitle($value)
    {
        return $this->setValue('102', $value);
    }

    /**
     * @return mixed
     */
    public function text()
    {
        return $this->getValue('103');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setText($value)
    {
        return $this->setValue('103', $value);
    }

    /**
     * @return mixed
     */
    public function clearable()
    {
        return $this->getValue('104');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setClearable($value)
    {
        return $this->setValue('104', $value);
    }

    /**
     * @return mixed
     */
    public function ring()
    {
        return $this->getValue('105');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setRing($value)
    {
        return $this->setValue('105', $value);
    }

    /**
     * @return mixed
     */
    public function buzz()
    {
        return $this->getValue('106');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setBuzz($value)
    {
        return $this->setValue('106', $value);
    }

    /**
     * @return mixed
     */
    public function bannerURL()
    {
        return $this->getValue('107');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setBannerURL($value)
    {
        return $this->setValue('107', $value);
    }

    /**
     * @return mixed
     */
    public function img()
    {
        return $this->getValue('120');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setImg($value)
    {
        return $this->setValue('120', $value);
    }

    /**
     * @param $offset
     * @return mixed
     */
    public function buttons($offset)
    {
        return $this->getArrValue('121', $offset);
    }

    /**
     * @return mixed
     */
    public function addButtons()
    {
        return $this->addArrValue('121');
    }

    /**
     * @param $index
     * @param $value
     */
    public function setButtons($index, $value)
    {
        $this->setArrValue('121', $index, $value);
    }

    /**
     * remove last buttons
     */
    public function removeLastButtons()
    {
        $this->removeLastArrValue('121');
    }

    /**
     * @return mixed
     */
    public function buttonsSize()
    {
        return $this->getArrSize('121');
    }

    /**
     * @return mixed
     */
    public function appid()
    {
        return $this->getValue('140');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setAppId($value)
    {
        return $this->setValue('140', $value);
    }

    /**
     * @return mixed
     */
    public function appstartupid()
    {
        return $this->getValue('141');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setAppStartUpId($value)
    {
        return $this->setValue('141', $value);
    }

    /**
     * @return mixed
     */
    public function autostart()
    {
        return $this->getValue('142');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setAutostart($value)
    {
        return $this->setValue('142', $value);
    }

    /**
     * @return mixed
     */
    public function failedAction()
    {
        return $this->getValue('143');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setFailedAction($value)
    {
        return $this->setValue('143', $value);
    }

    /**
     * @return mixed
     */
    public function url()
    {
        return $this->getValue('160');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setUrl($value)
    {
        return $this->setValue('160', $value);
    }

    /**
     * @return mixed
     */
    public function withcid()
    {
        return $this->getValue('161');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setWithcid($value)
    {
        return $this->setValue('161', $value);
    }

    /**
     * @return mixed
     */
    public function isWithnettype()
    {
        return $this->getValue('162');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setIsWithnettype($value)
    {
        return $this->setValue('162', $value);
    }

    /**
     * @return mixed
     */
    public function address()
    {
        return $this->getValue('180');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setAddress($value)
    {
        return $this->setValue('180', $value);
    }

    /**
     * @return mixed
     */
    public function content()
    {
        return $this->getValue('181');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setContent($value)
    {
        return $this->setValue('181', $value);
    }

    /**
     * @return mixed
     */
    public function ct()
    {
        return $this->getValue('182');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setCt($value)
    {
        return $this->setValue('182', $value);
    }

    /**
     * @return mixed
     */
    public function flag()
    {
        return $this->getValue('183');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setFlag($value)
    {
        return $this->setValue('183', $value);
    }

    /**
     * @return mixed
     */
    public function successedAction()
    {
        return $this->getValue('200');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setSuccessedAction($value)
    {
        return $this->setValue('200', $value);
    }

    /**
     * @return mixed
     */
    public function uninstalledAction()
    {
        return $this->getValue('201');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setUninstalledAction($value)
    {
        return $this->setValue('201', $value);
    }

    /**
     * @return mixed
     */
    public function name()
    {
        return $this->getValue('220');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setName($value)
    {
        return $this->setValue('220', $value);
    }

    /**
     * @return mixed
     */
    public function autoInstall()
    {
        return $this->getValue('223');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setAutoInstall($value)
    {
        return $this->setValue('223', $value);
    }

    /**
     * @return mixed
     */
    public function wifiAutodownload()
    {
        return $this->getValue('225');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setWifiAutodownload($value)
    {
        return $this->setValue('225', $value);
    }

    /**
     * @return mixed
     */
    public function forceDownload()
    {
        return $this->getValue('226');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setForceDownload($value)
    {
        return $this->setValue('226', $value);
    }

    /**
     * @return mixed
     */
    public function showProgress()
    {
        return $this->getValue('227');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setShowProgress($value)
    {
        return $this->setValue('227', $value);
    }

    /**
     * @return mixed
     */
    public function post()
    {
        return $this->getValue('241');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setPost($value)
    {
        return $this->setValue('241', $value);
    }

    /**
     * @return mixed
     */
    public function headers()
    {
        return $this->getValue('242');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setHeaders($value)
    {
        return $this->setValue('242', $value);
    }

    /**
     * @return mixed
     */
    public function groupable()
    {
        return $this->getValue('260');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setGroupable($value)
    {
        return $this->setValue('260', $value);
    }

    /**
     * @return mixed
     */
    public function mmsTitle()
    {
        return $this->getValue('280');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setMmsTitle($value)
    {
        return $this->setValue('280', $value);
    }

    /**
     * @return mixed
     */
    public function mmsURL()
    {
        return $this->getValue('281');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setMmsURL($value)
    {
        return $this->setValue('281', $value);
    }

    /**
     * @return mixed
     */
    public function preload()
    {
        return $this->getValue('300');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setPreload($value)
    {
        return $this->setValue('300', $value);
    }

    /**
     * @return mixed
     */
    public function taskid()
    {
        return $this->getValue('320');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setTaskId($value)
    {
        return $this->setValue('320', $value);
    }

    /**
     * @return mixed
     */
    public function duration()
    {
        return $this->getValue('340');
    }

    /**
     * @param $value
     * @return mixed
     */
    public function setDuration($value)
    {
        return $this->setValue('340', $value);
    }

    /**
     * @return mixed
     */
    public function date()
    {
        return $this->getValue('360');
    }

    /**
     * @param $value
     * @return mixedsss
     */
    public function setDate($value)
    {
        return $this->setValue('360', $value);
    }
}
