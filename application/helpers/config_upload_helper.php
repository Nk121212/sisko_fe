<?php
    function configUpload($filename, $dir){
        
        $config['upload_path'] = $dir;
        $config['allowed_types'] = 'gif|jpg|png';
        $config['file_name'] = $filename;
        $config['max_size']     = '100';
        $config['max_width'] = '1024';
        $config['max_height'] = '768';
        $config['overwrite'] = true;

        return $config;
    }
?>