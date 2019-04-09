<?php
namespace Marmot\Application\Member\View;

use Marmot\Framework\View\JsonApiTrait;
use Marmot\Framework\Interfaces\IView;

use Marmot\Application\Member\Model\User;

/**
 * @codeCoverageIgnore
 */
class UserView implements IView
{
    use JsonApiTrait;

    private $rules;

    private $data;
    
    private $encodingParameters;

    public function __construct($data, $encodingParameters = null)
    {
        $this->data = $data;
        $this->encodingParameters = $encodingParameters;

        $this->rules = array(
            User::class => UserSchema::class
        );
    }

    public function display()
    {
        return $this->jsonApiFormat($this->data, $this->rules, $this->encodingParameters);
    }
}
