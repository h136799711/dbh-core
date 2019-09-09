<?php
/**
 * 注意：本内容仅限于California内部传阅,禁止外泄以及用于其他的商业目的
 * @author    peter<chendaguo@mail.com>
 * @copyright 2017  CalifoniaInc. All rights reserved.
 *
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-11-27 14:26
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\string_extend\helper;

/**
 * Class StringHelper
 * 字符串帮助类
 * @package by\component\string_extend\helper
 */
class StringHelper
{
    /**
     * 仅字母大小写
     */
    const ALPHABET = 1;

    /**
     * 字母 + 数字
     */
    const ALPHABET_AND_NUMBERS = 2;

    /**
     * 仅数字
     */
    const NUMBERS = 3;

    private static $alphaCodeSet = 'abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY';

    private static $codeSet = '2345678abcdefhijkmnpqrstuvwxyzABCDEFGHJKLMNPQRTUVWXY';

    /**
     * 62位字符数组 , 数字 + 英文字母（大小写）
     * @var array
     */
    public static $char62 = [
        "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
        'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
        'U', 'V', 'W', 'X', 'Y', 'Z',
        'a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j',
        'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't',
        'u', 'v', 'w', 'x', 'y', 'z'];

    public static $char36 = [
        "0", "1", "2", "3", "4", "5", "6", "7", "8", "9",
        'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J',
        'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T',
        'U', 'V', 'W', 'X', 'Y', 'Z'
    ];

    public static $pow62 = [
        1,
        62,
        3844,
        238328,
        14776336,
        916132832,
        56800235584,
        3521614606208,
        218340105584896,
        13537086546263552,
        839299365868340224
    ];
    public static $pow36 = [
        1,
        36,
        1296,
        46656,
        1679616,
        60466176,
        2176782336,
        78364164096,
        2821109907456,
        101559956668416,
        3656158440062976,
    ];

    /**
     * 62进制 转 int
     * 不支持太大的数要注意
     * @param $c62
     * @return float|int
     */
    public static function char62ToInt($c62)
    {
        $len = strlen($c62);
        if ($len > 10) return -1;
        $num = 0;
        $cnt = 0;
        while ($cnt < $len) {
            $index = 0;
            $char = substr($c62, $cnt, 1);
            for ($i = 0; $i < 62; $i++) {
                if (self::$char62[$i] == $char) {
                    $index = $i + 1;
                    break;
                }
            }

            $num = $num + $index * self::$pow62[$len - $cnt - 1];
            $cnt++;
        }
        return $num;
    }

    /**
     *
     * 转换后的字符串长度不会大于10，超过10则返回-1
     * int 转 62进制 （通过数字 + 大小写字母表示）
     * 32位系统通常是 2147483648
     * 64位系统通常是
     * interge最大值参考如下链接
     * http://www.php.net/manual/zh/language.types.integer.php
     * @param integer $n n必须大于0 小于 PHP_INT_MAX 取决于系统是32位还是64位
     * @return int|string
     */
    public static function intTo62($n)
    {
        if (strval($n) > strval(PHP_INT_MAX)) {
            return -1;
        }
        $n = intval($n);
        if ($n < 0) {
            return -1;
        }
        if ($n === 0) {
            return 0;
        }
        $char = '';
        do {
            $key = ($n - 1) % 62;
            $char = self::$char62[$key] . $char;
            $n = floor(($n - $key) / 62);
            if (strlen($char) > 10) return -1;
        } while ($n > 0);

        return $char;
    }


    /**
     * 数字转36进制字符串，默认大写字符串
     * 1. 只支持大于0的转换，小于0 则会返回0
     * 转换后的字符串长度不会大于10，超过10则返回-1
     * @param int $num 待转换数字 大于0
     * @return int|string
     */
    public static function intTo36Hex($num)
    {
        $num = intval($num);
        if ($num <= 0)
            return 0;
        $char = '';
        do {
            $key = ($num - 1) % 36;
            $char = self::$char36[$key] . $char;
            $num = floor(($num - $key) / 36);
            if (strlen($char) > 10) return -1;
        } while ($num > 0);
        return $char;
    }

    /**
     *
     * 不支持太大的数要注意
     * @param $c36
     * @return float|int
     */
    public static function char36ToInt($c36)
    {
        $len = strlen($c36);
        if ($len > 10) return -1;
        $num = 0;
        $cnt = 0;
        while ($cnt < $len) {
            $index = 0;
            for ($i = 0; $i < 36; $i++) {
                if (self::$char36[$i] == substr($c36, $cnt, 1)) {
                    $index = $i;
                    break;
                }
            }
            $num = $num + ($index + 1) * self::$pow36[$len - $cnt - 1];
            $cnt++;
        }
        return $num;
    }

    /**
     * utf8编码转GBK编码
     * @param $str
     * @return string
     */
    public static function utf8ToGbk($str)
    {
        return iconv('utf-8', 'gbk', $str);
    }

    /**
     * 返回uniqid的md5值
     * @return string
     */
    public static function md5UniqueId()
    {
        return md5(uniqid());
    }

