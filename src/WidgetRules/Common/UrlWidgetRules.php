<?php
namespace Marmot\Application\WidgetRules\Common;

use Respect\Validation\Validator as V;

use Marmot\Core;

class UrlWidgetRules
{
    /**
     * @SuppressWarnings(PHPMD.ShortMethodName)
     **/
    public function id($id) : bool
    {
        if (!V::numeric()->positive()->validate($id)) {
            Core::setLastError(ROUTE_NOT_EXIST);
            return false;
        }

        return true;
    }
}
