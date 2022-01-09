<?php
namespace Website\Item;

use Website\Core\AbstractModel;

class ItemModel extends AbstractModel
{
    public $id;
    public $title;
    public $description;
    public $price;
    public $negotiation;
    public $status;
    public $picture;
    public $user_id;

    public function short_description($value){
        $pos =  strpos($value, " ", 400);
        return substr($value, 0, $pos);
    } 
}

?>