#Delicious bundle for Laravel

This bundle will allow you to retrieve links from a Delicious account using the [Delicious API v2](https://delicious.com/developers/apifeeds).


##Setup
Install the bundle  

	$ php artisan bundle:install delicious

Include it in application/bundles.php  

	return array('delicious');


##Example Usage
In application/routes.php you can add a simple route to read and dump your delicious bookmarks at /delicious

	Route::get('delicious', function()
	{
		Bundle::start('delicious');

		$bookmarks = Delicious\Delicious::init('bdrelling')->take(10)->get();

		var_dump($bookmarks);
	});


##Methods

###init($username)
	/**
     * initialize and set the username
     * 
     * @param string username
     * @return object
     */
     $delicious = Delicious\Delicious::init('bdrelling');

###tags($tags)
	/**
     * sets the tags to return (tags separated by +)
     * 
     * @param string tags
     * @return object
     */
     $delicious = Delicious\Delicious::init('bdrelling')->take(10)->tags('development+api')->get();

###take($count)
	/**
     * set the count of results to take (1-100, default 15)
     * 
     * @param integer count
     * @return object
     */
     $delicious = Delicious\Delicious::init('bdrelling')->take(10)->get();

###sort()
	/**
     * sorts the array of bookmarks alphabetically by name
     * 
     * @return object
     */
     $delicious = Delicious\Delicious::init('bdrelling')->take(30)->sort()->get();

###reset()
	/**
     * resets all variables
     * 
     */
     $delicious->reset();

###get()
	/**
     * get the bookmarks
     * 
     * @return array bookmarks
     */
     $delicious = Delicious\Delicious::init('bdrelling')->get();


Bundle created by [Brian Drelling](http://briandrelling.com).
