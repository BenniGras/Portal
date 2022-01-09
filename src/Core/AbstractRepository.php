<?php
namespace Website\Core;

use PDO;

abstract class AbstractRepository
{
    protected $pdo;

    public function __construct (PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    abstract public function getTableName();

    abstract public function getModelName();

    // gets all items
    function all()
    {
        $table = $this->getTableName();
        $model = $this->getModelName();

        $stmt = $this->pdo->query("SELECT * FROM `$table`");

        $items = $stmt->fetchAll(PDO::FETCH_CLASS, $model);
        return($items);
    }

    // gets item by id
    function find($id)
    {
        $table = $this->getTableName();
        $model = $this->getModelName();

        $stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE id = :id");
        $stmt->execute(['id' => $id]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, $model);
        $item = $stmt->fetch(PDO::FETCH_CLASS);

        return $item;
    }
}
?>