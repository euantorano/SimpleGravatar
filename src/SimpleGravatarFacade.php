<?php

namespace Euantor\SimpleGravatar;

use Illuminate\Support\Facades\Facade;

class GravatarFacade extends Facade
{
	protected static function getFacadeAccessor()
	{
		return 'simplegravatar';
	}
}

