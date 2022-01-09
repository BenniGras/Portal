<?php
namespace Website\CrossSelling;

use PDO;
use Website\Core\AbstractRepository;

class CrossSellingRepository extends AbstractRepository
{
    public function getTableName()
    {
        return "cross_selling";
    }

    public function getModelName()
    {
        return "Website\\CrossSelling\\CrossSellingModel";
    }

    public function getData($type, $duration)
    {
        $table = $this->getTableName();
        $model = $this->getModelName();

        $stmt = $this->pdo->prepare("SELECT * FROM `$table` WHERE s_type = :type AND s_duration = :duration");
        $stmt->execute([
            'type' => $type,
            'duration' => $duration,
        ]);

        $stmt->setFetchMode(PDO::FETCH_CLASS, $model);
        $item = $stmt->fetch(PDO::FETCH_CLASS);

        return $item;
    }
}
?>