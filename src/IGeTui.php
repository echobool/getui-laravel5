<?php
namespace Echobool\Getui;

/**
 * Class IGeTui
 * @package getuisdk
 */
class IGeTui
{
    /**
     * @var string $appkey
     */
    public $appkey; //第三方 标识
    /**
     * @var string $masterSecret
     */
    public $masterSecret; //第三方 密钥
    /**
     * @var string $format
     */
    public $format = 'json'; //默认为 json 格式
    /**
     * @var string $host
     */
    public $host = '';
    /**
     * @var bool $needDetails
     */
    public $needDetails = false;
    /**
     * @var array $appkeyUrlList
     */
    public static $appkeyUrlList = array();
    /**
     * @var array $domainUrlList
     */
    public $domainUrlList = array();

    /**
     * @param $domainUrl
     * @param $appkey
     * @param $masterSecret
     * @throws \InvalidArgumentException
     * @throws \UnexpectedValueException
     */
    public function __construct($domainUrl, $appkey, $masterSecret)
    {
        $this->appkey = $appkey;
        $this->masterSecret = $masterSecret;
        $this->domainUrlList = array($domainUrl);
        if ((string)$domainUrl === '') {
            $this->domainUrlList = GTConfig::getDefaultDomainUrl();
        }
        $this->initOSDomain(null);
    }

    /**
     * @param $hosts
     * @return string
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    private function initOSDomain($hosts)
    {
        if ($hosts === null || count($hosts) === 0) {
            if (array_key_exists($this->appkey, IGeTui::$appkeyUrlList)) {
                $hosts = IGeTui::$appkeyUrlList[$this->appkey];
            } else {
                $hosts = $this->getOSPushDomainUrlList($this->domainUrlList, $this->appkey);
                IGeTui::$appkeyUrlList[$this->appkey] = $hosts;
            }
        } else {
            IGeTui::$appkeyUrlList[$this->appkey] = $hosts;
        }
        $this->host = ApiUrlRespectUtils::getFastest($this->appkey, $hosts);
        return $this->host;
    }

    /**
     * @param $domainUrlList
     * @param $appkey
     * @return null
     * @throws \UnexpectedValueException
     */
    public function getOSPushDomainUrlList($domainUrlList, $appkey)
    {
        $urlList = null;
        $postData = array();
        $postData['action'] = 'getOSPushDomailUrlListAction';
        $postData['appkey'] = $appkey;
        $ex = null;
        foreach ($domainUrlList as $durl) {
            try {
                $response = $this->httpPostJSON($durl, $postData);
                $urlList = $response['osList'];
                if ($urlList !== null && count($urlList) > 0) {
                    break;
                }
            } catch (\Exception $e) {
                $ex = $e;
            }
        }
        if ($urlList === null || count($urlList) <= 0) {
            throw new \UnexpectedValueException('Can not get hosts from ' . $domainUrlList . '|error:' . $ex);
        }
        return $urlList;
    }

    /**
     * @param $url
     * @param $data
     * @param bool|false $gzip
     * @return mixed|null
     * @throws RequestException
     * @throws \InvalidArgumentException
     * @throws \UnexpectedValueException
     */
    public function httpPostJSON($url, $data, $gzip = false)
    {
        if ((string)$url === '') {
            $url = $this->host;
        }
        $rep = HttpManager::httpPostJson($url, $data, $gzip);
        if ($rep !== null) {
            if ('sign_error' === (string)$rep['result']) {
                if ($this->connect()) {
                    $rep = HttpManager::httpPostJson($url, $data, $gzip);
                }
            } elseif ('domain_error' === (string)$rep['result']) {
                $this->initOSDomain($rep['osList']);
                $rep = HttpManager::httpPostJson($url, $data, $gzip);
            }
        }
        return $rep;
    }

