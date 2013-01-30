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
    protected $sort = NULL;
    protected $tags = NULL;
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
     * turns on the alphanumeric sort
     * 
     * @return object
     */
    public function sort()
    {
        $this->sort = true;
        
        return $this;
    }

    /**
     * sets the tags to return
     * 
     * @param string tags
     * @return object
     */
    public function tags($tags)
    {
        $this->tags = $tags;
        
        return $this;
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
     * resets all variables
     * 
     */
    function reset()
    {
        $this->sort = NULL;
        $this->tags = NULL;
        $this->take = NULL;
    }
	
    /**
     * get the bookmarks
     * 
     * @return array bookmarks
     */
    function get()
    {
    	  $url = 'https://api.del.icio.us/v2/json/'.$this->username;
    	  
    	  if(isset($this->tags)) {
    	      $url .= '/'.$this->tags;
    	  }
    	  
    	  if(isset($this->take)) {
    	      $url .= '?count='.$this->take;
    	  }

        $result = $this->_get_data($url);
        
        if (isset($this->sort)) {
            $result = $this->_sort_data($result);
        }

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
    
    /**
     * sorts data retrieved from the API by name
     * 
     * @param string param
     * @return array bookmarks
     */
    protected function _sort_data($bookmarks)
    {
        usort($bookmarks, function ($a, $b) {
    
          $s = strcasecmp($a->d, $b->d);
        
          if ($s == 0) { return 0; }
          if ($s > 0) { return 1; }
          if ($s < 0) { return -1; }
        
        });
        
        return $bookmarks;
    }

}