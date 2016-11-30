<?php
namespace Echobool\Getui;

/**
 * Class IGtBatch
 * @package getuisdk
 */
class IGtBatch
{
    /**
     * @var string
     */
    public $batchId;
    /**
     * @var array
     */
    public $innerMsgList = array();
    /**
     * @var int
     */
    public $seqId = 0;
    /**
     * @var string
     */
    public $APPKEY;
    /**
     * @var string
     */
    public $push;
    /**
     * @var array
     */
    public $lastPostData;

    /**
     * @param $appkey
     * @param $push
     */
    public function __construct($appkey, $push)
    {
        $this->APPKEY = $appkey;
        $this->push = $push;
        $this->batchId = uniqid('', true);
    }

    /**
     * @return string
     */
    public function getBatchId()
    {
        return $this->batchId;
    }

    /**
     * @param $message
     * @param $target
     * @return string
     * @throws \InvalidArgumentException
     */
    public function add($message, $target)
    {
        if ($this->seqId >= 5000) {
            throw new \InvalidArgumentException('Can not add over 5000 message once! Please call submit() first.');
        } else {
            ++$this->seqId;
            $innerMsg = new SingleBatchItem();
            $innerMsg->setSeqId($this->seqId);
            $innerMsg->setData($this->createSingleJson($message, $target));
            $this->innerMsgList[] = $innerMsg;
        }
        return $this->seqId . '';
    }

    /**
     * @param $message
     * @param $target
     * @return string
     */
    public function createSingleJson($message, $target)
    {
        $params = $this->push->getSingleMessagePostData($message, $target);
        return json_encode($params);
    }

    /**
     * @return mixed
     * @throws RequestException
     */
    public function submit()
    {
        $requestId = uniqid('', true);
        $data = array();
        $data['appkey'] = $this->APPKEY;
        $data['serialize'] = 'pb';
        $data['async'] = GTConfig::isPushSingleBatchAsync();
        $data['action'] = 'pushMessageToSingleBatchAction';
        $data['requestId'] = $requestId;
        $singleBatchRequest = new SingleBatchRequest();
        $singleBatchRequest->setBatchId($this->batchId);
        foreach ($this->innerMsgList as $index => $innerMsg) {
            $singleBatchRequest->addBatchItem();
            $singleBatchRequest->setBatchItem($index, $innerMsg);
        }
        $data['singleDatas'] = base64_encode($singleBatchRequest->serializeToString());
        $this->seqId = 0;
        $this->innerMsgList = array();
        $this->lastPostData = $data;
        $result = $this->push->httpPostJSON(null, $data, true);
        return $result;
    }

    /**
     * @return mixed
     * @throws RequestException
     */
    public function retry()
    {
        $result = $this->push->httpPostJSON(null, $this->lastPostData, true);
        return $result;
    }

    /**
     * @param $apiUrl
     */
    public function setApiUrl($apiUrl)
    {
    }
}