    /**
     * @return bool
     * @throws RequestException
     */
    public function connect()
    {
        $timeStamp = $this->microTime();
        // 计算sign值
        $sign = md5($this->appkey . $timeStamp . $this->masterSecret);
        //
        $params = array();
        $requestId = uniqid('', true);
        $params['action'] = 'connect';
        $params['appkey'] = $this->appkey;
        $params['timeStamp'] = $timeStamp;
        $params['sign'] = $sign;
        $rep = HttpManager::httpPostJson($this->host, $params, false);
        if ('success' === (string)$rep['result']) {
            return true;
        } else {
            throw new RequestException($requestId, 'appKey Or masterSecret is Auth Failed', null);
        }
    }

    /**
     * @throws RequestException
     */
    public function close()
    {
        $params = array();
        $params['action'] = 'close';
        $params['appkey'] = $this->appkey;
        HttpManager::httpPostJson($this->host, $params, false);
    }

    /**
     *  指定用户推送消息
     * @param  IGtMessage $message
     * @param  IGtTarget $target
     * @param string $requestId
     * @return Array {result:successed_offline,taskId:xxx}  || {result:successed_online,taskId:xxx} || {result:error}
     * @throws RequestException
     * @throws \InvalidArgumentException
     * @throws \UnexpectedValueException
     ***/
    public function pushMessageToSingle($message, $target, $requestId = null)
    {
        if ($requestId === null || trim($requestId) === '') {
            $requestId = uniqid('', true);
        }
        $params = $this->getSingleMessagePostData($message, $target, $requestId);
        return $this->httpPostJSON($this->host, $params);
    }

    /**
     * @param $message
     * @param $target
     * @param null $requestId
     * @return array
     */
    public function getSingleMessagePostData(IGtMessage $message, IGtTarget $target, $requestId = null)
    {
        $params = array();
        $params['action'] = 'pushMessageToSingleAction';
        $params['appkey'] = $this->appkey;
        if ($requestId !== null) {
            $params['requestId'] = $requestId;
        }
        $params['clientData'] = base64_encode($message->getData()->getTransparent());
        $params['transmissionContent'] = $message->getData()->getTransmissionContent();
        $params['isOffline'] = $message->getIsOffline();
        $params['offlineExpireTime'] = $message->getOfflineExpireTime();
        // 增加pushNetWorkType参数(0:不限;1:wifi;2:4G/3G/2G)
        $params['pushNetWorkType'] = $message->getPushNetWorkType();

        //
        $params['appId'] = $target->getAppId();
        $params['clientId'] = $target->getClientId();
        $params['alias'] = $target->getAlias();
        // 默认都为消息
        $params['type'] = 2;
        $params['pushType'] = $message->getData()->getPushType();
        return $params;
    }

    /**
     * @param $message
     * @param null $taskGroupName
     * @return mixed
     * @throws RequestException
     * @throws \InvalidArgumentException
     * @throws \UnexpectedValueException
     */
    public function getContentId($message, $taskGroupName = null)
    {
        return $this->getListAppContentId($message, $taskGroupName);
    }

    /**
     *  取消消息
     * @param  String $contentId  contentId
     * @return boolean
     * @throws RequestException
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     ***/
    public function cancelContentId($contentId)
    {
        $params = array();
        $params['action'] = 'cancleContentIdAction';
        $params['appkey'] = $this->appkey;
        $params['contentId'] = $contentId;
        $rep = $this->httpPostJSON($this->host, $params);
        return (string)$rep['result'] === 'ok';
    }

