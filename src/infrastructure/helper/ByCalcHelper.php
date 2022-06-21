<?php

namespace by\infrastructure\helper;
/**
 * 计算辅助类
 */
class ByCalcHelper
{

    /**
     * 安全的除法 $a / $b 并返回百分比 就是乘100 ，保留2位小数点
     * @param $a
     * @param $b
     * @param int $decimals
     * @return string
     */
    public static function safeDivideFormatPercent($a, $b, $decimals = 2)
    {
        return self::numberFormat(100 * self::safeDivide($a, $b), $decimals);
    }

    /**
     *
     * @param $number
     * @param int $decimals
     * @param string $decimal_separator
     * @param string $thousands_separator
     * @return string
     */
    public static function numberFormat($number, $decimals = 2, $decimal_separator = '.', $thousands_separator = '')
    {
        return number_format($number, $decimals, $decimal_separator, $thousands_separator);
    }

    /**
     * 安全的除法
     * @param $a
     * @param $b
     * @return float|int
     */
    public static function safeDivide($a, $b)
    {
        if ($b == 0) return 0;
        return $a / $b;
    }

    /**
     * @param $a
     * @param $b
     * @param int $decimals
     * @param int $max
     * @return int|mixed|string
     */
    public static function safeDivideFormatPercentNoGreaterThan($a, $b, $decimals = 2, $max = 100)
    {
        $num = self::numberFormat(100 * self::safeDivide($a, $b), $decimals);
        if ($num > $max) return $max;
        return $num;
    }

    /**
     * 获取周日0点
     * @param $timestamp
     * @return false|int
     */
    public static function getSunday($timestamp) {
        $w = strftime('%u', $timestamp);//获取是周几的数字1-7
        return strtotime(date('Y-m-d 23:59:59', $timestamp + (7 - $w) * 24 * 60 * 60));
    }

    /**
     * 判断url文件是否存在
     * @param $url
     * @param array $headers
     * @return bool
     */
    public static function isRemoteFileExists($url, $headers = []) {
        if (empty($headers)) {
            $headers = @current(get_headers($url));
        }
        return(bool)preg_match('~HTTP/1\.\d\s+200\s+OK~', $headers);
    }

    /**
     * @param $page
     * @param $size
     * @return float|int
     */
    public static function offset($page, $size) {
        return self::getZeroIfNegative($page - 1) * $size;
    }

    /**
     * 如果负数则返回0
     * @param $num
     * @return int|mixed
     */
    public static function getZeroIfNegative($num)
    {
        if ($num < 0) return 0;
        return $num;
    }
}
