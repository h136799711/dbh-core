<?php

namespace ss\common\business;


/**
 * 速率统计，基于内存统计，所以必须是常驻内存才能统计的
 * 可以统计指定秒内的平均速率 比如 30秒内平均接收多少个消息
 * Class RateStaticsHelper
 * @package ss\common\business
 */
class RateStaticsHelper
{

    public static $seconds = 31;
    public static $passedSecondsRate = [];// $seconds - 1秒内接收到的消息数量
    public static $avgRate = 0; // $seconds - 1秒内的平均消息数量

    public static function record($now, $count = 1) {
        if (count(self::$passedSecondsRate) != self::$seconds) {
            for ($i = 0; $i < self::$seconds; $i++) {
                self::$passedSecondsRate[$i] = [$now - $i, 0];
            }
        }
        $tmp = [];
        for ($i = 0; $i < self::$seconds; $i++) {
            $tmp[$i] = [$now - $i, 0];
            for ($j = 0; $j < self::$seconds; $j++) {
                if ($tmp[$i][0] === self::$passedSecondsRate[$j][0]) {
                    $tmp[$i][1] = self::$passedSecondsRate[$j][1];
                    if ($i === 0) {
                        $tmp[$i][1] += $count;
                    }
                    break;
                }
            }
        }
        self::$avgRate = 0;
        for ($j = 0; $j < self::$seconds; $j++) {
            self::$passedSecondsRate[$j][0] = $tmp[$j][0];
            self::$passedSecondsRate[$j][1] = $tmp[$j][1];
            if ($j > 0) {
                self::$avgRate += $tmp[$j][1];
            }
        }
        self::$avgRate = number_format(self::$avgRate / (self::$seconds - 1), 4, ".", "");
    }
}
