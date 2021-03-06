<?php
/**
 * 注意：本内容仅限于California内部传阅,禁止外泄以及用于其他的商业目的
 * @author    peter<chendaguo@mail.com>
 * @copyright 2017  CalifoniaInc. All rights reserved.
 *
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License
 * Revision History Version
 ********1.0.0********************
 * file created @ 2017-11-20 11:29
 *********************************
 ********1.0.1********************
 *
 *********************************
 */

namespace by\component\paging\vo;


use by\infrastructure\base\BaseObject;
use by\infrastructure\helper\Object2DataArrayHelper;
use by\infrastructure\interfaces\ObjectToArrayInterface;

class PagingParams extends BaseObject implements ObjectToArrayInterface
{

    private $pageIndex;
    private $pageSize;

    // construct
    public function __construct($pageIndex = 0, $pageSize = 10)
    {
        parent::__construct();
        $this->setPageIndex($pageIndex);
        $this->setPageSize($pageSize);
    }

    /**
     * 偏移量 如果pageIndex是1 则返回0，2 则是 pageSize ,3则是 2*pageSize
     * @return float|int
     */
    public function offset()
    {
        $pageIndex = $this->getPageIndex() - 1;
        $pageIndex = $pageIndex < 0 ? 0 : $pageIndex;
        return $pageIndex * $this->getPageSize();
    }

    /**
     * @return mixed
     */
    public function getPageIndex()
    {
        return $this->pageIndex;
    }

    /**
     * 保证大于等于0
     * @param mixed $pageIndex
     */
    public function setPageIndex($pageIndex)
    {
        // 保证大于等于0
        $this->pageIndex = ($pageIndex < 0 ? 0 : $pageIndex);
    }

    /**
     * @return mixed
     */
    public function getPageSize()
    {
        return $this->pageSize;
    }

    /**
     * 值 大于 1
     * @param mixed $pageSize
     */
    public function setPageSize($pageSize)
    {
        // 保证大于等于1
        $this->pageSize = ($pageSize < 1 ? 1 : $pageSize);
    }

    /**
     * @return array
     * @throws \ReflectionException
     */
    public function toArray()
    {
        return Object2DataArrayHelper::getDataArrayFrom($this);
    }
}
