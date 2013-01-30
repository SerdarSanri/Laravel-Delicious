#Delicious bundle for Laravel

This bundle will allow you to retrieve links from a Delicious account using the [Delicious API v2](https://delicious.com/developers/apifeeds).


##Setup
Install the bundle  

  $ php artisan bundle:install delicious

Include it in application/bundles.php  

	return array('delicious');


##Example Usage
In application/routes.php you can add a simple route to read and dump your delicious bookmarks at /bookmarks

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
     $tumblr = Delicious\Delicious::init('bdrelling');

###take($count)
	/**
     * set the count of results to take (1-100, default 15)
     * 
     * @param integer count
     * @return object
     */
     $tumblr = Delicious\Delicious::init('bdrelling')->take(10)->get();

###get()
	/**
     * get the bookmarks
     * 
     * @return array bookmarks
     */
     $tumblr = Delicious\Delicious::init('bdrelling')->get();


Bundle created by [Brian Drelling](http://briandrelling.com).
