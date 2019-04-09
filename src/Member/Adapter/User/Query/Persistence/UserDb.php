<?php
namespace Marmot\Application\Member\Adapter\User\Query\Persistence;

use Marmot\Framework\Classes\Db;

/**
 * user表数据库层文件
 * @author chloroplast
 * @version 1.0.0: 20160223
 */
class UserDb extends Db
{
    public function __construct()
    {
        parent::__construct('user');
    }
}
