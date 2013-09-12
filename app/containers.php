<?php

/**
 * File
 */
m\m::bind('file', function($filepath)
{
    return new m\File\GenericFile($filepath);
});

/**
 * Form
 */
m\m::bind('form', function(array $rules = array())
{
    // Get the session object
    $session    = m\m::session();

    // Create the Form object
    $form = new m\Html\Form($rules);

    // Set the session object for the CSRF token
    $form->setSession($session);

    // Return the new Form object
    return $form;
});

/**
 * Creates a new PDO object and supplies it with
 * the default and given configurations.
 */
m\m::singleton('pdo', function(array $config = array())
{
    // Get the db settings
    $db  = array_merge(m::get('database', array()), $config);

    // Capture the DSN
    $dsn = isset($db['dsn']) ? $db['dsn'] : $db['type'].':host='.$db['host'].';dbname='.$db['name'];

    // Return a new PDO object
    return new \PDO($dsn, $db['user'], $db['pass']);
});

/**
 * Response (with Session for flashing)
 */
m\m::bind('response', function($body = '', $status = 200, array $headers = array())
{
    // Get the current Session object
    $session    = m\m::session();

    // Create the Response object
    $response   = new m\Http\Response($body, $status, $headers);

    // Set the session object for flashing
    $response->setSession($session);

    // Return the new Response object
    return $response;
});

/**
 * Session
 */
m\m::singleton('session', function($id = null)
{
    return new m\Http\Session($id);
});

/**
 * Validator
 */
m\m::bind('validator', function(array $rules = array())
{
    // Get the session object
    $session    = m\m::session();

    // Create the Validator object
    $validator  = new m\Validation\Validator($rules);

    // Set the session object for the CSRF token
    $validator->setSession($session);

    // Return the new Validator object
    return $validator;
});

/**
 * View
 */
m\m::bind('view', function ($file, $filepath = null)
{
    // Determine the filepath
    if (null === $filepath)
        $filepath = m\m::get('view_dir');

    // Create the view object
    $view = new m\View\GenericView($filepath);

    // Fetch and write the file
    $view->fetchWrite($file);

    // Return the new View response object
    return $view;
});