<?php
namespace Marmot\Application\Member\Translator;

use Marmot\Framework\Interfaces\ITranslator;
use Marmot\Application\Member\Model\User;

class UserDataBaseTranslator implements ITranslator
{
    public function arrayToObject(array $expression, $user = null)
    {
        if (!$user instanceof User) {
            $user = new User();
        }

        $user->setId($expression['user_id']);
        $user->setCellphone($expression['cellphone']);
        $user->setPassword($expression['password']);
        $user->setSalt($expression['salt']);
        $user->setCreateTime($expression['create_time']);
        $user->setUpdateTime($expression['update_time']);
        $user->setNickName($expression['nick_name']);
        $user->setUserName($expression['user_name']);
        $user->setStatus($expression['status']);
        $user->setStatusTime($expression['status_time']);
        $user->setRealName($expression['real_name']);

        return $user;
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function objectToArray($user, array $keys = array())
    {
        if (!$user instanceof User) {
            return false;
        }

        if (empty($keys)) {
            $keys = array(
                'id',
                'cellphone',
                'updateTime',
                'createTime',
                'statusTime',
                'status',
                'nickName',
                'userName',
                'password',
                'salt',
                'realName',
                'otherInfo'
            );
        }

        $expression = array();

        if (in_array('id', $keys)) {
            $expression['user_id'] = $user->getId();
        }
        if (in_array('cellphone', $keys)) {
            $cellphone = $user->getCellphone();
            if (!empty($cellphone)) {
                $expression['cellphone'] = $cellphone;
            }
        }

        if (in_array('password', $keys)) {
            $expression['password'] = $user->getPassword();
        }

        if (in_array('salt', $keys)) {
            $expression['salt'] = $user->getSalt();
        }

        if (in_array('nickName', $keys)) {
            $expression['nick_name'] = $user->getNickName();
        }

        if (in_array('userName', $keys)) {
            $expression['user_name'] = $user->getUserName();
        }

        if (in_array('realName', $keys)) {
            $expression['real_name'] = $user->getRealName();
        }

        if (in_array('createTime', $keys)) {
            $expression['create_time'] = $user->getCreateTime();
        }

        if (in_array('updateTime', $keys)) {
            $expression['update_time'] = $user->getUpdateTime();
        }

        if (in_array('status', $keys)) {
            $expression['status'] = $user->getStatus();
        }

        if (in_array('statusTime', $keys)) {
            $expression['status_time'] = $user->getStatusTime();
        }

        if (in_array('statusTime', $keys)) {
            $expression['status_time'] = $user->getStatusTime();
        }

        if (in_array('otherInfo', $keys)) {
            $expression['other_info'] = array(
                'avatar' => array('name' => 'avatarName', 'identify' => 'avatarIdentify')
            );
        }

        return $expression;
    }
}