    /**
     * 生成随机字符
     * @param string $type 该帮助类 ALPHABET|ALPHABET_AND_NUMBERS|NUMBERS
     * @param int $length
     * @return int|string
     */
    public static function randStr($type, $length = 6)
    {
        // TODO 生成随机长度的字符串
        if ($type == self::ALPHABET) {
            return self::randAlphabet($length);
        } elseif ($type == self::ALPHABET_AND_NUMBERS) {
            return self::randAlphabetAndNumbers($length);
        } elseif ($type == self::NUMBERS) {
            return self::randNumbers($length);
        }

        return "unknown type";
    }

    /**
     * 随机字母
     * @param $length
     * @return string
     */
    public static function randAlphabet($length)
    {
        if ($length < 0) $length = 1;
        if ($length > 64) $length = 64;
        $code = [];
        for ($i = 0; $i < $length; $i++) {
            $code[$i] = self::$alphaCodeSet[mt_rand(0, strlen(self::$alphaCodeSet) - 1)];
        }
        return implode("", $code);
    }

    // construct

    /**
     * 随机字母+数字
     * @param $length
     * @return string
     */
    public static function randAlphabetAndNumbers($length)
    {
        if ($length < 0) $length = 1;
        if ($length > 64) $length = 64;
        $code = [];
        for ($i = 0; $i < $length; $i++) {
            $code[$i] = self::$codeSet[mt_rand(0, strlen(self::$codeSet) - 1)];
        }
        return implode("", $code);
    }

    /**
     * 支持随机生成只包含数字的随机字符串长度为1-8
     * @param int $length
     * @return int
     */
    public static function randNumbers($length = 6)
    {
        if ($length < 0) $length = 1;
        if ($length > 8) $length = 8;
        $start = pow(10, $length - 1);
        return mt_rand($start, ($start * 10) - 1);
    }

    /**
     * 转换成骆驼式字符串
     * 注意：
     *  1. 只能处理 (下划线 + 小写字母)这种字符串
     * @param $str
     * @return string
     */
    public static function toCamelCase($str)
    {
        $str = ucwords(str_replace('_', ' ', $str));
        $str = str_replace(' ', '', lcfirst($str));
        return $str;
    }

    /**
     * 骆驼式字符串转下划线
     * 默认 每个大写字母都变成下划线 + 小写字母
     * @param $camelCaseStr
     * @param string $separator
     * @return mixed|string
     * @internal param $str
     */
    public static function camelCaseToUnderline($camelCaseStr, $separator = '_')
    {
        $temp_array = array();
        for ($i = 0; $i < strlen($camelCaseStr); $i++) {
            $ascii_code = ord($camelCaseStr[$i]);
            if ($ascii_code >= 65 && $ascii_code <= 90) {
                $temp_array[] = $separator . chr($ascii_code + 32);
            } else {
                $temp_array[] = $camelCaseStr[$i];
            }
        }
        return implode('', $temp_array);
    }

    /**
     * 针对空字符串返回一个空数组
     * @param $delimiter
     * @param $string
     * @param null $limit
     * @return array
     */
    public static function explode($delimiter, $string, $limit = null)
    {
        if (empty($string)) return [];
        return explode($delimiter, $string, $limit);
    }

    /**
     * 隐藏关键字符 用 $replaceChar 替换
     * hideSensitive('13485123499', 3, 4, 4, *)
     * 处理后 = 134****3499
     * @param string $str 原始字符串
     * @param int $firstLen 保留原始字符前3位
     * @param int $lastLen 保留原始字符末4位
     * @param int $replaceCount 替换字符的数量
     * @param string $replaceChar 默认*
     * @return string
     */
    public static function hideSensitive($str, $firstLen = 3, $lastLen = 4, $replaceCount = 4, $replaceChar = '*')
    {
        if (strlen($str) > $firstLen + $lastLen) {
            return substr($str, 0, $firstLen) . str_repeat($replaceChar, $replaceCount) . substr($str, -$lastLen);
        }
        return $str;
    }

    /**
     * number_format的替换
     *
     * @param float $number 数值
     * @param int $decimal 小数点保留位数
     * @param string $dec_point 小数点符号 默认 . 符号
     * @param string $thousands_sep 每隔3位数符号，原生是 , 符号，这边默认 无
     * @return string 保留小数点后的数字
     */
    public static function numberFormat($number, $decimal = 2, $dec_point = ".", $thousands_sep = "")
    {
        return number_format($number, $decimal, $dec_point, $thousands_sep);
    }

    /**
     * 过滤标点符号
     * @param $str
     * @param string $replace
     * @param array $extraChar
     * @return mixed
     */
    public static function filterPunctuation($str, $replace = '', $extraChar = [])
    {
        $default = array('）','（','￥','¥', ' ', '｛', '-', '—', '【', '】', '《', '》', '｝', '', '!', '"', '#', '$', '%', '&', '\'', '(', ')', '*',
            '+', ', ', '-', '.', '/', ':', ';', '<', '=', '>',
            '?', '@', '[', '\\', ']', '^', '_', '`', '{', '|',
            '}', '~', '；', '﹔', '︰', '﹕', '：', '，', '﹐', '、',
            '．', '﹒', '˙', '·', '。', '？', '！', '～', '‥', '‧',
            '′', '〃', '〝', '〞', '‵', '‘', '’', '『', '』', '「',
            '」', '“', '”', '…', '❞', '❝', '﹁', '﹂', '﹃', '﹄');

        return str_replace(
            array_merge($default, $extraChar),
            $replace,
            $str);
    }
}
