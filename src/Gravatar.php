<?php

namespace Euantor\SimpleGravatar;

/**
 * Simple Gravatar generator.
 *
 * A simple class to generate the URL to a user's Gravatar based on their email address.
 *
 * @category Tools
 * @package  SimpleGravatar
 * @author   Euan T. <euan@euantor.com>
 * @license  http://opensource.org/licenses/mit-license.php The MIT License
 * @version  1.00
 */
class Gravatar
{
	/**
	 * Base URL to the Gravatar service.
	 */
	const BASEURL = 'http://www.gravatar.com/avatar/';

	/**
	 * Base URL to the Gravatar service for secure connections (over HTTPS).
	 */
	const BASEURL_SECURE = 'https://secure.gravatar.com/avatar/';

	/**
	 * Is the Gravatar to be transported via a secure connection (HTTPS)?
	 *
	 * @access protected
	 * @var boolean
	 */
	protected $secure = false;

	/**
	 * The email the Gravatar is to be generated for.
	 *
	 * @access protected
	 * @var string
	 */
	protected $email = '';

	/**
	 * The extension to use for the Gravatar.
	 *
	 * @access protected
	 * @var string
	 */
	protected $extension = '.png';

	/**
	 * The dimentions to be used for the Gravatar.
	 *
	 * @access protected
	 * @var integer
	 */
	protected $size = 64;

	/**
	 * The default image to use if no Gravatar is found.
	 *
	 * @access protected
	 * @var string
	 */
	protected $default = 'mm';

	/**
	 * Should the default Gravatar image be forced even if the user has one?
	 *
	 * @access protected
	 * @var boolean
	 */
	protected $forceDefault = false;

	/**
	 * The maximum age rating the Gravatar must comply to.
	 *
	 * @access protected
	 * @var string
	 */
	protected $rating = 'g';

	/**
	 * Set secure Gravatars
	 *
	 * Should we use Gravatar's secure URL for our Gravatars?
	 *
	 * @param bool $secure Should we use the secure URL? Defaults to true when calling this method
	 *
	 * @return object $this
	 */
	public function setSecure($secure = true)
	{
		$this->secure = (bool) $secure;

		return $this;
	}

	/**
	 * Set email address
	 *
	 * Set the email address for which we should fetch the gravatar
	 *
	 * @param String $email The email address
	 *
	 * @return object $this
	 */
	public function setEmail($email = '')
	{
		$email = (string) $email;
		$email = trim($email);

		if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$this->email = md5($email);
		}

		return $this;
	}

	/**
	 * Set image extension
	 *
	 * Set the extension to be used for the Gravatar - should be a valid image extension. Defaults to .png
	 *
	 * @param string $extension The extension. If not prefixed with a period ".", one is added
	 *
	 * @return object $this
	 */
	public function setExtension($extension = '.png')
	{
		if (substr($extension, 0, 1) != '.') {
			$extension = '.' . $extension;
		}

		$this->extension = $extension;

		return $this;
	}

	/**
	 * Set image size
	 *
	 * Set the dimensions of the gravatar to be returned. Since gravatars are square, only one dimension needs to be set
	 *
	 * @param int $size The size to be used
	 *
	 * @return object $this
	 */
	public function setSize($size = 32)
	{
		$this->size = (int) $size;

		return $this;
	}

	/**
	 * Set the default gravatar
	 *
	 * Set the default Gravatar to be used if one does not exist. Can either be from a list of defaults or from a URL
	 * Defaults available: '404', 'mm', 'identicon', 'monsterid', 'wavatar', 'retro'
	 *
	 * @param string $default The default to be used
	 *
	 * @return object $this
	 */
	public function setDefault($default = 'mm')
	{
		$default = trim($default);

		$gravatarDefaults = array(
			'404',
			'mm',
			'identicon',
			'monsterid',
			'wavatar',
			'retro',
		);

		if (in_array((string) $default, $gravatarDefaults)) {
			$this->default = (string) $default;
		} elseif (strpos($default, 'http') !== false AND filter_var($default, FILTER_VALIDATE_URL)) {
			$this->default = urlencode($default);
		}

		return $this;
	}

	/**
	 * Force the default avatar
	 *
	 * If for some reason you wish to force the default avatar defined by SetDefault() you can do so by calling this method
	 *
	 * @param bool $force Defaults to true
	 *
	 * @return object $this
	 */
	public function forceDefault($force = true)
	{
		$this->forceDefault = (bool) $force;
	}

	/**
	 * Set age rating
	 *
	 * Gravatars are given age ratings when set. You can define the maximum rating using this method
	 * Can be 'g', 'pg', 'r' or 'x'
	 *
	 * @param string $rating The maximum rating. Defaults to 'g'
	 *
	 * @return object $this
	 */
	public function setRating($rating = 'g')
	{
		$allowedRatings = array(
			'g',
			'pg',
			'r',
			'x',
		);

		$rating = (string) $rating;

		if (in_array($rating, $allowedRatings)) {
			$this->rating = $rating;
		}

		return $this;
	}

	/**
	 * Get the gravatar
	 *
	 * Get the actual gravatar. Can either return the actual URL or a fully formed <img> tag
	 *
	 * @param string $email You can optionally set an email with this method and miss out all other methods for a default gravatar type
	 *
	 * @return object $this
	 */
	public function getGravatar($email = null)
	{
		if (isset($email)) {
			$this->setEmail((string) $email);
		}

		$url = self::BASEURL;
		if ($this->secure) {
			$url = self::BASEURL_SECURE;
		}

		$url .= $this->email;
		$url .= $this->extension;
		$url .= '?s=' . $this->size;
		$url .= '&amp;d=' . $this->default;

		if ($this->forceDefault) {
			$url .= '&amp;forcedefault=y';
		}

		$url .= '&amp;rating=' . $this->rating;

		return $url;
	}
}
