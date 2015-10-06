<?php
/**
 * Convert a PHP array into CSV
 *
 * @author Amalesh Debnath <amalesh.debnath@gmail.com> || http://amalesh.net
 *
 */
class ArrayToCsv{
    var $domain;
    var $host;
    var $user;
    var $pass;
    var $dataFolder;
    var $imageFolder;
    var $port;
    var $file;

    var $CI;

    function __construct() {
        $this->CI = & get_instance();
        $this->CI->load->library('util');

        list($this->domain, $this->host, $this->user, $this->pass, $this->dataFolder, $this->imageFolder, $this->port) = $this->CI->util->getAzureFTPInfo();
    }

    public function createCSVFileWithTitle($titles, $fileName, $records){
        try {
            $conn_id = $this->CI->util->connectFTPServer('azure');
//            var_dump($conn_id);

            if ($conn_id) {
                $ftpOpenString = $this->host.'/site/wwwroot'.$this->dataFolder.$fileName.".csv";

                $stream_options = array('ftp' => array('overwrite' => true));
                $stream_context = stream_context_create($stream_options);

                $file = fopen('ftp://'.$this->user.':'.$this->pass.'@'.$ftpOpenString,"w", 0, $stream_context);
                if (!fputcsv($file, $titles)){
                    fclose($file);
                    $this->CI->util->closeFTPConnection($conn_id);
                    return false;
                }

                foreach($records AS $record){
                    $line = '';
                    $index = 0;
                    foreach($record AS $key => $value){
                        $line[$index] = $value;
                        $index++;
                    }
                    if (!fputcsv($file, $line)){
                        return false;
                    }
                }

                fclose($file);

                $this->CI->util->closeFTPConnection($conn_id);

                return true;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Error: <br>";
            $this->CI->util->echoObject($e);
            return false;
        } catch (ErrorException $e) {
            echo "Error: <br>";
            $this->CI->util->echoObject($e);
            return false;
        }
    }

    public function isFileExist($fileName){
        try {
            $conn_id = $this->CI->util->connectFTPServer('azure');
            if ($conn_id) {
                $file = $this->dataFolder.$fileName.'.csv';

                $res = ftp_size($conn_id, $file);

                $this->CI->util->closeFTPConnection($conn_id);

                return $res != -1;
            } else {
                return false;
            }
        } catch (Exception $e) {
            echo "Error: <br>";
            $this->CI->util->echoObject($e);
            return false;
        } catch (ErrorException $e) {
            echo "Error: <br>";
            $this->CI->util->echoObject($e);
            return false;
        }
    }
}