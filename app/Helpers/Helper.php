<?php

namespace App\Helpers;

class Helper
{
    public static function IDGenerator($model, $trow, $length = 4, $prefix)
    {
       $data = $model::orderBy('id', 'desc')->first();
       if(!$data){
           $og_length = $length;
           $last_number = '';
       }else{
           $code = substr($data->$trow, strlen($prefix)+1);
           $actial_last_number = ($code/1) * 1;
           $increment_last_number = $actial_last_number+1;
           $last_number_length = strlen($increment_last_number);
           $og_length = $length - $last_number_length;
           $last_number = $increment_last_number;
       }
        $zero = "";
       for($i=0;$i<$og_length;$i++){
           $zero.="0";
       }
       return $prefix.'-'.$zero.$last_number;
    }

    public static function CreateFile($path, $file, $prefix){
        $fileName = $prefix.'-'. time() . '.' . $file->extension();
        $file->move(public_path($path), $fileName);
        return $path. $fileName;
    }
}
?>
