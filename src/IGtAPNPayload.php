<?php
namespace Echobool\Getui;

/**
 * Class IGtAPNPayload
 * @package getuisdk
 */
class IGtAPNPayload
{
    /**
     * @var string $APN_SOUND_SILENCE
     */
    public $APN_SOUND_SILENCE = 'com.gexin.ios.silence';
    /**
     * @var int $PAYLOAD_MAX_BYTES
     */
    public static $PAYLOAD_MAX_BYTES = 2048;

    /**
     * @var array $customMsg
     */
    public $customMsg = array();
    /**
     * @var int $badge
     */
    public $badge = -1;
    /**
     * @var string $sound
     */
    public $sound = 'default';
    /**
     * @var int $contentAvailable
     */
    public $contentAvailable = 0;
    /**
     * @var string $category
     */
    public $category;
    /**
     * @var string $alertMsg
     */
    public $alertMsg;

    /**
     * @return string
     * @throws \UnexpectedValueException
     */
    public function getPayload()
    {
        try {
            $apsMap = array();

            if ($this->alertMsg !== null && method_exists($this->alertMsg, 'getAlertMsg')) {
                $msg = $this->alertMsg->getAlertMsg();
                if ($msg !== null) {
                    $apsMap['alert'] = $msg;
                }
            }

            if ($this->badge >= 0) {
                $apsMap['badge'] = $this->badge;
            }
            if ($this->sound === null || $this->sound === '') {
                $apsMap['sound'] = 'default';
            } elseif ($this->sound !== $this->APN_SOUND_SILENCE) {
                $apsMap['sound'] = $this->sound;
            }

            if (count($apsMap) === 0) {
                throw new \InvalidArgumentException('format error');
            }
            if ($this->contentAvailable > 0) {
                $apsMap['content-available'] = $this->contentAvailable;
            }
            if ($this->category !== null && $this->category !== '') {
                $apsMap['category'] = $this->category;
            }

            $map = array();
            if (count($this->customMsg) > 0) {
                foreach ($this->customMsg as $key => $value) {
                    $map[$key] = $value;
                }
            }
            $map['aps'] = $apsMap;
            return json_encode($map);
        } catch (\Exception $e) {
            throw new \UnexpectedValueException('create apn payload error', $e);
        }
    }

    /**
     * @param $key
     * @param $value
     */
    public function addCustomMsg($key, $value)
    {
        if ($key !== null && $key !== '' && $value !== null) {
            $this->customMsg[$key] = $value;
        }
    }
}
