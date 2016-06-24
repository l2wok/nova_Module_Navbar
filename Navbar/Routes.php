<?php

use Helpers\Hooks;

Hooks::addHook('afterBody', 'App\Modules\Navbar\Controllers\Navbar@getAfterBody');
