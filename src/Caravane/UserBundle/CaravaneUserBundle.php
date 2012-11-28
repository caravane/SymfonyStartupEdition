<?php

namespace Caravane\UserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class CaravaneUserBundle extends Bundle
{
	    public function getParent()
    {
        return 'FOSUserBundle';
    }
}
