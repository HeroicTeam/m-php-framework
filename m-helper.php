<?php

namespace m;

/**
 * This file is purely a helper for your IDE.  It mocks many of the
 * default static functions available to the "m" Class via the __callStatic
 * magic method (which IDEs don't pick up).
 */

class m
{

    /**
     * Returns the requested setting or the given default if the
     * requested setting doesn't exist.
     *
     * @param string $key
     * @param null|mixed $default
     * @return mixed
     */
    public static function get($key, $default = null) {}

    /**
     * Sets a setting value to the given key.
     *
     * @param string $key
     * @param mixed $value
     * @return \m\Foundation\Core
     */
    public static function set($key, $value)
    {
        return new Foundation\Core();
    }

    /**
     * Registers a new object container.
     *
     * @param string $name
     * @param callable $callable
     * @param bool $singleton
     * @return \m\Foundation\Core
     */
    public static function bind($name, \Closure $callable, $singleton = false)
    {
        return new Foundation\Core();
    }

    /**
     * Registers a singleton object container.
     *
     * @param string $name
     * @param \Closure $callable
     * @return \m\Foundation\Core
     */
    public static function singleton($name, \Closure $callable)
    {
        return new Foundation\Core();
    }

    /**
     * Resolves a set container and returns the new object.
     *
     * @param string $name
     * @param array $params
     * @param bool $force
     * @return object|null
     */
    public static function make($name, array $params = array(), $force = false) {}

    /**
     * Force resolves a container and returns the new object.
     *
     * @param string $name
     * @param array $params
     * @return object|null
     */
    public static function remake($name, array $params = array()) {}

    /**
     * Calls the hooks stored at the given event name (if any exist) and
     * passes them the given parameters.
     *
     * @param string $event
     * @param array $params
     * @return \m\Foundation\Core
     */
    public function call($event, array $params = array())
    {
        return new Foundation\Core();
    }

    /**
     * Binds a new callable action to a hook event.
     *
     * @param string $event
     * @param callable|\Closure $callable
     * @return \m\Foundation\Core
     * @throws \InvalidArgumentException
     */
    public static function on($event, $callable)
    {
        return new Foundation\Core();
    }



    /********************************
     * CONTAINERS
     ********************************/



    /**
     * Returns a configured form object.
     *
     * @param string $action
     * @param string $method
     * @param bool $multipart
     * @return \m\Html\Form
     */
    public static function form($action = '', $method = 'post', $multipart = false)
    {
        return new Html\Form();
    }

    /**
     * Returns a generic file object.
     *
     * @param string $filepath
     * @return \m\File\GenericFile
     */
    public static function plainfile($filepath)
    {
        return new File\GenericFile($filepath);
    }

    /**
     * Returns a response object complete with session for
     * flash messaging support.
     *
     * @param string $body
     * @param int $status
     * @param array $headers
     * @return \m\Http\Response
     */
    public static function response($body = '', $code = 200, array $headers = array())
    {
        return new Http\Response($body, $code, $headers);
    }

    /**
     * Returns the session object.
     *
     * @param string $id
     * @return \m\Http\Session
     */
    public static function session($id = null)
    {
        return new Http\Session($id);
    }

    /**
     * Returns a configured validator object.
     *
     * @param array $rules
     * @return \m\Validation\Validator
     */
    public static function validator(array $rules = array())
    {
        return new Validation\Validator($rules);
    }

    /**
     * Returns a fully configured view response.
     *
     * @param string $file
     * @param string|null $directory
     * @return \m\View\GenericView
     */
    public static function view($file, $directory = null)
    {
        return View\GenericView($file, $directory);
    }



    /********************************
     * HELPER CONTAINERS
     ********************************/

    /**
     * Creates and configures a form and validator object based on the
     * given array and then returns a standard php object with the form
     * and validator as public properties.
     *
     * @param array $fields
     * @return \StdObject
     */
    public static function buildForm(array $fields)
    {
        return (object) array();
    }

    /**
     * Returns a new file object or resolves "plainfile" if a valid resolution key
     * ($use) is not given or successfully assumed.
     *
     * @param string $filepath
     * @param null|string $use
     * @return object|null
     */
    public static function open($filepath, $use = null)
    {
        return new File\GenericFile($filepath);
    }

    /**
     * Creates a new PDO object and supplies it with the default and
     * given configurations.
     *
     * @param array $config
     * @return \PDO
     */
    public static function pdo(array $config = array())
    {
        return new \PDO('','','');
    }

    /**
     * Creates a redirection response.
     *
     * @param string url
     * @return \m\Http\Response
     */
    public static function redirect($url)
    {
        return new Http\Response();
    }

}
