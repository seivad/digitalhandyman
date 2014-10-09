<?php

class DashboardController extends \BaseController {

	public function index()
	{

		return View::make('dashboard.index');

		if (Session::has('message'))
		{
		   echo Session::get('message');
		}

		try
		{	
			$user = Sentry::findUserByID(Sentry::getUser()->_id);
		    // Get the user groups
		    $groups = $user->getGroups();

			return Response::json($groups);
		}

		catch (Cartalyst\Sentry\Groups\GroupNotFoundException $e)
		{
		    echo 'Group was not found.';
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
		    echo 'User was not found.';
		}


	}



}