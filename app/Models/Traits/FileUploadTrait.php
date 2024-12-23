<?php
namespace App\Models\Traits;

use App\Helpers\UploadHandler;
use AwsHelper;

Trait FileUploadTrait {

	public function uploadChunkFile($fieldName, $uploaderMines, $maxSizeMb, $chunkSize = 1){

		$options = [];
        $uploadDir = strtoupper(date('dMY'));

        $tempPath = 'storage/uploads/'.$uploadDir;
        $path = storage_path('uploads/'.$uploadDir).'/';
        $options['upload_dir'] = $path;
        $options['upload_url'] = url($tempPath).'/';
        $options['accept_file_types'] = '/\.('.$uploaderMines.')$/i';
        
        $options['readfile_chunk_size'] = $chunkSize * 1024 * 1024;
        $options['param_name'] = $fieldName;
        $options['max_file_size'] = $maxSizeMb * 1024 * 1024;

        $upldHandlerObj = new UploadHandler($options);
        if($upldHandlerObj->response && isset($upldHandlerObj->response[$fieldName]) && isset($upldHandlerObj->response[$fieldName][0])){
            $fresponse = $upldHandlerObj->response[$fieldName][0];
            if(isset($fresponse->url)){
                $ext = pathinfo($fresponse->url, PATHINFO_EXTENSION);
                $time = time();
                $filename = rand(111111, 999999).'_'.$time.'.'.$ext;
                rename($path.$fresponse->name,  $path.$filename);
                $response['name'] = $filename;
                $response['uploaded_filekey'] = $tempPath.'/'.$filename;
                $response['uploaded_fileurl'] = url($tempPath.'/'.$filename);
                return $response;
            }
        }

        return $upldHandlerObj->response;
	}
}