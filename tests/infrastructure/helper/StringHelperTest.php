<?php
/**
 * 注意：本内容仅限于博也公司内部传阅,禁止外泄以及用于其他的商业目的
 * @author    hebidu<346551990@qq.com>
 * @copyright 2017 www.itboye.com Boye Inc. All rights reserved.
 * @link      http://www.itboye.com/
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-10-25 13:56
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace byTest\infrastructure\helper;

use by\component\string_extend\helper\StringHelper;
use by\infrastructure\helper\OSHelper;
use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class StringHelperTest extends TestCase
{

    // member function

    public function test62() {
        var_dump(OSHelper::systemBit().'位系统');
        $n = 12.01;
        $str = StringHelper::intTo62($n);
        var_dump($str);
        $n = floor(PHP_INT_MAX / 100);
        $str = StringHelper::intTo62($n);
        var_dump($str);
        $n1 = StringHelper::char62ToInt($str);
        var_dump($n1);
        var_dump($n - $n1);
        Assert::assertEquals($n, $n1);

//        $n = 666666886;
        $n = floor(PHP_INT_MAX / 10000);
        $str = StringHelper::intTo36Hex($n);
        var_dump($str);
        $n1 = StringHelper::char36ToInt($str);
        var_dump($n1);
        Assert::assertEquals($n, $n1);
    }

    /**
     * @covers \by\infrastructure\helper\StringHelper::randNumbers
     * @uses   \by\infrastructure\helper\StringHelper
     * @author hebidu
     * @group helper
     */
//    public function testRandNumbers()
//    {
//        $length = 6;
//        for ($i = 1; $i <= $length; $i++) {
//            $str = StringHelper::randNumbers($i);
//            $this->assertEquals(strlen($str), $i, '字符串长度预期为' . $i);
//        }
//        $str = StringHelper::randNumbers(0);
//        $this->assertEquals(strlen($str), 1, '字符串长度预期为1');
//        $str = StringHelper::randNumbers(-1);
//        $this->assertEquals(strlen($str), 1, '字符串长度预期为1');
//        $str = StringHelper::randNumbers(10);
//        $this->assertEquals(strlen($str), 8, '字符串长度预期为8');
//    }

    /**
     * @uses  \by\infrastructure\helper\StringHelper
     * @author hebidu
     * @group helper
     */
//    public function testRandAlphabetAndNumbers()
//    {
//        $length = 64;
//        for ($i = 1; $i <= $length; $i++) {
//            $str = StringHelper::randAlphabetAndNumbers($i);
//            echo "\n" . $str;
//            $this->assertEquals(strlen($str), $i, '字符串长度预期为' . $i);
//        }
//        $str = StringHelper::randAlphabetAndNumbers(-1);
//        $this->assertEquals(strlen($str), 1, '字符串长度预期为1');
//        $str = StringHelper::randAlphabetAndNumbers(65);
//        $this->assertEquals(strlen($str), 64, '字符串长度预期为64');
//    }

    // override function __toString()

    // member variables

    // getter setter

}