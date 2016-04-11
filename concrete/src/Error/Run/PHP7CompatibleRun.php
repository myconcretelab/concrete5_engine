<?php
namespace Concrete\Core\Error\Run;

use Exception;
use Symfony\Component\Debug\Exception\FatalThrowableError;
<<<<<<< HEAD
=======
use Whoops\Exception\ErrorException;
use Whoops\Exception\Inspector;
>>>>>>> origin/master
use Whoops\Run;

class PHP7CompatibleRun
{
<<<<<<< HEAD
    protected $run;
    protected $isRegistered;
=======

    protected $run;
>>>>>>> origin/master

    public function __construct(Run $run)
    {
        $this->run = $run;
<<<<<<< HEAD
        $this->isRegistered = false;
=======
>>>>>>> origin/master
    }

    public function handleException($exception)
    {
<<<<<<< HEAD
=======

>>>>>>> origin/master
        if (!$exception instanceof \Exception) {
            $exception = new FatalThrowableError($exception);
        }

        // Convert to a compatible exception
        return $this->run->handleException($exception);
    }

    public function __call($name, $arguments)
    {
        $callable = array($this->run, $name);
        if (method_exists($this, $name)) {
            $callable = array($this, $name);
        }

        return call_user_func_array($callable, $arguments);
    }

    /**
     * Registers this instance as an error handler.
<<<<<<< HEAD
     *
=======
>>>>>>> origin/master
     * @return Run
     */
    public function register()
    {
        if (!$this->isRegistered) {
            // Workaround PHP bug 42098
            // https://bugs.php.net/bug.php?id=42098
            class_exists("\\Whoops\\Exception\\ErrorException");
            class_exists("\\Whoops\\Exception\\FrameCollection");
            class_exists("\\Whoops\\Exception\\Frame");
            class_exists("\\Whoops\\Exception\\Inspector");

            set_error_handler(array($this, Run::ERROR_HANDLER));
            set_exception_handler(array($this, Run::EXCEPTION_HANDLER));
            register_shutdown_function(array($this, Run::SHUTDOWN_HANDLER));

            $this->isRegistered = true;
        }

        return $this;
    }

    /**
<<<<<<< HEAD
     * Unregisters all handlers registered by this Whoops\Run instance.
     *
=======
     * Unregisters all handlers registered by this Whoops\Run instance
>>>>>>> origin/master
     * @return Run
     */
    public function unregister()
    {
        if ($this->isRegistered) {
            restore_exception_handler();
            restore_error_handler();

            $this->isRegistered = false;
        }

        return $this;
    }
<<<<<<< HEAD
=======

>>>>>>> origin/master
}
