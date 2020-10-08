<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recursive extends Model
{
    //
    private $htmlSelect;

    public function __construct()
    {
        # code...
        $this->htmlSelect = '';
    }
    public function categoryRecursive($id, $text='')
    {
        # code...
        $data = Category::all();
        foreach ($data as $value) {
            if($value['parent_id']==$id){
                $this->htmlSelect .= "<option value='".$value['id']."'>".$text.$value['name']."</option>";

                $this->categoryRecursive($value['id'], $text.'&#9866;');
            }
        }
        return $this->htmlSelect;
    }
}