    /**
     *  批量推送信息
     * @param  String $contentId
     * @param  Array <IGtTarget> targetList
     * @return Array {result:successed_offline,taskId:xxx}  || {result:successed_online,taskId:xxx} || {result:error}
     * @throws \Exception
     ***/
    public function pushMessageToList($contentId, $targetList)
    {
        $params = array();
        $params['action'] = 'pushMessageToListAction';
        $params['appkey'] = $this->appkey;
        $params['contentId'] = $contentId;
        $needDetails = GTConfig::isPushListNeedDetails();
        $params['needDetails'] = $needDetails;
        $async = GTConfig::isPushListAsync();
        $params['async'] = $async;
        if ($async && (!$needDetails)) {
            $limit = GTConfig::getAsyncListLimit();
        } else {
            $limit = GTConfig::getSyncListLimit();
        }
        if (count($targetList) > $limit) {
            throw new \InvalidArgumentException('target size:' . count($targetList) . ' beyond the limit:' . $limit);
        }
        $clientIdList = array();
        $aliasList = array();
        $appId = null;
        foreach ($targetList as $target) {
            $targetCid = $target->getClientId();
            $targetAlias = $target->getAlias();
            if ($targetCid !== null) {
                $clientIdList[] = $targetCid;
            } elseif ($targetAlias !== null) {
                $aliasList[] = $targetAlias;
            }
            if ($appId === null) {
                $appId = $target->getAppId();
            }

        }
        $params['appId'] = $appId;
        $params['clientIdList'] = $clientIdList;
        $params['aliasList'] = $aliasList;
        $params['type'] = 2;
        return $this->httpPostJSON($this->host, $params, true);
    }

    /**
     * @param $contentId
     * @return bool
     * @throws RequestException
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    public function stop($contentId)
    {
        $params = array();
        $params['action'] = 'stopTaskAction';
        $params['appkey'] = $this->appkey;
        $params['contentId'] = $contentId;
        $rep = $this->httpPostJSON($this->host, $params);
        return ('ok' === $rep['result']);
    }

    /**
     * @param $appId
     * @param $clientId
     * @return mixed|null
     * @throws RequestException
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    public function getClientIdStatus($appId, $clientId)
    {
        $params = array();
        $params['action'] = 'getClientIdStatusAction';
        $params['appkey'] = $this->appkey;
        $params['appId'] = $appId;
        $params['clientId'] = $clientId;
        return $this->httpPostJSON($this->host, $params);
    }

    /**
     * @param $appId
     * @param $clientId
     * @param $tags
     * @return mixed|null
     * @throws RequestException
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    public function setClientTag($appId, $clientId, $tags)
    {
        $params = array();
        $params['action'] = 'setTagAction';
        $params['appkey'] = $this->appkey;
        $params['appId'] = $appId;
        $params['clientId'] = $clientId;
        $params['tagList'] = $tags;
        return $this->httpPostJSON($this->host, $params);
    }

    /**
     * @param $message
     * @param null $taskGroupName
     * @return mixed|null
     * @throws \InvalidArgumentException
     * @throws RequestException
     * @throws \UnexpectedValueException
     */
    public function pushMessageToApp($message, $taskGroupName = null)
    {
        $contentId = $this->getListAppContentId($message, $taskGroupName);
        $params = array();
        $params['action'] = 'pushMessageToAppAction';
        $params['appkey'] = $this->appkey;
        $params['contentId'] = $contentId;
        $params['type'] = 2;
        return $this->httpPostJSON($this->host, $params);
    }

