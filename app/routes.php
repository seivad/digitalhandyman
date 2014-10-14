<?php

use Illuminate\Database\Eloquent\ModelNotFoundException;



Route::get('/login', array('as' => 'session.login', 'uses' => 'SessionController@index'));
Route::post('/login', 'SessionController@create');
Route::get('/logout', array('as' => 'session.logout', 'uses' => 'SessionController@destroy'));


Route::get('/unsuspend', function() {

	try
	{
	    $throttle = Sentry::findThrottlerByUserId('54328463fa463425079c4392');

	    if($suspended = $throttle->isSuspended())
	    {
	        // User is Suspended
	         $throttle->unsuspend();
	         echo 'user is unsuspended!';
	    }
	    else
	    {
	        // User is not Suspended
	        echo 'not suspended!';
	    }
	}
	catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	{
	    echo 'User was not found.';
	}

});

Route::get('/updateUser', function() {

	try
	{
	    // Find the user using the user id
	    $user = Sentry::findUserById(Sentry::getUser()->_id);

	    // Update the user details
	    $user->first_name = 'Louise';
	    $user->last_name = 'Davies';

	    // Update the user
	    if ($user->save())
	    {
	        // User information was updated
	        echo 'user was updated';
	        print_r($user);
	    }
	    else
	    {
	        // User information was not updated
	        echo 'could not update user';
	    }
	}
	catch (Cartalyst\Sentry\Users\UserExistsException $e)
	{
	    echo 'User with this login already exists.';
	}
	catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	{
	    echo 'User was not found.';
	}

});

Route::get('/users', function() {

	try
	{
	    $user = Sentry::findAllUsers();
	    return Response::json($user);

	}
	catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	{
	    echo 'User was not found.';
	}

});

Route::get('/user/{id}', function($id) {

	//54328463fa463425079c4392

	try
	{
	    $user = Sentry::findUserById($id);
	    return Response::json($user);
	}
	catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	{
	    echo 'User was not found.';
	}

});

Route::get('/group/usersin/{group}', function($group) {

	try
	{
		$result = Sentry::findGroupByName($group);
		$users = Sentry::findAllUsersInGroup($result);	
		return Response::json($users);
	}

	catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
	{
	    echo 'User was not found.';
	}

});


Route::get('/groups', function() {

	try
	{
	    $group = Sentry::findAllGroups();
	    return Response::json($group);
	}
	catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
	{
	    echo 'Group was not found.';
	}

});

Route::get('/group/{id}', function($id) {

	try
	{
	    $group = Sentry::findGroupById($id);
	    return Response::json($group);
	}
	catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
	{
	    echo 'Group was not found.';
	}

});


Route::get('/creategroup', function() {

try
{
    // Create the group
    $group = Sentry::createGroup(array(
        'name' => 'Administrators'
    ));

    $group = Sentry::createGroup(array(
        'name' => 'Customers'
    ));

    return 'group created';
}
catch (Cartalyst\Sentry\Groups\NameRequiredException $e)
{
    return 'Name field is required';
}
catch (Cartalyst\Sentry\Groups\GroupExistsException $e)
{
    return 'Group already exists';
}

return 'opps';

});



Route::get('/create', function() {
	try
	{
	    // Create the user
	    $user = Sentry::createUser(array(
	        'email'     => 'louisedavies@me.com',
	        'password'  => '12qwaszx',
	        'activated' => true,
	    ));

	    // Find the group using the group name
	    $customerGroup = Sentry::findGroupByName('Customers');

	    // Assign the group to the user
	    $user->addGroup($customerGroup);

	    return 'user created';
	}
	catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
	{
	    echo 'Login field is required.';
	}
	catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
	{
	    echo 'Password field is required.';
	}
	catch (Cartalyst\Sentry\Users\UserExistsException $e)
	{
	    echo 'User with this login already exists.';
	}
	catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
	{
	    echo 'Group was not found.';
	}
});



# Customer User Routes
Route::group(['before' => 'auth|customer'], function()
{
	Route::get('/customers', array('uses' => 'CustomerController@index'));
});

# Admin User Routes
Route::group(['before' => 'auth|administrator', 'prefix' => 'dashboard'], function()
{
	Route::get('/', array('as' => 'dashboard','uses' => 'DashboardController@index'));
	Route::get('posts/deleted', array('as' => 'dashboard.posts.deleted','uses' => 'PostsController@deletedPosts'));
	Route::post('posts/{id}/restore', array('as' => 'dashboard.posts.restore', 'uses' => 'PostsController@restore'));
	Route::resource('posts', 'PostsController');

	Route::get('pages/deleted', array('as' => 'dashboard.pages.deleted','uses' => 'PagesController@deletedPages'));
	Route::post('pages/{id}/restore', array('as' => 'dashboard.pages.restore', 'uses' => 'PagesController@restore'));
	Route::resource('pages', 'PagesController');
	
	Route::resource('users', 'UserController');
});


Route::get('/', array('as' => 'home', function()
{
	return View::make('pages.home');
}));

Route::get('/news', array('as' => 'pages.news', 'uses' => 'NewsController@index'));
Route::get('/{slug?}', array('as' => 'pages.view', 'uses' => 'PagesController@view'))->where('slug', '(.*)');


App::missing(function($exception)
{
    return Response::view('404', array(), 404);
});

App::error(function(ModelNotFoundException $e)
{
    return Response::view('404', array(), 404);
});


