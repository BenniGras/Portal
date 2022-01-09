<?php
namespace Website\Item;

use PDO;
use Website\Core\AbstractRepository;

class ItemRepository extends AbstractRepository
{
    public function getTableName()
    {
        return "items";
    }

    public function getModelName()
    {
        return "Website\\Item\\ItemModel";
    }

    // adds item to database, returns item id
    public function insertItem($post)
    {
        $table = $this->getTableName();

        if(!isset($post['negotiation'])) {
            $post['negotiation'] = "nein";
        }

        $stmt = $this->pdo->prepare("INSERT INTO `$table`
        (`title`, `description`, `price`, `negotiation`, `status`, `user_id`)
        VALUES (:title, :description, :price, :negotiation, :status, :user_id)"
        );

        $stmt->execute([
            'title' => $post["title"],
            'description' => $post["description"],
            'price' => $post["price"],
            'negotiation' => $post["negotiation"],
            'status' => $post["status"],
            'user_id' => $_SESSION['id'],
        ]);

        return $this->pdo->lastInsertId();
    }

    // updates data of item
    public function updateItem(ItemModel $model)
    {
        $table = $this->getTableName();
        
        $stmt = $this->pdo->prepare("UPDATE `{$table}` SET 
        `title` = :title, `description` = :description, `price` = :price, `negotiation` = :negotiation, `status` = :status, `pictures` = :pictures, WHERE `id` = :id");

        $stmt->execute([
            'title' => $model->title,
            'description' => $model->description,
            'price' => $model->price,
            'negotiation' => $model->negotiation,
            'status' => $model->status,
            'pictures' => $model->pictures,
            'id' => $model->id
        ]);
    }

    // gets item by item_id
    public function getItemById($item_id)
    {
        $table = $this->getTableName();
        $table2 = "pictures";
        $model = $this->getModelName();

        $stmt = $this->pdo->prepare(
        "SELECT *,
        (SELECT `$table2`.name FROM `$table2` WHERE `$table`.id = `$table2`.item_id LIMIT 1)AS picture
        FROM `$table` WHERE id = :id");
        $stmt->execute(['id' => $item_id]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, $model);
        $item = $stmt->fetch(PDO::FETCH_CLASS);
        
        return $item; 
    }

    // gets all items by user_id
    public function allItemsByUser($user_id)
    {
        $table = $this->getTableName();
        $table2 = "pictures";
        $model = $this->getModelName();

        $stmt = $this->pdo->prepare(
        "SELECT *, 
        (SELECT `$table2`.name FROM `$table2` WHERE `$table`.id = `$table2`.item_id LIMIT 1)AS picture 
        FROM `$table` WHERE user_id = :user_id");
        $stmt->execute(['user_id' => $user_id]);

        $items = $stmt->fetchAll(PDO::FETCH_CLASS, $model);
        return($items);
        
    }

    public function getWishlist($user_id)
    {
        $table = $this->getTableName();
        $table2 = "pictures";
        $table3 = "user";
        $table4 = "wishlist";
        $model = $this->getModelName();

        $stmt = $this->pdo->prepare(
            "SELECT *,
            (SELECT `$table2`.name FROM `$table2` WHERE `$table`.id = `$table2`.item_id LIMIT 1)AS picture,
            (SELECT `$table3`.companyname FROM `$table3` WHERE `$table`.user_id = user.id)AS companyname,
            (SELECT `$table3`.city FROM `$table3` WHERE `$table`.user_id = user.id)AS city
            FROM `$table` 
            LEFT JOIN `$table4` ON `$table4`.item_id = `$table`.id 
            WHERE `$table4`.user_id = :user_id ");
        $stmt->execute([
            'user_id' => $user_id,
        ]);

        $items = $stmt->fetchAll(PDO::FETCH_CLASS, $model);
        return($items);
    }

    // gets all items by serach
    public function searchByFilter($get)
    {
        $table = $this->getTableName();
        $table2 = "pictures";
        $table3 = "user";
        $model = $this->getModelName();

        $pre = "SELECT id, title, description, price, negotiation, status,
        (SELECT `$table2`.name FROM `$table2` WHERE `$table`.id = `$table2`.item_id LIMIT 1)AS picture,
        (SELECT `$table3`.companyname FROM `$table3` WHERE `$table`.user_id = user.id)AS companyname,
        (SELECT `$table3`.city FROM `$table3` WHERE `$table`.user_id = user.id)AS city
        FROM `$table`";
        $condition = [];
        $array = [];

        if($get){
            if($get['category'] AND $get['category'] !== "beliebig" AND $get['category'] !== "---"){
                $condition[] = " `category` = :category";
                $array['category'] = $get['category'];
            }

            if($get['price'] AND $get['price'] !== "beliebig"){
                $condition[] = " `price` <= :price";
                $array['price'] = $get['price'];
            }

            /* if($get['city'] AND $get['city'] !== "beliebig"){
                $condition[] = " `city` = :city";
                $array['city'] = $get['city'];
            } */

            if($get['brand'] AND $get['brand'] !== "beliebig" AND $get['brand'] !== "---"){
                $condition[] = " `brand` = :brand";
                $array['brand'] = $get['brand'];
            }

            if($get['model'] AND $get['model'] !== "beliebig" AND $get['model'] !== "---"){
                $condition[] = " `model` = :model";
                $array['model'] = $get['model'];
            }

            if ($condition) {
                $pre = $pre." WHERE";
                $con = implode(" AND ", $condition);
                $pre = $pre.$con;
            }
        }
        $stmt = $this->pdo->prepare($pre);
        $stmt->execute($array);

        $items = $stmt->fetchAll(PDO::FETCH_CLASS, $model);
        return($items);
    }

    public function getItemsforPreview()
    {
        $table = $this->getTableName();
        $table2 = "pictures";
        $table3 = "user";
        $model = $this->getModelName();

        $stmt = $this->pdo->query(
        "SELECT id, title, description, price, negotiation, status,
        (SELECT `$table2`.name FROM `$table2` WHERE `$table`.id = `$table2`.item_id LIMIT 1)AS picture,
        (SELECT `$table3`.companyname FROM `$table3` WHERE `$table`.user_id = user.id)AS companyname,
        (SELECT `$table3`.city FROM `$table3` WHERE `$table`.user_id = user.id)AS city
        FROM `$table`");

        $items = $stmt->fetchAll(PDO::FETCH_CLASS, $model);
        return($items);
    }
}
?>