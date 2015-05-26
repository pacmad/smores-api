<?php
namespace PhalconRest\Models;

class Employees extends \PhalconRest\API\BaseModel
{

    /**
     *
     * @var integer
     */
    public $user_id;

    /**
     *
     * @var integer
     */
    public $active;

    /**
     *
     * @var string
     */
    public $user_name;

    /**
     *
     * @var string
     */
    public $password;

    /**
     *
     * @var string
     */
    public $salt;

    /**
     * define custom model relationships
     *
     * (non-PHPdoc)
     *
     * @see extends \PhalconRest\API\BaseModel::initialize()
     */
    public function initialize()
    {
        parent::initialize();
        $this->belongsTo("user_id", "PhalconRest\Models\Users", "id", array(
            'alias' => 'Users'
        ));
    }

    /**
     * (non-PHPdoc)
     *
     * @see \PhalconRest\API\BaseModel::getParentModel()
     */
    // public function getParentModel()
    // {
    // return 'Users';
    // }
    public function beforeValidationOnCreate()
    {
        $this->active = 1;
        $security = $this->getDI()->get('security');
        $this->password = $security->hash($this->password);
        $this->salt = substr(md5(rand()), 0, 45);
    }
}
