<?php

class SessionController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 * GET /session
	 *
	 * @return Response
	 */
	public function index()
	{
		if ( Sentry::check())
		{
		    return Redirect::route('dashboard');
		}

		return View::make('sessions.login');
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /session/create
	 *
	 * @return Response
	 */
	public function create()
	{
		if ( Sentry::check())
		{
		    return Redirect::route('dashboard');
		}

		$message = array();

		try
		{
			$rules = array(
				'email' => 'required|email',
				'password' => 'required'
			);

			$credentials = array(
				'email' => Input::get('email'),
				'password' => Input::get('password')
			);

			$validator = Validator::make($credentials, $rules);

			if($validator->fails())
			{
				return Redirect::route('session.login')->withErrors($validator)->withInput(Input::except('password'));
			}

		    // Authenticate the user
		    $user = Sentry::authenticateAndRemember($credentials);
		    return Redirect::route('dashboard')->with('message', 'Thanks for logging back in!');
		}

		catch (Cartalyst\Sentry\Users\LoginRequiredException $e)
		{
			$message = array_add($message, 'LoginRequiredException', 'Email Address is required.');
		}
		catch (Cartalyst\Sentry\Users\PasswordRequiredException $e)
		{
			$message = array_add($message, 'PasswordRequiredException', 'Password field is required.');
		}
		catch (Cartalyst\Sentry\Users\WrongPasswordException $e)
		{
			$message = array_add($message, 'WrongPasswordException', 'Wrong password, try again.');
		}
		catch (Cartalyst\Sentry\Users\UserNotFoundException $e)
		{
			$message = array_add($message, 'UserNotFoundException', 'User was not found.');
		}
		catch (Cartalyst\Sentry\Users\UserNotActivatedException $e)
		{
			$message = array_add($message, 'UserNotActivatedException', 'User is not activated.');
		}

		// The following is only required if the throttling is enabled
		catch (Cartalyst\Sentry\Throttling\UserSuspendedException $e)
		{
			$message = array_add($message, 'UserSuspendedException', 'User is suspended.');
		}
		catch (Cartalyst\Sentry\Throttling\UserBannedException $e)
		{
			$message = array_add($message, 'UserBannedException', 'User is banned.');
		}

		return Redirect::route('session.login')->withErrors($message)->withInput(Input::except('password'));

	}

	/**
	 * Store a newly created resource in storage.
	 * POST /session
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}

	/**
	 * Display the specified resource.
	 * GET /session/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /session/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /session/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	public function destroy()
	{
		Sentry::logout();
		return Redirect::to('/');
	}

}