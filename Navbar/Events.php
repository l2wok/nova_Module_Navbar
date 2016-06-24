<?php

use Support\Facades\Event;

Event::listen('Navbar', 'App\Modules\Navbar\Controllers\Navbar@getStaticAfterBody');
