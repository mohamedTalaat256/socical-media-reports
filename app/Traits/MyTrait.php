<?php
namespace App\Traits;


Trait MyTrait{

    function saveImage($photo, $name,$folder){
        $file_extension = $photo->getClientOriginalExtension();
        $file_name = $name.'.'.$file_extension;
        $path = $folder;
        $photo -> move($path,$file_name);

        return $file_name;
    }
}
?>