    /**
     * @param $message
     * @param null $taskGroupName
     * @return mixed
     * @throws RequestException
     * @throws \InvalidArgumentException
     * @throws \UnexpectedValueException
     */
    private function getListAppContentId($message, $taskGroupName = null)
    {
        $params = array();
        if (null !== $taskGroupName && trim($taskGroupName) !== '') {
            if (strlen($taskGroupName) > 40) {
                throw new \InvalidArgumentException('TaskGroupName is OverLimit 40');
            }
            $params['taskGroupName'] = $taskGroupName;
        }
        $params['action'] = 'getContentIdAction';
        $params['appkey'] = $this->appkey;
        $params['clientData'] = base64_encode($message->getData()->getTransparent());
        $params['transmissionContent'] = $message->getData()->getTransmissionContent();
        $params['isOffline'] = $message->getIsOffline();
        $params['offlineExpireTime'] = $message->getOfflineExpireTime();
        // 增加pushNetWorkType参数(0:不限;1:wifi;2:4G/3G/2G)
        $params['pushNetWorkType'] = $message->getPushNetWorkType();
        $params['pushType'] = $message->getData()->getPushType();
        $params['type'] = 2;
        //contentType 1是appMessage，2是listMessage
        if ($message instanceof IGtListMessage) {
            $params['contentType'] = 1;
        } else {
            $params['contentType'] = 2;
            $params['appIdList'] = $message->getAppIdList();
            $params['phoneTypeList'] = $message->getPhoneTypeList();
            $params['provinceList'] = $message->getProvinceList();
            $params['tagList'] = $message->getTagList();
            $params['speed'] = $message->getSpeed();

        }
        $rep = $this->httpPostJSON($this->host, $params);
        if ((string)$rep['result'] === 'ok') {
            return $rep['contentId'];
        } else {
            throw new RequestException(
                uniqid('', true),
                'host:[' . $this->host . '] 获取contentId失败:' . $rep,
                null
            );
        }
    }

    /**
     * @return IGtBatch
     */
    public function getBatch()
    {
        return new IGtBatch($this->appkey, $this);
    }

    /**
     * @param $appId
     * @param $deviceToken
     * @param $message
     * @return mixed|null
     * @throws RequestException
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    public function pushAPNMessageToSingle($appId, $deviceToken, $message)
    {
        $params = array();
        $params['action'] = 'apnPushToSingleAction';
        $params['appId'] = $appId;
        $params['appkey'] = $this->appkey;
        $params['DT'] = $deviceToken;
        $params['PI'] = base64_encode($message->getData()->getPushInfo()->serializeToString());
        return $this->httpPostJSON($this->host, $params);
    }

    /**
     * 根据deviceTokenList群推
     * @param $appId
     * @param $contentId
     * @param $deviceTokenList
     * @return mixed
     * @throws RequestException
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    public function pushAPNMessageToList($appId, $contentId, $deviceTokenList)
    {
        $params = array();
        $params['action'] = 'apnPushToListAction';
        $params['appkey'] = $this->appkey;
        $params['appId'] = $appId;
        $params['contentId'] = $contentId;
        $params['DTL'] = $deviceTokenList;
        $needDetails = GTConfig::isPushListNeedDetails();
        $params['needDetails'] = $needDetails;
        return $this->httpPostJSON($this->host, $params);
    }

    /**
     * 获取apn contentId
     * @param $appId
     * @param $message
     * @return string
     * @throws \Exception
     */
    public function getAPNContentId($appId, $message)
    {
        $params = array();
        $params['action'] = 'apnGetContentIdAction';
        $params['appkey'] = $this->appkey;
        $params['appId'] = $appId;
        $params['PI'] = base64_encode($message->getData()->getPushInfo()->serializeToString());
        $rep = $this->httpPostJSON($this->host, $params);
        if ($rep['result'] === 'ok') {
            return $rep['contentId'];
        } else {
            throw new \UnexpectedValueException('host:[' . $this->host . '] 获取contentId失败:' . $rep);
        }
    }

