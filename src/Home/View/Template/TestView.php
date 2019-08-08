<?php
namespace Marmot\Application\Home\View\Template;

use Marmot\Framework\View\Template\TemplateView;
use Marmot\Framework\Interfaces\IView;

class TestView extends TemplateView implements IView
{
    public function display()
    {
        $this->getView()->display(
            'Test/Test.tpl',
            ['data'=>$this->getData()]
        );
    }
}
