<?php
namespace Echobool\Getui;

/**
 * Class Base128Varint
 * @package getuisdk
 */
class Base128Varint
{
    /**
     * @var int $modus
     */
    public $modus = 1;

    /**
     * @param int $modus - 1=Byte 2=String
     */
    public function __construct($modus)
    {
        $this->modus = $modus;
    }


    /**
     * @param $number - number as decimal
     * @return mixed Returns the base128 value of an dec value
     */
    public function setValue($number)
    {
        $string = decbin($number);
        if (strlen($string) < 8) {
            $hexstring = dechex(bindec($string));
            if (strlen($hexstring) % 2 === 1) {
                $hexstring = '0' . $hexstring;
            }
            if ($this->modus === 1) {
                return $this->hexToStr($hexstring);
            }
            return $hexstring;
        }

        // split it and insert the mb byte
        $string_array = array();
        $pre = '1';
        while (strlen($string) > 0) {
            if (strlen($string) < 8) {
                $string = substr('00000000', 0, 7 - strlen($string) % 7) . $string;
                $pre = '0';
            }
            $string_array[] = $pre . substr($string, strlen($string) - 7, 7);
            $string = substr($string, 0, strlen($string) - 7);
            $pre = '1';
            if ($string === '0000000') {
                break;
            }
        }

        $hexstring = '';
        foreach ($string_array as $string) {
            $hexstring .= sprintf('%02X', bindec($string));
        }

        // now format to hexstring in the right format
        if ($this->modus === 1) {
            return $this->hexToStr($hexstring);
        }

        return $hexstring;
    }


    /**
     * Returns the dec value of an base128
     * @param string $string bstring
     * @return mixed
     */
    public function getValue($string)
    {
        // now just drop the msb and reorder it + parse it in own string
        $valuestring = '';
        $string_length = strlen($string);

        $i = 1;

        while ($string_length > $i) {
            // unset msb string and reorder it
            $valuestring = substr($string, $i, 7) . $valuestring;
            $i += 8;
        }

        // now interprete it
        return bindec($valuestring);
    }

    /**
     * Converts hex 2 ascii
     * @param String $hex - the hex string
     * @return mixed
     */
    public function hexToStr($hex)
    {
        $str = '';
        $hl = strlen($hex);
        for ($i = 0; $i < $hl; $i += 2) {
            $str .= chr(intval(substr($hex, $i, 2), 16));
        }
        return $str;
    }

}