    /**
     * @param $appId
     * @param $alias
     * @param $clientId
     * @return mixed|null
     * @throws RequestException
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    public function bindAlias($appId, $alias, $clientId)
    {
        $params = array();
        $params['action'] = 'alias_bind';
        $params['appkey'] = $this->appkey;
        $params['appid'] = $appId;
        $params['alias'] = $alias;
        $params['cid'] = $clientId;
        return $this->httpPostJSON($this->host, $params);
    }

    /**
     * @param $appId
     * @param $targetList
     * @return mixed|null
     * @throws RequestException
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    public function bindAliasBatch($appId, $targetList)
    {
        $params = array();
        $aliasList = array();
        foreach ($targetList as $target) {
            $user = array();
            $user['cid'] = $target->getClientId();
            $user['alias'] = $target->getAlias();
            $aliasList[] = $user;
        }
        $params['action'] = 'alias_bind_list';
        $params['appkey'] = $this->appkey;
        $params['appid'] = $appId;
        $params['aliaslist'] = $aliasList;
        return $this->httpPostJSON($this->host, $params);
    }

    /**
     * @param $appId
     * @param $alias
     * @return mixed|null
     * @throws RequestException
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    public function queryClientId($appId, $alias)
    {
        $params = array();
        $params['action'] = 'alias_query';
        $params['appkey'] = $this->appkey;
        $params['appid'] = $appId;
        $params['alias'] = $alias;
        return $this->httpPostJSON($this->host, $params);
    }

    /**
     * @param $appId
     * @param $clientId
     * @return mixed|null
     * @throws RequestException
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    public function queryAlias($appId, $clientId)
    {
        $params = array();
        $params['action'] = 'alias_query';
        $params['appkey'] = $this->appkey;
        $params['appid'] = $appId;
        $params['cid'] = $clientId;
        return $this->httpPostJSON($this->host, $params);
    }

    /**
     * @param $appId
     * @param $alias
     * @param null $clientId
     * @return mixed|null
     * @throws RequestException
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    public function unBindAlias($appId, $alias, $clientId = null)
    {
        $params = array();
        $params['action'] = 'alias_unbind';
        $params['appkey'] = $this->appkey;
        $params['appid'] = $appId;
        $params['alias'] = $alias;
        if (null !== $clientId && trim($clientId) !== '') {
            $params['cid'] = $clientId;
        }
        return $this->httpPostJSON($this->host, $params);
    }

    /**
     * @param $appId
     * @param $alias
     * @return mixed|null
     * @throws RequestException
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    public function unBindAliasAll($appId, $alias)
    {
        return $this->unBindAlias($appId, $alias);
    }

    /**
     * @param $taskId
     * @return mixed|null
     * @throws RequestException
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    public function getPushResult($taskId)
    {
        $params = array();
        $params['action'] = 'getPushMsgResult';
        $params['appkey'] = $this->appkey;
        $params['taskId'] = $taskId;
        return $this->httpPostJSON($this->host, $params);
    }

    /**
     * @param $appId
     * @param $clientId
     * @return mixed|null
     * @throws RequestException
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    public function getUserTags($appId, $clientId)
    {
        $params = array();
        $params['action'] = 'getUserTags';
        $params['appkey'] = $this->appkey;
        $params['appId'] = $appId;
        $params['clientId'] = $clientId;
        return $this->httpPostJSON($this->host, $params);
    }

    /**
     * @param $appId
     * @param $date
     * @return mixed|null
     * @throws RequestException
     * @throws \UnexpectedValueException
     * @throws \InvalidArgumentException
     */
    public function queryAppPushDataByDate($appId, $date)
    {
        if (!LangUtils::validateDate($date)) {
            throw new \InvalidArgumentException('DateError|' . $date);
        }
        $params = array();
        $params['action'] = 'queryAppPushData';
        $params['appkey'] = $this->appkey;
        $params['appId'] = $appId;
        $params['date'] = $date;
        return $this->httpPostJSON($this->host, $params);
    }

    /**
     * @param $appId
     * @param $date
     * @return mixed|null
     * @throws \InvalidArgumentException
     * @throws RequestException
     * @throws \UnexpectedValueException
     */
    public function queryAppUserDataByDate($appId, $date)
    {
        if (!LangUtils::validateDate($date)) {
            throw new \InvalidArgumentException('DateError|' . $date);
        }
        $params = array();
        $params['action'] = 'queryAppUserData';
        $params['appkey'] = $this->appkey;
        $params['appId'] = $appId;
        $params['date'] = $date;
        return $this->httpPostJSON($this->host, $params);
    }

    /**
     * @return string
     */
    private function microTime()
    {
        list($usec, $sec) = explode(' ', microtime());
        $time = ($sec . substr($usec, 2, 3));
        return $time;
    }
}
