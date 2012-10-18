<?php
/**
 * Simple Gravatar URL generator
 *
 * A simple class to generate the URL to a user's Gravatar based on their email address
 *
 * @category Tools
 * @package  SimpleGravatar
 * @author   Euan T. <euan@euantor.com>
 * @license  http://opensource.org/licenses/mit-license.php The MIT License
 * @version  1.00
 * @link     http://www.euantor.com/113-gravatars-in-php Gravatar generation in PHP
 */

class SimpleGravatar
{
    const BASEURL        = 'http://www.gravatar.com/avatar/';
    const BASEURL_SECURE = 'https://secure.gravatar.com/avatar/';

    protected $secure;
    protected $email;
    protected $extension;
    protected $size;
    protected $default;
    protected $forceDefault;
    protected $rating;

    /**
     * Class Constructor
     *
     * Sets a few default settings for the class
     */
    public function __construct()
    {
        $this->secure = false;
        $this->extension = '.png';
        $this->size = 32;
        $this->default = 'mm';
        $this->forceDefault = false;
        $this->rating = 'g';

        return $this;
    }

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
        if (filter_var((string) $email, FILTER_VALIDATE_EMAIL)) {
            $this->email = md5(strtolower(trim((string) $email)));
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
            $extension = '.'.$extension;
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
     * Set the default Gravatar to be used if one does not exist. Can either be from a lsit of defaults or from a URL
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
        } elseif (strpos($default, 'http') AND filter_var($default, FILTER_VALIDATE_URL)) {
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

        if (in_array((string) $rating, $allowedRatings)) {
            $this->rating = (string) $rating;
        }

        return $this;
    }

    /**
     * Get the gravatar
     *
     * Get the actual gravatar. Can either return the actual URL or a fully formed <img> tag
     *
     * @param bool   $img   Construct an <img> tag or return the pure URL? Defaults to false
     * @param string $email You can optionally set an email with this method and miss out all other methods for a default gravatar type
     *
     * @return object $this
     */
    public function getGravatar($img = false, $email = null)
    {
        if (isset($email)) {
            $this->SetEmail((string) $email);
        }

        $url = self::BASEURL;
        if ($this->secure) {
            $url = self::BASEURL_SECURE;
        }

        $url .= $this->email;
        $url .= $this->extension;
        $url .= '?s='.$this->size;
        $url .= '&amp;d='.$this->default;

        if ($this->forceDefault) {
            $url .= '&amp;forcedefault=y';
        }

        $url .= '&amp;rating='.$this->rating;

        if ((bool) $img) {
            return '<img src="'.$url.'"" width="'.$this->size.'" height="'.$this->size.'" alt="Gravatar" />';
        } else {
            return $url;
        }
    }
}
