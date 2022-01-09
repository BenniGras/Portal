<?php
namespace Website\Highlight;

use PDO;
use Website\Core\AbstractRepository;

class HighlightRepository extends AbstractRepository
{
    public function getTableName()
    {
        return "highlight";
    }

    public function getModelName()
    {
        return "Website\\Highlight\\HighlightModel";
    }

    // adds highlight to database
    public function insertHighlight($post, $id)
    {
        $table = $this->getTableName();
        
        $stmt = $this->pdo->prepare("INSERT INTO `$table`
        (`type`, `starttime`, `duration`, `item_id`, `user_id`) VALUES (:type, :starttime, :duration, :item_id, :user_id)"
        );

        $stmt->execute([
            'type' => $post["type"],
            'starttime' => time(),
            'duration' => $post["duration"],
            'item_id' => $id,
            'user_id' => $_SESSION["id"],
        ]);
    }

    // gets highlight by item_id
    public function getItemHighlight($item_id)
    {
        $table = $this->getTableName();
        $model = $this->getModelName();

        $stmt = $this->pdo->prepare("SELECT * FROM `{$table}` WHERE item_id = :item_id");
        $stmt->execute(['item_id' => $item_id]);

        $highlights = $stmt->fetchAll(PDO::FETCH_CLASS, $model);

        foreach($highlights AS $highlight) {
            $endtime = $highlight->endtime($highlight['starttime'], $highlight['duration']);
            if($highlight->active($endtime)){
                return $highlight;
            }
        }

        return false;
    }
}
?>