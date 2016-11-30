<?php

namespace Echobool\Getui;

/**
 * Class ApiUrlRespectUtils
 * @package getuisdk
 */
class ApiUrlRespectUtils
{
    /**
     * @var array
     */
    public static $appkeyAndFasterHost = array();
    /**
     * @var array
     */
    public static $appKeyAndHost = array();
    /**
     * @var array
     */
    public static $appkeyAndLastExecuteTime = array();

    /**
     * @param $appkey
     * @param $hosts
     * @return string
     * @throws \InvalidArgumentException
     */
    public static function getFastest($appkey, $hosts)
    {

        if ($hosts === null || count($hosts) === 0) {
            throw new \InvalidArgumentException('Hosts can not be null or size must greater than 0');
        }
        if (array_key_exists($appkey, static::$appkeyAndFasterHost)
            && count(array_diff($hosts, static::$appKeyAndHost[$appkey])) === 0
        ) {
            return static::$appkeyAndFasterHost[$appkey];
        } else {
            $fastest = static::getFastestRealTime($hosts);
            static::$appKeyAndHost[$appkey] = $hosts;
            static::$appkeyAndFasterHost[$appkey] = $fastest;
            return $fastest;
        }
    }

    /**
     * @param $hosts
     * @return string
     */
    public static function getFastestRealTime($hosts)
    {
        $mint = 60.0;
        $s_url = '';
        $count_hosts = count($hosts);
        for ($i = 0; $i < $count_hosts; $i++) {
            $start = microtime(true);
            $opts = array('http' => array('method' => 'GET', 'timeout' => 3,));
            $context = stream_context_create($opts);
            $homepage = null;
            try {
                $homepage = file_get_contents($hosts[$i], false, $context);
            } catch (\Exception $e) {
                echo($e);
            }
            $ends = microtime(true);
            if ($homepage === null || $homepage === '') {
                $diff = 60.0;
            } else {
                $diff = $ends - $start;
            }
            if ($mint > $diff) {
                $mint = $diff;
                $s_url = $hosts[$i];
            }
        }
        return $s_url;
    }
}
