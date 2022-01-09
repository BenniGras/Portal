<?php
namespace Website\Picture;

use PDO;
use Website\Core\AbstractRepository;

class PictureRepository extends AbstractRepository
{
    public function getTableName()
    {
        return "pictures";
    }

    public function getModelName()
    {
        return "Website\\Picture\\PictureModel";
    }

    // saves pictures in folder, adds picturename to database
    public function uploadPicture($files, $item_id)
    {
        $total = count($files['pictures']['name']);
        
        for ($i=0; $i < $total; $i++) {

            //Create Filename
            $fileExt = explode('.', $files['pictures']['name'][$i]);
            $fileActualExt = strtolower(end($fileExt));
            $filename = uniqid('', true).".".$fileActualExt;
            
             // moves from temporary location to folder
             move_uploaded_file($files['pictures']['tmp_name'][$i], "../pictures/".$filename);

             // adds assignment to database
             $table = $this->getTableName();
             
             $stmt = $this->pdo->prepare("INSERT INTO `$table`
             (`name`, `item_id`) VALUES (:name, :item_id)"
             );
 
             $stmt->execute([
                 'name' => $filename,
                 'item_id' => $item_id,
             ]);
        }
        
    }

    // gets pictures by item_id
    public function getPictures($item_id)
    {
        $table = $this->getTableName();
        $model = $this->getModelName();

        $stmt = $this->pdo->prepare(
            "SELECT * FROM `$table` 
            WHERE item_id = :item_id");
        $stmt->execute([
            'item_id' => $item_id,
        ]);

        $pictures = $stmt->fetchAll(PDO::FETCH_CLASS, $model);
        return($pictures);
    }
}
?>