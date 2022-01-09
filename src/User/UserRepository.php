<?php
namespace Website\User;

use PDO;
use Website\Core\AbstractRepository;

class UserRepository extends AbstractRepository
{
    public function getTableName()
    {
        return "user";
    }

    public function getModelName()
    {
        return "Website\\User\\UserModel";
    }
    
    // adds user to database
    public function insertUser($post)
    {
        $table= $this->getTableName();

        $stmt = $this->pdo->prepare("INSERT INTO `{$table}`
        (`email`, `firstname`, `surname`, `zipcode`, `city`, `password`, `customer_prefix`, `customer_phone`, `customer_email`)
        VALUES (:email, :firstname, :surname, :zipcode, :city, :password, :customer_prefix, :customer_phone, :customer_email)"
        );

        $stmt->execute([
            'email' => $post["email"],
            'firstname' => $post["firstname"],
            'surname' => $post["surname"],
            'zipcode' => $post["zipcode"],
            'city' => $post["city"],
            'password' => password_hash($post["password_1"], PASSWORD_DEFAULT),
            'customer_prefix' => $post["customer_prefix"],
            'customer_phone' => $post["customer_phone"],
            'customer_email' => $post["customer_email"],
        ]);
    }

    // adds dealer to database
    public function insertDealer($post)
    {
        $table= $this->getTableName();

        $stmt = $this->pdo->prepare("INSERT INTO `$table`
        (`email`, `companyname`, `street`, `number`, `zipcode`, `city`, `password`, `customer_prefix`, `customer_phone`, `customer_email`)
        VALUES (:email, :companyname, :street, :number, :zipcode, :city, :password, :customer_prefix, :customer_phone, :customer_email)"
        );

        $stmt->execute([
            'email' => $post["email"],
            'companyname' => $post["companyname"],
            'street' => $post["street"],
            'number' => $post["number"],
            'zipcode' => $post["zipcode"],
            'city' => $post["city"],
            'password' => password_hash($post["password_1"], PASSWORD_DEFAULT),
            'customer_prefix' => $post["customer_prefix"],
            'customer_phone' => $post["customer_phone"],
            'customer_email' => $post["customer_email"],
        ]);
    }
  
    // updates password of user
    public function updatePassword(UserModel $model)
    {
        $table = $this->getTableName();
        $stmt = $this->pdo->prepare("UPDATE `{$table}` SET `password` = :password WHERE `id` = :id");
        $stmt->execute([
            'password' => $model->password,
            'id' => $_SESSION['id']
        ]);
    }

    // updates data of user
    public function updateUser(UserModel $model)
    {
        $table = $this->getTableName();

        if($model->companyname){
            $stmt = $this->pdo->prepare("UPDATE `{$table}` SET 
            `email` = :email, `companyname` = :companyname, `street` = :street, `number` = :number, `zipcode` = :zipcode, `city` = :city,
            `customer_prefix` = :customer_prefix, `customer_phone` = :customer_phone, `customer_email` = :customer_email WHERE `id` = :id");

            $stmt->execute([
                'email' => $model->email,
                'companyname' => $model->companyname,
                'street' => $model->street,
                'number' => $model->number,
                'zipcode' => $model->zipcode,
                'city' => $model->city,
                'customer_prefix' => $model->customer_prefix,
                'customer_phone' => $model->customer_phone,
                'customer_email' => $model->customer_email,
                'id' => $_SESSION['id']
            ]);
        }else{
            $stmt = $this->pdo->prepare("UPDATE `{$table}` SET 
            `email`=:email,`firstname`=:firstname,`surname`=:surname,`street`=:street,`number`=:number,`zipcode`=:zipcode,`city`=:city,
            `customer_prefix`=:customer_prefix,`customer_phone`=:customer_phone,`customer_email`=:customer_email WHERE `id`=:id");

            $stmt->execute([
                'email' => $model->email,
                'firstname' => $model->firstname,
                'surname' => $model->surname,
                'street' => $model->street,
                'number' => $model->number,
                'zipcode' => $model->zipcode,
                'city' => $model->city,
                'customer_prefix' => $model->customer_prefix,
                'customer_phone' => $model->customer_phone,
                'customer_email' => $model->customer_email,
                'id' => $_SESSION['id']
            ]);
        }
    }

    // gets user by email
    public function findByEmail($email)
    {
        $table = $this->getTableName();
        $model = $this->getModelName();

        $stmt = $this->pdo->prepare("SELECT * FROM `{$table}` WHERE email = :email");
        $stmt->execute(['email' => $email]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, $model);
        $user = $stmt->fetch(PDO::FETCH_CLASS);

        return $user;
    }
   
}
?>