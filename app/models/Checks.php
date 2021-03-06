<?php
namespace PhalconRest\Models;

class Checks extends \PhalconRest\API\BaseModel
{

    /**
     *
     * @var integer
     */
    public $id;

    /**
     *
     * @var integer
     */
    public $account_id;

    /**
     *
     * @var string
     */
    public $number;

    /**
     *
     * @var string
     */
    public $date;

    /**
     *
     * @var string
     */
    public $account_number;

    /**
     *
     * @var string
     */
    public $routing_number;

    /**
     *
     * @var string
     */
    public $name_on_check;

    /**
     * (non-PHPdoc)
     *
     * @see \PhalconRest\API\BaseModel::initialize()
     */
    public function initialize()
    {
        parent::initialize();
        $this->belongsTo("account_id", "PhalconRest\\Models\\Accounts", "id", array(
            'alias' => 'Accounts'
        ));

        // written as a has one because the api wants to save the parent but that's not how ember works
        $this->hasMany("id", "PhalconRest\\Models\\Payments", "check_id", array(
            'alias' => 'Payments'
        ));
    }
}
