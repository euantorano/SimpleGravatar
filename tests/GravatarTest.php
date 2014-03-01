<?php

class GravatarTest extends PHPUnit_Framework_TestCase
{
	public function testBasicEmail()
	{
		$email     = 'test@email.com';
		$emailHash = md5($email);

		$simpleGravatar = new Euantor\SimpleGravatar\Gravatar();
		$simpleGravatar->setEmail($email);

		$expected = "http://www.gravatar.com/avatar/{$emailHash}.png?s=64&amp;d=mm&amp;rating=g";

		$this->assertEquals($expected, $simpleGravatar->getGravatar());
	}

	public function testBasicEmailSecure()
	{
		$email     = 'test@email.com';
		$emailHash = md5($email);

		$simpleGravatar = new Euantor\SimpleGravatar\Gravatar();
		$simpleGravatar->setEmail($email);
		$simpleGravatar->setSecure(true);

		$expected = "https://secure.gravatar.com/avatar/{$emailHash}.png?s=64&amp;d=mm&amp;rating=g";

		$this->assertEquals($expected, $simpleGravatar->getGravatar());
	}

	public function testSetExtension()
	{
		$email     = 'test@email.com';
		$emailHash = md5($email);
		$extension = 'jpg';

		$simpleGravatar = new Euantor\SimpleGravatar\Gravatar();
		$simpleGravatar->setEmail($email);
		$simpleGravatar->setExtension($extension);

		$expected = "http://www.gravatar.com/avatar/{$emailHash}.{$extension}?s=64&amp;d=mm&amp;rating=g";

		$this->assertEquals($expected, $simpleGravatar->getGravatar());
	}

	public function testSetExtensionSecure()
	{
		$email     = 'test@email.com';
		$emailHash = md5($email);
		$extension = 'jpg';

		$simpleGravatar = new Euantor\SimpleGravatar\Gravatar();
		$simpleGravatar->setEmail($email);
		$simpleGravatar->setExtension($extension);
		$simpleGravatar->setSecure(true);

		$expected = "https://secure.gravatar.com/avatar/{$emailHash}.{$extension}?s=64&amp;d=mm&amp;rating=g";

		$this->assertEquals($expected, $simpleGravatar->getGravatar());
	}

	public function testSetSize()
	{
		$email     = 'test@email.com';
		$emailHash = md5($email);
		$size      = 100;

		$simpleGravatar = new Euantor\SimpleGravatar\Gravatar();
		$simpleGravatar->setEmail($email);
		$simpleGravatar->setSize($size);

		$expected = "http://www.gravatar.com/avatar/{$emailHash}.png?s={$size}&amp;d=mm&amp;rating=g";

		$this->assertEquals($expected, $simpleGravatar->getGravatar());
	}

	public function testSetSizeSecure()
	{
		$email     = 'test@email.com';
		$emailHash = md5($email);
		$size      = 100;

		$simpleGravatar = new Euantor\SimpleGravatar\Gravatar();
		$simpleGravatar->setEmail($email);
		$simpleGravatar->setSize($size);
		$simpleGravatar->setSecure(true);

		$expected = "https://secure.gravatar.com/avatar/{$emailHash}.png?s={$size}&amp;d=mm&amp;rating=g";

		$this->assertEquals($expected, $simpleGravatar->getGravatar());
	}

	public function testSetDefault()
	{
		$email     = 'test@email.com';
		$emailHash = md5($email);
		$default   = 'retro';

		$simpleGravatar = new Euantor\SimpleGravatar\Gravatar();
		$simpleGravatar->setEmail($email);
		$simpleGravatar->setDefault($default);

		$expected = "http://www.gravatar.com/avatar/{$emailHash}.png?s=64&amp;d={$default}&amp;rating=g";

		$this->assertEquals($expected, $simpleGravatar->getGravatar());
	}

	public function testSetDefaultSecure()
	{
		$email     = 'test@email.com';
		$emailHash = md5($email);
		$default   = 'retro';

		$simpleGravatar = new Euantor\SimpleGravatar\Gravatar();
		$simpleGravatar->setEmail($email);
		$simpleGravatar->setDefault($default);
		$simpleGravatar->setSecure(true);

		$expected = "https://secure.gravatar.com/avatar/{$emailHash}.png?s=64&amp;d={$default}&amp;rating=g";

		$this->assertEquals($expected, $simpleGravatar->getGravatar());
	}

	public function testForceDefault()
	{
		$email     = 'test@email.com';
		$emailHash = md5($email);
		$default   = 'retro';

		$simpleGravatar = new Euantor\SimpleGravatar\Gravatar();
		$simpleGravatar->setEmail($email);
		$simpleGravatar->setDefault($default);
		$simpleGravatar->forceDefault(true);

		$expected = "http://www.gravatar.com/avatar/{$emailHash}.png?s=64&amp;d={$default}&amp;forcedefault=y&amp;rating=g";

		$this->assertEquals($expected, $simpleGravatar->getGravatar());
	}

	public function testForceDefaultSecure()
	{
		$email     = 'test@email.com';
		$emailHash = md5($email);
		$default   = 'retro';

		$simpleGravatar = new Euantor\SimpleGravatar\Gravatar();
		$simpleGravatar->setEmail($email);
		$simpleGravatar->setDefault($default);
		$simpleGravatar->forceDefault(true);
		$simpleGravatar->setSecure(true);

		$expected = "https://secure.gravatar.com/avatar/{$emailHash}.png?s=64&amp;d={$default}&amp;forcedefault=y&amp;rating=g";

		$this->assertEquals($expected, $simpleGravatar->getGravatar());
	}

	public function testSetRating()
	{
		$email     = 'test@email.com';
		$emailHash = md5($email);
		$rating    = 'pg';

		$simpleGravatar = new Euantor\SimpleGravatar\Gravatar();
		$simpleGravatar->setEmail($email);
		$simpleGravatar->setRating($rating);

		$expected = "http://www.gravatar.com/avatar/{$emailHash}.png?s=64&amp;d=mm&amp;rating={$rating}";

		$this->assertEquals($expected, $simpleGravatar->getGravatar());
	}

	public function testSetRatingSecure()
	{
		$email     = 'test@email.com';
		$emailHash = md5($email);
		$rating    = 'pg';

		$simpleGravatar = new Euantor\SimpleGravatar\Gravatar();
		$simpleGravatar->setEmail($email);
		$simpleGravatar->setRating($rating);
		$simpleGravatar->setSecure(true);

		$expected = "https://secure.gravatar.com/avatar/{$emailHash}.png?s=64&amp;d=mm&amp;rating={$rating}";

		$this->assertEquals($expected, $simpleGravatar->getGravatar());
	}
}
