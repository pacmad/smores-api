<?php
namespace PhalconRest\Libraries\Authentication;

use Phalcon\DI\Injectable;
use \PhalconRest\Libraries\Authentication\UserProfile;
use \PhalconRest\Util\HTTPException;
use \PhalconRest\Models\Users;
use \PhalconRest\Models\PhalconRest\Models;

/**
 * custom to this application but relies on the authentication library built 
 * into the PhalconREST API
 *
 * @author jjenkins
 *        
 */
final class Local extends Injectable implements \PhalconRest\Authentication\AdapterInterface
{
    
    /**
     * store any error messages generated by the adapter during the course of attempting to log in
     *
     * @var string
     */
    public $errorMessage;

    private $params;

    private $di;

    function __construct()
    {
        $di = \Phalcon\DI::getDefault();
        $this->di = $di;
    }

    /**
     * check the username & password against the local user table source
     *
     * @param string $user_name            
     * @param false $password            
     * @return boolean
     */
    function authenticate($userName, $password)
    {
        $users = \PhalconRest\Models\Users::find(array(
            "user_name = '$userName'",
            "status" => "Active"
        ));
        switch ($users->count()) {
            case 1:
                $user = $users->getFirst();
                // compare password
                $proposed = hash('sha512', $user->salt . $password);
                $actual = $user->password;
                if ($proposed == $actual) {
                    return true;
                } else {
                    return false;
                }
                break;
            
            default:
                return false;
                break;
        }
    }
}