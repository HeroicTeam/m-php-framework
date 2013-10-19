<?php

/**
 * Returns a configured form object.
 *
 * @param string $action
 * @param string $method
 * @param bool $multipart
 * @return \m\Html\Form
 */
m\m::bind('form', function($action = '', $method = 'post', $multipart = false, $core)
{
    // Get the session object
    $session = $core->make('session');

    // Create the Form object
    $form = new m\Html\Form($action, $method, $multipart);

    // Set the session object for the CSRF token
    $form->setSession($session);

    // Return the new Form object
    return $form;
});

/**
 * Returns a generic file object.
 *
 * @param string $filepath
 * @return m\File\GenericFile
 */
m\m::bind('plainfile', function($filepath)
{
    return new m\File\GenericFile($filepath);
});

/**
 * Returns a response object complete with session for
 * flash messaging support.
 *
 * @param string $body
 * @param int $status
 * @param array $headers
 * @return \m\Http\Response
 */
m\m::bind('response', function($body = '', $status = 200, array $headers = array(), $core)
{
    // Get the current Session object
    $session    = $core->make('session');

    // Create the Response object
    $response   = new m\Http\Response($body, $status, $headers);

    // Set the session object for flashing
    $response->setSession($session);

    // Return the new Response object
    return $response;
});

/**
 * Returns the session object.
 *
 * @param string $id
 * @return \m\Http\Session
 */
m\m::singleton('session', function($id = null)
{
    return new m\Http\Session($id);
});

/**
 * Returns a configured validator object.
 *
 * @param array $rules
 * @return \m\Validation\Validator
 */
m\m::bind('validator', function(array $rules = array(), $core)
{
    // Get the session object
    $session    = $core->make('session');

    // Create the Validator object
    $validator  = new m\Validation\Validator($rules);

    // Set the session object for the CSRF token
    $validator->setSession($session);

    // Return the new Validator object
    return $validator;
});

/**
 * Returns a fully configured view response.
 *
 * @param string $file
 * @param string|null $directory
 * @return \m\View\GenericView
 */
m\m::bind('view', function ($file, $directory = null, $core)
{
    // Determine the filepath
    if (null === $directory)
        $directory = $core->get('view_dir');

    // Create the view object
    $view = new m\View\GenericView($directory);

    // Fetch and write the file
    $view->fetchWrite($file);

    // Return the new View response object
    return $view;
});


/********************************
 * HELPER CONTAINERS
 ********************************/

/**
 * Returns a new file object or resolves "plainfile" if a valid resolution key
 * ($use) is not given or successfully assumed.
 *
 * @param string $filepath
 * @param null|string $use
 * @return object|null
 */
m\m::bind('open', function ($filepath, $use = null, $core)
{
    // If a specific resolution key is not given, assume one based
    // on the file extension (.json would be json_file).
    if (null === $use)
        $use = pathinfo($filepath, PATHINFO_EXTENSION).'_file';

    // If a valid resolution is found, return it
    if ($found = $core->make($use, array($filepath, true))) {

        // Call the open method, if available
        if (method_exists($found, 'open'))
            $found->open();

        return $found;
    }

    // Otherwise return the default file object
    return $core->make('plainfile', array($filepath))->open();
});

/**
 * Creates a new PDO object and supplies it with the default and
 * given configurations.
 *
 * @param array $config
 * @return \PDO
 */
m\m::singleton('pdo', function(array $config = array(), $core)
{
    // Get the db settings
    $db  = array_merge($core->get('database', array()), $config);

    // Capture the DSN
    $dsn = isset($db['dsn']) ? $db['dsn'] : $db['type'].':host='.$db['host'].';dbname='.$db['name'];

    // Return a new PDO object
    return new \PDO($dsn, $db['user'], $db['pass']);
});

/**
 * Creates a redirection response.
 *
 * @param string url
 * @return \m\Http\Response
 */
m\m::bind('redirect', function ($url, $core)
{
    // Create the response object
    $response = $core->make('response');

    // Call the redirect helper method
    $response->redirect($url);

    // Return the response object
    return $response;
});