<?php
namespace Echobool\Getui;

/**
 * Class GTConfig
 * @package getuisdk
 */
class GTConfig
{
    /**
     * @return bool
     */
    public static function isPushSingleBatchAsync()
    {
        return 'true' === (string) GTConfig::getProperty('gexin_pushSingleBatch_needAsync', null, 'false');
    }

    /**
     * @return bool
     */
    public static function isPushListAsync()
    {
        return 'true' === (string) GTConfig::getProperty('gexin_pushList_needAsync', null, 'false');
    }

    /**
     * @return bool
     */
    public static function isPushListNeedDetails()
    {
        return 'true' === (string) GTConfig::getProperty('gexin_pushList_needDetails', 'needDetails', 'false');
    }

    /**
     * @return null|string
     */
    public static function getHttpProxyIp()
    {
        return GTConfig::getProperty('gexin_http_proxy_ip', 'gexin.rp.sdk.http.proxyHost');
    }

    /**
     * @return int
     */
    public static function getHttpProxyPort()
    {
        return (int)GTConfig::getProperty('gexin_http_proxy_port', 'gexin.rp.sdk.http.proxyPort', 80);
    }

    /**
     * @return int
     */
    public static function getSyncListLimit()
    {
        return (int)GTConfig::getProperty('gexin_pushList_syncLimit', null, 1000);
    }

    /**
     * @return int
     */
    public static function getAsyncListLimit()
    {
        return (int)GTConfig::getProperty('gexin_pushList_asyncLimit', null, 10000);
    }

    /**
     * @return int
     */
    public static function getHttpConnectionTimeOut()
    {
        return (int) GTConfig::getProperty(
            'gexin_http_connecton_timeout',
            'gexin.rp.sdk.http.connection.timeout',
            60000
        );
    }

    /**
     * @return int
     */
    public static function getHttpInspectInterval()
    {
        return (int)GTConfig::getProperty('gexin_inspect_interval', 'gexin.rp.sdk.http.inspect.timeout', 300000);
    }

    /**
     * @return int
     */
    public static function getHttpSoTimeOut()
    {
        return (int)GTConfig::getProperty('gexin_http_so_timeout', 'gexin.rp.sdk.http.so.timeout', 30000);
    }

    /**
     * @return int
     */
    public static function getHttpTryCount()
    {
        return (int)GTConfig::getProperty('gexin_http_tryCount', 'gexin.rp.sdk.http.gexinTryCount', 3);
    }

    /**
     * @return array
     */
    public static function getDefaultDomainUrl()
    {
        $urlStr = GTConfig::getProperty('gexin_default_domainurl', null);
        if ($urlStr === null || '' === trim($urlStr)) {
            $hosts = array(
                'http://sdk.open.api.igexin.com/serviceex',
                'http://sdk.open.api.gepush.com/serviceex',
                'http://sdk.open.api.getui.net/serviceex'
            );
            for ($i = 0; $i < 3; $i++) {
                $hosts[] = 'http://sdk' . $i . '.open.api.igexin.com/serviceex';
            }
            return $hosts;
        }
        return explode(',', $urlStr);
    }

    /**
     * @param $key
     * @param $oldKey
     * @param null $defaultValue
     * @return null|string
     */
    private static function getProperty($key, $oldKey, $defaultValue = null)
    {
        $value = getenv($key);
        if ($value !== null) {
            return $value;
        } else {
            if ($oldKey !== null) {
                $value = getenv($oldKey);
            }
            if ($value === null) {
                return $defaultValue;
            } else {
                return $value;
            }
        }
    }

    /**
     * @return string
     */
    public static function getSDKVersion()
    {
        return '4.0.0.1';
    }
}