<?php
class HiZend_Auth extends Zend_Auth
{
    /**
     * Singleton instance
     *
     * @var HiZend_Auth
     */
    protected static $_instance = null;


    /**
     * Defines how much time to wait until
     * to reinitialize the session id
     */
    protected static $_session_exp_time = 5;

    /**
     * Defines if to validate a secure identity
     */
    protected static $_secure = TRUE;

    /**
     * Defines secure identity check level
     *
     * 1 - Check only IP
     * 2 - Check only UserAgent
     * 3 - Check IP & UserAgent
     */
    protected static $_secure_level = 3;

    /**
     * Returns an instance of HiZend_Auth
     *
     * Singleton pattern implementation
     *
     * @return HiZend_Auth Provides a fluent interface
     */
    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }

        return self::$_instance;
    }

    /**
     * Sets wheter the method @see hasSecureIdentity
     * to work or not. If set to FALSE then this extension will work
     * as the normal Zend_Auth class
     *
     * @param boolean true
     */
    public function setSecure($status = TRUE)
    {
        if ($status === TRUE)
        {
            self::$_secure = TRUE;
        }

        if ($status === FALSE)
        {
            self::$_secure = FALSE;
        }

        return TRUE;
    }

    /**
     * Sets the level of security for the @see hasSecureIdentity method
     *
     * @param integer $level (can be 1 or 2 or 3)
     */
    public function setSecureLevel($level)
    {
        if (in_array($level, array(1, 2, 3)))
        {
            self::$_secure_level = $level;
        }

        return TRUE;
    }

    /**
     * Returns true if and only if an identity is not stolen
     *
     * Checks if IP and/or User Agent (@see $_secure_level)
     * match the initial authentication data
     *
     * @return boolean
     */
    public function hasSecureIdentity()
    {
        if (self::$_secure === FALSE)
        {
            return TRUE;
        }

        if (FALSE == $this->getStorage()->isEmpty())
        {
            $storage = $this->getStorage()->read();

            if (self::$_secure_level == 3)
            {
                return $storage->ip == $_SERVER['REMOTE_ADDR']
                    && $storage->user_agent == $_SERVER['HTTP_USER_AGENT'];
            }
            elseif (self::$_secure_level == 2)
            {
                return $storage->user_agent == $_SERVER['HTTP_USER_AGENT'];
            }
            elseif (self::$_secure_level == 1)
            {
                return $storage->ip == $_SERVER['REMOTE_ADDR'];
            }
            else
            {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
    }

    /**
     * If the Zend Auth Storage
     * has been initialized and is a Session Storage
     * and the last time it has been reinitialized is bigger then
     * the @see $session_exp_time then reinitialize the session id
     *
     * @return boolean
     */
    public function reinitSecurity()
    {
        if (isset($_SESSION['HiZend_Auth']))
        {
            $zend_auth_session_namespace = new Zend_Session_Namespace('HiZend_Auth');
            if (!isset($zend_auth_session_namespace->initialized)
                || $zend_auth_session_namespace->initialized + self::$session_exp_time < time() ) {
                Zend_Session::regenerateId();
                $zend_auth_session_namespace->initialized = time();
            }
        }

        return TRUE;
    }
}
