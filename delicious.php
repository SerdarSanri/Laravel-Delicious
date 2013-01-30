<?php
/**
 * Laravel Delicious Bundle
 *
 * @category  Bundle
 * @package   Laravel
 * @author    Brian Drelling <http://briandrelling.com>
 * @copyright 2013 Brian Drelling
 * @license   MIT License http://www.opensource.org/licenses/mit-license.php
 * @version   Release: 1.0
 * @link      https://github.com/bdrelling/Laravel-Delicious
 */

namespace Delicious;

class Delicious {
  
    public $username;
    protected $take = NULL;

    function __construct($username)
    {
        $this->username = $username;
    }

    /**
     * initialize and set the username
     * 
     * @param string username
     * @return object
     */
    public static function init($username)
    {
        return new static($username);
    }

    /**
     * set the count of results to take
     * 
     * @param integer count
     * @return object
     */
    public function take($count)
    {
        $count = ($count > 100) ? 100 : (($count < 0) ? 0 : $count);
        $this->take = $count;
        
        return $this;
    }
	
    /**
     * get the bookmarks
     * 
     * @return array bookmarks
     */
    function get()
    {
    	  $url = 'https://api.del.icio.us/v2/json/'.$this->username;
    	  
    	  if(isset($this->take)) {
    	      $url .= '?count='.$this->take;
    	  }

        $result = $this->_get_data($url);

	      return $result;
    }
    
    /**
     * retrieve data from API
     * 
     * @param string url
     * @return array api results
     */
    protected function _get_data($url)
    {
        if(function_exists("curl_version"))
        {
            $c = curl_init($url);
            curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($c, CURLOPT_FOLLOWLOCATION, 1);
	
            $result = curl_exec($c);
        }
        return json_decode($result);
    }

}
