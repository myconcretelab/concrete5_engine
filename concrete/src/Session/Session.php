<?php
namespace Concrete\Core\Session;

<<<<<<< HEAD
use Concrete\Core\Application\Application;
=======
use Concrete\Core\Support\Facade\Application;
>>>>>>> origin/master
use \Symfony\Component\HttpFoundation\Session\Session as SymfonySession;

/**
 * Class Session
 * @package Concrete\Core\Session
 * @deprecated
 */
class Session
{

<<<<<<< HEAD
    /** @var Application */
    protected static $app;

    /**
     * DO NOT USE THIS METHOD
     * Instead override the application bindings.
     * This method only exists to enable legacy static methods on the real application instance
     * @deprecated Create the session using $app->make('session');
     */
    public static function setApplicationObject(Application $app)
    {
        static::$app = $app;
    }

    /**
=======
    /**
     * Class Session
     * @package Concrete\Core\Session
>>>>>>> origin/master
     * @deprecated Create the session using $app->make('session');
     */
    public static function start()
    {
        /** @var FactoryInterface $factory */
<<<<<<< HEAD
        return self::$app->make('session');
=======
        return Application::make('session');
>>>>>>> origin/master
    }

    /**
     * @param \Symfony\Component\HttpFoundation\Session\Session $session
     * @deprecated Use \Concrete\Core\Session\SessionValidator
     */
    public static function testSessionFixation(SymfonySession $session)
    {
<<<<<<< HEAD
        $validator = self::$app->make('Concrete\Core\Session\SessionValidatorInterface');
=======
        $validator = Application::make('Concrete\Core\Session\SessionValidatorInterface');
>>>>>>> origin/master
        $validator->handleSessionValidation($session);
    }
}
