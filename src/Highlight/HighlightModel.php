<?php
namespace Website\Highlight;

use Website\Core\AbstractModel;

class HighlightModel extends AbstractModel
{
    public $id;
    public $type;
    public $starttime;
    public $duration;
    public $item_id;
    public $user_id;

    public function endtime($starttime, $duration) 
    {
        return $starttime + $duration;
    } 

    public function active($endtime)
    {
        return $endtime > time();
    }
}

?>