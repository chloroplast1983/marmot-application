<?php
namespace Marmot\Application\Home\Controller;

use Marmot\Framework\Classes\Controller;
use Marmot\Core;

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
}
