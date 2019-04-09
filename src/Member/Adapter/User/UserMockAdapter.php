<?php
namespace Marmot\Application\Member\Adapter\User;

use Marmot\Application\Member\Model\User;
use Marmot\Application\Member\Utils\ObjectGenerate;


class UserMockAdapter implements IUserAdapter
{
    public function __construct()
    {
    }

    public function __destruct()
    {
    }
    

    public function add(User $user) : bool
    {
        unset($user);

        return true;
    }

    public function update(User $user, array $keys = array()) : bool
    {
        unset($user);
        unset($keys);

        return true;
    }

    public function getOne($id) : User
    {
        return ObjectGenerate::generateUser($id);
    }

    public function getList(array $ids) : array
    {
        $userList = array();

        foreach ($ids as $id)
        {
            $userList[] = ObjectGenerate::generateUser($id);
        }

        return $userList;
    }


    public function filter(
        array $filter = array(),
        array $sort = array(),
        int $offset = 0,
        int $size = 20
    ) :array {

        unset($filter);
        unset($sort);

        $ids = [];

        for($offset; $offset<$size; $offset++)
        {
            $ids[] = $offset;
        }

        $count = sizeof($ids);
        return array($this->getList($ids), $count);
    }
}
