<?php
namespace Marmot\Application\Member\Adapter\User\Query\Persistence;

use Marmot\Framework\Classes\Cache;

/**
 * user表缓存文件
 * @author chloroplast
 * @version 1.0.0: 20160223
 */
class UserCache extends Cache
{
    /**
     * 构造函数初始化key和表名一致
     */
    public function __construct()
    {
        parent::__construct('user');
    }
}
