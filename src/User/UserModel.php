<?php
namespace Website\User;

use Website\Core\AbstractModel;

class UserModel extends AbstractModel
{
    public $id;
    public $email;
    public $firstname;
    public $surname;
    public $companyname;
    public $street;
    public $number;
    public $zipcode;
    public $city;
    public $password;
    public $customer_prefix;
    public $customer_phone;
    public $customer_email;
}
?>