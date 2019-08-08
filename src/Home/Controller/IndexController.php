<?php
namespace Marmot\Application\Home\Controller;

use Marmot\Framework\Classes\Controller;
use Marmot\Core;

use Marmot\Application\Home\View\Template\TestView;

class IndexController extends Controller
{   
    /**
     * @codeCoverageIgnore
     */
    public function index()
    {
        var_dump("Hello World marmot");
        return true;
    }

    /**
     * @codeCoverageIgnore
     */
    public function error()
    {
        $this->displayError();
        return false;
    }

    public function test()
    {
        $this->render(new TestView(array('test'=>'test')));
        return true;
    }
}