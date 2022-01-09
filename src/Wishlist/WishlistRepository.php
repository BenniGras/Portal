<?php
namespace Website\Wishlist;

use PDO;
use Website\Core\AbstractRepository;

class WishlistRepository extends AbstractRepository
{
    public function getTableName()
    {
        return "wishlist";
    }

    public function getModelName()
    {
        return "Website\\Wishlist\\WishlistModel";
    }

    public function addWishlist($item_id, $user_id)
    {
        $table= $this->getTableName();

        $stmt = $this->pdo->prepare("INSERT INTO `{$table}`
        (`item_id`, `user_id`) VALUES (:item_id, :user_id)");

        $stmt->execute([
            'item_id' => $item_id,
            'user_id' => $user_id,
        ]);
    }

    public function getWishlistItem($item_id, $user_id)
    {
        $table = $this->getTableName();
        $model = $this->getModelName();

        $stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE item_id = :item_id AND user_id = :user_id");
        $stmt->execute([
            'user_id' => $user_id,
            'item_id' => $item_id,
        ]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, $model);
        $wishlist = $stmt->fetch(PDO::FETCH_CLASS);

        return $wishlist;
    }

    public function deleteWishlist($item_id, $user_id)
    {
        $table= $this->getTableName();

        $stmt = $this->pdo->prepare("DELETE FROM `{$table}` WHERE item_id = :item_id AND user_id = :user_id");

        $stmt->execute([
            'item_id' => $item_id,
            'user_id' => $user_id,
        ]);
    }
}
?>