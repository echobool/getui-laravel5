<?php
namespace Echobool\Getui;

/**
 * Class HttpManager
 * @package getuisdk
 */
class HttpManager
{
    /**
     * @param $url
     * @param $data
     * @param $gzip
     * @param $action
     * @return mixed
     */
    private static function httpPost($url, $data, $gzip, $action)
    {
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($curl, CURLOPT_USERAGENT, 'GeTui PHP/1.0');
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT_MS, GTConfig::getHttpConnectionTimeOut());
        curl_setopt($curl, CURLOPT_TIMEOUT_MS, GTConfig::getHttpSoTimeOut());
        $header = array('Content-Type:text/html;charset=UTF-8');
        if ($gzip) {
            $data = gzencode($data, 9);
            $header[] = 'Accept-Encoding:gzip';
            $header[] = 'Content-Encoding:gzip';
            curl_setopt($curl, CURLOPT_ENCODING, 'gzip');
        }
        if (null !== $action) {
            $header[] = 'Gt-Action:' . $action;
        }
        curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $data);

        $curl_version = curl_version();
        if ($curl_version['version_number'] >= 462850) {
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT_MS, 30000);
            curl_setopt($curl, CURLOPT_NOSIGNAL, 1);
        }
        //通过代理访问接口需要在此处配置代理
        //curl_setopt($curl, CURLOPT_PROXY, '192.168.1.18:808');
        //请求失败有3次重试机会
        $result = HttpManager::exeBySetTimes(3, $curl);
        curl_close($curl);
        return $result;
    }

    /**
     * @param $url
     * @param array $params
     * @param $gzip
     * @return mixed|null
     * @throws RequestException
     */
    public static function httpPostJson($url, $params = [], $gzip = false)
    {
        if (!array_key_exists('version', $params)) {
            $params['version'] = GTConfig::getSDKVersion();
        }
        $action = $params['action'];
        $data = json_encode($params);
        $result = null;
        try {
            $resp = HttpManager::httpPost($url, $data, $gzip, $action);
            //LogUtils::debug('发送请求 post:{'.$data.'} return:{'.$resp.'}');
            $result = json_decode($resp, true);
            return $result;
        } catch (\Exception $e) {
            throw new RequestException(
                $params['requestId'],
                'httpPost:[' . $url . '] [' . $data . ' ] [ ' . $result . ']:',
                $e
            );
        }
    }

    /**
     * @param $count
     * @param $curl
     * @return mixed
     */
    private static function exeBySetTimes($count, $curl)
    {
        $result = curl_exec($curl);
        if (curl_errno($curl)) {
            LogUtils::debug('请求错误: ' . curl_errno($curl));

            if ($count > 0) {
                sleep(3); //Sleep 3 seconds to save cpu power
                $count--;
                $result = HttpManager::exeBySetTimes($count, $curl);
            }
        }
        return $result;
    }
}
