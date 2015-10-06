<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 5/4/14
 * Time: 8:31 PM
 */
class UploadFile {
    var $domain;
    var $host;
    var $user;
    var $pass;
    var $folder;
    var $dataFolder;
    var $imageFolder;
    var $port;
    var $file;
    var $publiclink;
    var $supportOldVersion;

    var $CI;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('util');
        $this->supportOldVersion = true;
    }

    public function delete($fileName){
        if ($this->supportOldVersion) {
            $this->deleteFromOldCDN($fileName);
        }
        return $this->deleteFromCDN($fileName);
    }

    private function deleteFromCDN($fileName){
        try {
            list($this->domain, $this->host, $this->user, $this->pass, $this->dataFolder, $this->imageFolder, $this->port) = $this->CI->util->getAzureFTPInfo();

            $conn = $this->CI->util->connectFTPServer('azure');

            if($conn){
                if(!ftp_delete($conn, 'site/wwwroot'.$this->imageFolder.$fileName)){
                    $deleted = false;
                }else{
                    $deleted = true;
                }

                $this->CI->util->closeFTPConnection($conn);

                return $deleted;
            }

            return false;
        } catch (RuntimeException $e) {
            return false;
        }
    }

    private function deleteFromOldCDN($fileName){
        try {
            if ($fileName){
                return true;
            }

            list($this->domain, $this->host, $this->user, $this->pass, $this->folder, $this->publiclink) = $this->CI->util->getCuadroFTPInfo();

            $conn = $this->CI->util->connectFTPServer('cuadro');

            if($conn){
                $path = $this->publiclink.$this->folder.'/';

                ftp_delete($conn, $path.$fileName);

                $this->CI->util->closeFTPConnection($conn);
            }
        } catch (RuntimeException $e) {

        }
    }

    public function duplicate($fileName, $newFileName){
        try {
            $duplicated = false;
            list($this->domain, $this->host, $this->user, $this->pass, $this->dataFolder, $this->imageFolder, $this->port) = $this->CI->util->getAzureFTPInfo();
            // path to remote file
            $remote_file = $fileName;
            $local_file = $newFileName;

            $conn_id = $this->CI->util->connectFTPServer('azure');

            if ($conn_id) {
                $handle = fopen('ftp://'.$this->user.':'.$this->pass.'@'.$this->domain.$this->imageFolder.$this->local_file,"w");

                if (ftp_fget($conn_id, $handle, $this->publiclink.$this->folder.$remote_file, FTP_BINARY)) {
                    $duplicated = true;
                }

                fclose($handle);
                $this->CI->util->closeFTPConnection($conn_id);

                return $duplicated;
            }

            if ($this->supportOldVersion) {
                $this->duplicateOld($fileName, $newFileName);
            }

            return false;
        } catch (RuntimeException $e) {
            return false;
        }
    }

    private function duplicateOld($fileName, $newFileName){
        try {
            $duplicated = false;
            list($this->domain, $this->host, $this->user, $this->pass, $this->folder, $this->publiclink) = $this->CI->util->getCuadroFTPInfo();
            // path to remote file
            $remote_file = $fileName;
            $local_file = $newFileName;

            $conn_id = $this->CI->util->connectFTPServer('cuadro');

            if ($conn_id) {
                $handle = fopen('ftp://'.$this->user.':'.$this->pass.'@'.$this->domain.$this->publiclink.$this->folder.$this->local_file,"w");

                ftp_fget($conn_id, $handle, $this->publiclink.$this->folder.$remote_file, FTP_BINARY);

                fclose($handle);

                $this->CI->util->closeFTPConnection($conn_id);
            }

            return false;
        } catch (RuntimeException $e) {

        }
    }

    public function upload($file, $fileName='', $ext){
        try {
            // Undefined | Multiple Files | $_FILES Corruption Attack
            // If this request falls under any of them, treat it invalid.
            if (
                !isset($file['error']) ||
                is_array($file['error'])
            ) {
                throw new RuntimeException('Invalid parameters.');
            }

            // Check $file['error'] value.
            switch ($file['error']) {
                case UPLOAD_ERR_OK:
                    break;
                case UPLOAD_ERR_NO_FILE:
                    throw new RuntimeException('No file sent.');
                case UPLOAD_ERR_INI_SIZE:
                case UPLOAD_ERR_FORM_SIZE:
                    throw new RuntimeException('Exceeded filesize limit.');
                default:
                    throw new RuntimeException('Unknown errors.');
            }

            // You should also check filesize here.
            if ($file['size'] > config_item('max_file_size_for_upload')) {
                throw new RuntimeException('Exceeded filesize limit.');
            }

            if (!in_array($ext,config_item('allowedExts'))){
                throw new RuntimeException('Invalid file format.');
            }

            $fileName = strcmp($fileName,'') == 0 ? $file['tmp_name'] : $fileName;

            if(!empty($file['name'])){
                if ($this->PutFilesonFTPServer($fileName.".".$ext, $file['tmp_name'])){
//                    echo "File Uploaded Successfully";
                    if ($this->supportOldVersion) {
                        $this->PutFilesonFTPOldServer($fileName.".".$ext, $file['tmp_name']);
                    }
                    return true;
                } else {
//                    echo "Error while uploading of file";
                    return false;
                }
            } else {
//                echo "Please Select Any File to Upload";
                return false;
            }

        } catch (RuntimeException $e) {
//            echo $e->getMessage();
            return false;
        }
    }

    private function PutFilesonFTPServer($newfilename,$existingfilename){
        try {
            list($this->domain, $this->host, $this->user, $this->pass, $this->dataFolder, $this->imageFolder, $this->publiclink) = $this->CI->util->getAzureFTPInfo();

            $conn = $this->CI->util->connectFTPServer('azure');

            if($conn){
                @ftp_pasv($conn, true);
                if(!@ftp_put($conn, 'site/wwwroot'.$this->imageFolder.$newfilename, $existingfilename, FTP_BINARY)){
                    $uploaded = false;
                }else{
                    $uploaded = true;
                }

                $this->CI->util->closeFTPConnection($conn);

                return $uploaded;
            }

            return false;
        } catch (RuntimeException $e) {
            return false;
        }
    }

    private function PutFilesonFTPOldServer($newfilename,$existingfilename){
        try {
            list($this->domain, $this->host, $this->user, $this->pass, $this->folder, $this->publiclink) = $this->CI->util->getCuadroFTPInfo();

            $conn = $this->CI->util->connectFTPServer('cuadro');

            if($conn){
                $path = $this->folder;

                @ftp_chdir($conn, $path);
                @ftp_pasv($conn, true);

                @ftp_put($conn, $newfilename, $existingfilename, FTP_BINARY);

                $this->CI->util->closeFTPConnection($conn);
            }
            return true;
        } catch (RuntimeException $e) {

        }
    }
}
?>