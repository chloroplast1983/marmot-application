<?php
namespace Marmot\Application\Member\Controller;

use Marmot\Framework\Classes\Controller;
use Marmot\Framework\Classes\CommandBus;

use Marmot\Framework\Interfaces\ICommand;
use Marmot\Framework\Interfaces\INull;
use Marmot\Framework\Interfaces\IView;

use Marmot\Framework\Controller\JsonApiTrait;

use Marmot\Core;

use Marmot\Application\WidgetRules\Common\UrlWidgetRules;
use Marmot\Application\Member\Model\User;
use Marmot\Application\Member\View\UserView;
use Marmot\Application\Member\Command\User\SignUpUserCommand;
use Marmot\Application\Member\Command\User\UpdatePasswordUserCommand;
use Marmot\Application\Member\CommandHandler\User\UserCommandHandlerFactory;
use Marmot\Application\Member\Repository\User\UserRepository;

class UserController extends Controller
{
    use JsonApiTrait;

    private $userRepository;

    private $commandBus;

    public function __construct()
    {
        parent::__construct();

        $this->urlWidgetRules = new UrlWidgetRules();
        $this->userRepository = new UserRepository();
        $this->commandBus = new CommandBus(new UserCommandHandlerFactory());
    }

    protected function getUserRepository() : UserRepository
    {
        return $this->userRepository;
    }

    protected function getCommandBus() : CommandBus
    {
        return $this->commandBus;
    }

    protected function getUrlWidgetRules() : UrlWidgetRules
    {
        return $this->urlWidgetRules;
    }

    public function fetchOne(int $id)
    {
        if ($this->validateGetOneScenario($id)) {
            $repository = $this->getUserRepository();

            $user = $repository->getOne($id);
            if (!$user instanceof INull) {
                $this->renderView(new UserView($user));
                return true;
            }
        }

        $this->displayError();
        return false;
    }

    protected function validateGetOneScenario(int $id)
    {
        return $this->getUrlWidgetRules()->id($id);
    }

    public function fetchList(string $ids)
    {
        $repository = $this->getUserRepository();

        //批量获取
        $userList = $repository->getList(explode(',', $ids));
        if (!empty($userList)) {
            $this->renderView(new UserView($userList));
            return true;
        }

        $this->displayError();
        return false;
    }

    public function filter()
    {
        $repository = $this->getUserRepository();

        list($filter, $sort, $curpage, $perpage) = $this->formatParameters();

        //过滤参数
        list($userList, $count) = $repository->filter(
            $filter,
            $sort,
            ($curpage-1)*$perpage,
            $perpage
        );

        if ($count > 0) {
            //获取多条数据 repository->filter 返回 list 和 count
            $view = new UserView($userList);
            $view->pagination(
                'users',
                $this->getRequest()->get(),
                $count,
                $perpage,
                $curpage
            );
            $this->renderView($view);
            return true;
        }

        $this->displayError();
        return false;
    }

    /**
     * 对应路由 /users
     * 用户注册功能,通过post传参
     * @param jsonApi array("data"=>array("type"=>"users",
     *                                    "attributes"=>array("cellphone"=>"手机号",
     *                                                        "password"=>"密码"
     *                                                        )
     *                                    )
     *                      )
     * @return jsonApi
     */
    public function signUp()
    {
        $data = $this->getRequest()->post('data');
        //验证type
        $cellphone = $data['attributes']['cellphone'];
        $password = $data['attributes']['password'];

        if ($this->validateSignUpScenario($cellphone, $password)) {
            $commandBus = $this->getCommandBus();

                $command = new SignUpUserCommand(
                    $cellphone,
                    $password
                );

            if ($commandBus->send($command)) {
                //查询新注册的用户
                $repository = $this->getUserRepository();
                $user = $repository->getOne($command->uid);
                if ($user instanceof User) {
                    $this->getResponse()->setStatusCode(201);
                    $this->renderView(new UserView($user));
                    return true;
                }
            }
        }

        $this->displayError();
        return false;
    }

    protected function validateSignUpScenario($cellphone, $password)
    {
        unset($cellphone);
        unset($password);
        return true;
    }

     /**
     * 对应路由 /users/{id:\d+}/updatePassword
     * 更新用户密码,通过PUT传参,json
     * @param string id 用户id
     * @param jsonApi array("data"=>array("type"=>"users",
     *                                    "attributes"=>array("oldPassword"=>"旧密码",
     *                                                        "password"=>"新密码"
     *                                                       )
     *                                   )
     *                         )
     * @return jsonApi
     */
    public function updatePassword($id)
    {
        $data = $this->getRequest()->put("data");

        $type = $data['type'];
        $oldPassword = $data['attributes']['oldPassword'];
        $password = $data['attributes']['password'];
       
        if (!empty($oldPassword) && !empty($password)) {
            $commandBus = $this->getCommandBus();
            if ($commandBus->send(
                new UpdatePasswordUserCommand(
                    $oldPassword,
                    $password,
                    $id
                )
            )
            ) {
                $repository = $this->getUserRepository();
                $user  = $repository->getOne($id);

                if (!$user instanceof INull) {
                    $this->renderView(new UserView($user));
                    return true;
                }
            }
        }

        $this->displayError();
        return false;
    }
}
