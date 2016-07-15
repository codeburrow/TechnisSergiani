<?php
namespace Kourtis\Router;

class Router
{
    private $_getUri = array();
    private $_getController = array();
    private $_getMethod = array();
    private $_postUri = array();
    private $_postController = array();
    private $_postMethod = array();

    public function __construct()
    {
    }

    /**
     * Build a collection of internal GET URLs to look for
     * @param $uri - The url that the user types in the browser
     * @param $controller - The controller that will handle the url
     * @param $method - The method of the controller that will run
     */
    public function get($uri, $controller, $method)
    {
        $this->_getUri[] = $uri;
        $this->_getController[] = $controller;
        $this->_getMethod[] = $method;
    }

    /**
     * Build a collection of internal POST URLs to look for
     * @param $uri - The url that the user types in the browser
     * @param $controller - The controller that will handle the url
     * @param $method - The method of the controller that will run
     */
    public function post($uri, $controller, $method)
    {
        $this->_postUri[] = $uri;
        $this->_postController[] = $controller;
        $this->_postMethod[] = $method;
    }

    public function submit()
    {
        $found = 0;
        $path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); //get the url
        
        /**
         * If last char in URL is '/' redirect without it
         * and also check if url is root '/' because this would result
         * in infinite loop
         */
        if ( ($path[strlen($path)-1] === '/') && !($path === '/') ) { //
            $newPath = substr($path, 0, -1);
            header("Location: $newPath", true, 302);
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            //Map URL to page
            foreach ($this->_getUri as $key => $value)
            {
                if ( $found = preg_match("#^$value$#", $path) )
                {
//                    echo $key . ' => ' . $value; //See what the $path returns

                    //Find parameter if passed
                    $parts = explode('/', $path);
//                    count($parts) > 2 ? $parameter=$parts[2] : $parameter=null;

                    //Instantiate Controller
                    $controller = 'Kourtis\Controllers\\' . $this->_getController[$key];
                    $controller = new $controller($parts);

                    //Call the appropriate method
                    $method = $this->_getMethod[$key];
                    $controller->$method();

                    break;
                }
            }

            //Show 404 page
            if ( $found == 0 )
            {
                //Instantiate Controller
                $controller = 'Kourtis\Controllers\MainController';
                $controller = new $controller();

                //Call the appropriate method
                $method = 'error404';
                $controller->$method();

                die();
            }

        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
            foreach ($this->_postUri as $key => $value)
            {
                if ( $found = preg_match("#^$value$#", $path))
                {
//                    echo $key . ' => ' . $value; //See what the $path returns

                    //Find parameter if passed
                    $parts = explode('/', $path);
                    count($parts) > 2 ? $parameter=$parts[2] : $parameter=null;

                    //Instantiate Controller
                    $controller = 'Kourtis\Controllers\\' . $this->_postController[$key];
                    $controller = new $controller($parameter);

                    //Call the appropriate method
                    $method = $this->_postMethod[$key];
                    $controller->$method();

                    break;
                }
            }

            //Show 404 page
            if ( $found == 0 )
            {
                //Instantiate Controller
                $controller = 'Kourtis\Controllers\MainController';
                $controller = new $controller();

                //Call the appropriate method
                $method = 'error404';
                $controller->$method();

                die();
            }
        }

    }

}