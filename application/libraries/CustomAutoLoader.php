<?php
class CustomAutoLoader
{

    public function __construct()
    {
        spl_autoload_register(array($this, 'loader'));
    }

    public function loader($className)
    {
        if (substr($className, 0, 7) == 'helpers')
            require  APPPATH .  str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    }
}
