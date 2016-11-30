<?php
namespace Echobool\Getui;

/**
 * Class IGtAppMessage
 * @package getuisdk
 */
class IGtAppMessage extends IGtMessage
{

    //array('','',..)
    /**
     * @var array $appIdList
     */
    public $appIdList;

    //array('','',..)
    /**
     * @var array $phoneTypeList
     */
    public $phoneTypeList;

    //array('','',..)
    /**
     * @var array $provinceList
     */
    public $provinceList;
    /**
     * @var array $tagList
     */
    public $tagList;
    /**
     * @var int $speed
     */
    public $speed = 0;

    /**
     * construct
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @return array
     */
    public function getAppIdList()
    {
        return $this->appIdList;
    }

    /**
     * @param $appIdList
     */
    public function setAppIdList($appIdList)
    {
        $this->appIdList = $appIdList;
    }

    /**
     * @return array
     */
    public function getPhoneTypeList()
    {
        return $this->phoneTypeList;
    }

    /**
     * @param $phoneTypeList
     */
    public function setPhoneTypeList($phoneTypeList)
    {
        $this->phoneTypeList = $phoneTypeList;
    }

    /**
     * @return array
     */
    public function getProvinceList()
    {
        return $this->provinceList;
    }

    /**
     * @param $provinceList
     */
    public function setProvinceList($provinceList)
    {
        $this->provinceList = $provinceList;
    }

    /**
     * @return array
     */
    public function getTagList()
    {
        return $this->tagList;
    }

    /**
     * @param $tagList
     */
    public function setTagList($tagList)
    {
        $this->tagList = $tagList;
    }

    /**
     * @return int
     */
    public function getSpeed()
    {
        return $this->speed;
    }

    /**
     * @param $speed
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }
}
