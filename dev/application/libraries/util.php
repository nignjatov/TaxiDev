<?php
/**
 * Created by PhpStorm.
 * User: amalesh
 * Date: 5/4/14
 * Time: 8:31 PM
 */
class Util {
    public function getCurrentDate($separator=''){
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $cDate = empty($separator) ? $year . '' . $month . '' . $day : $year . $separator . $month . $separator . $day;
        return $cDate;
    }

    public function getCurrentDateTime($dateSeparator='', $timeSeparator=''){
        $year = date('Y');
        $month = date('m');
        $day = date('d');
        $hour = date('H');
        $minute = date('i');
        $second = date('s');

        $ccDate = empty($dateSeparator) ? $year . '' . $month . '' . $day : $year . $dateSeparator . $month . $dateSeparator . $day;
        $ccTime = empty($timeSeparator) ? $hour . ':' . $minute . ':' . $second : $hour . $timeSeparator . $minute . $timeSeparator . $second;
        //$cDate->date = $ccDate.' '.$ccTime;
        return $ccDate .' '. $ccTime;
    }

    public function convertDateToServerDateTime($date, $separator){
        $temp = explode(' ',$date);
        $temp1 = explode($separator, $temp[0]);
        $dateValue = $temp1[2].$temp1[0].$temp1[1];
        return $dateValue.' '.$temp[1].':00';
    }

    public function convertMKTimeToDate($value, $dateOnly = true, $dateSeparator = '/'){
        $day = date("d", $value);
        $month = date("m", $value);
        $year = date("Y", $value);
        $hour = date("H", $value);
        $minute = date("i", $value);
        $second = date("s", $value);
        return $dateOnly ? $month.$dateSeparator.$day.$dateSeparator.$year : $month.$dateSeparator.$day.$dateSeparator.$year.' '.$hour.':'.$minute.':'.$second;
    }

    public function convertTimeToInt($time){
        if (is_numeric($time)){
            return 0;
        }
        $timeValues = explode(':', $time);
        return $timeValues[0] * 3600 + $timeValues[1] * 60 + $timeValues[2];
    }

    public function convertIntToTime($value){
        $hour = intval($value / 3600);
        $minute = intval(($value - ($hour * 3600)) / 60);
        $second = ($value - ($hour * 3600) - ($minute * 60));
        return sprintf("%02d:%02d:%02d", $hour, $minute, $second);
    }

    public function convertInToHourMin($value){
        $hour = intval($value / 3600);
        $minute = intval(($value - ($hour * 3600)) / 60);
        return sprintf("%02d Hour %02d Minute", $hour, $minute);
    }

    public function convertDateToServerDate($date, $separator){
        $temp = explode($separator,$date);
        return $temp[2].$temp[0].$temp[1];
    }

    public function convertToUTF8($data){
        $records = array();
        foreach($data AS $key => $value){
            $records[$key] = iconv("UTF-8", "ISO-8859-1//IGNORE", $value);
        }
        return $records;
    }

    public function generateRandomString() {
        $length = rand(6,10);
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }

    public function getStandardDeviation(array $a, $sample = false) {
        $n = count($a);
        if ($n === 0) {
            trigger_error("The array has zero elements", E_USER_WARNING);
            return false;
        }
        if ($sample && $n === 1) {
            trigger_error("The array has only 1 element", E_USER_WARNING);
            return false;
        }
        $mean = array_sum($a) / $n;
        $carry = 0.0;
        foreach ($a as $val) {
            $d = ((double) $val) - $mean;
            $carry += $d * $d;
        };
        if ($sample) {
            --$n;
        }
        return sprintf("%01.5f", sqrt($carry / $n));
    }

    public function getMeanValue(array $a, $sample = false) {
        $n = count($a);
        if ($n === 0) {
            trigger_error("The array has zero elements", E_USER_WARNING);
            return false;
        }
        if ($sample && $n === 1) {
            trigger_error("The array has only 1 element", E_USER_WARNING);
            return false;
        }

        return sprintf("%01.5f", array_sum($a) / $n);
    }

    public function echoObject($object, $fileWrite = false){
        if ($fileWrite) {
            $fileName = 'logs.txt';
            $file = fopen($fileName,"a+");
            $logString = date("Y-m-d H:i:s "). json_encode($object);
            fwrite($file, $logString);
            fclose($file);
        }
        echo '<pre>';
        print_r($object);
        echo '</pre>';
    }

    public function getPercentage($values){
        $total = 0;
        $count = 0;
        $valuePercentage = array();
        foreach($values AS $value){
            if (is_nan($value)){
                $total = 0;
                break;
            }
            $total += $value;
            $valuePercentage[$count++]["value"] = $value;
        }

        if ($total == 0) return $valuePercentage;

        $count = 0;
        foreach ($values AS $value) {
            $percentage = ($value / $total) * 100;
            $valuePercentage[$count++]["percentage"] = sprintf("%1\$.2f", $percentage);
        }

        return $valuePercentage;
    }

    public function getForceUpdateError(){
        $return = array();
        $return['error']['code'] = '-1';
        $return['error']['msg'] = 'We are sorry but in order to continue to use the RealLife Exp app you will need to update to the most recent version for compatibility reasons. Please click “Update” below and you can update the app from the App Store.';
        $return["error"]["titleText"] = "App Update Required";
        $return["error"]["buttonText"] = "Update";
        $return["error"]["appURL"] = "https://itunes.apple.com/us/app/reallife-exp/id939951918?ls=1&mt=8";
        echo json_encode($return);
    }

    public function getAzureFTPInfo(){
        $domain = config_item('ftp_information_domainname');
        $host = config_item('ftp_information_domainhost');
        $user = config_item('ftp_information_domainuser');
        $pass = config_item('ftp_information_domainpass');
        $dataFolder = config_item('ftp_information_dataFileDirectory');
        $imageFolder = config_item('ftp_information_imageFileDirectory');
        $port = config_item('ftp_information_port');
        return array($domain, $host, $user, $pass, $dataFolder, $imageFolder, $port);
    }

    public function getCuadroFTPInfo(){
        $domain = config_item('domainname');
        $host = config_item('domainhost');
        $user = config_item('domainuser');
        $pass = config_item('domainpass');
        $folder = '/public_html/lifedata/images/';
        $publiclink = config_item('publiclink');
        return array($domain, $host, $user, $pass, $folder, $publiclink);
    }

    public function connectFTPServer($server) {
        switch ($server) {
            case 'azure':
                list($domain, $host, $user, $pass, $dataFolder, $imageFolder, $port) = $this->getAzureFTPInfo();
                break;
            case 'cuadro':
                list($domain, $host, $user, $pass, $folder, $publiclink) = $this->getCuadroFTPInfo();
                break;
            default:
                break;
        }

        $conn_id = ftp_connect($host);
        if ($conn_id){
            $login_result = ftp_login($conn_id, $user, $pass);

            ftp_set_option($conn_id, FTP_TIMEOUT_SEC, config_item('set_time_out'));

            if($login_result){
                return $conn_id;
            }else{
                $this->closeFTPConnection($conn_id);
                return false;
            }
        }
    }

    public function closeFTPConnection($conn_id){
//        ftp_quit($conn_id);
        ftp_close($conn_id);
    }

    public function uploadFileToServer($fileName, $pdf_content){
        try {
            $file_path = FCPATH.'invoices/'.$fileName.'.pdf';
            $file = fopen($file_path, 'w');
            fwrite($file, $pdf_content);
            fclose($file);
        }  catch (Exception $e) {
            echo "Error: <br>";
            $this->util->echoObject($e);
            return false;
        } catch (ErrorException $e) {
            echo "Error: <br>";
            $this->util->echoObject($e);
            return false;
        }
    }

    public function sendSuccessEmail($email_from, $email_to, $email_subject, $email_body, $file_path = ''){
        try {
            $CI =& get_instance();

            $CI->load->library('email');
            $CI->email->clear(TRUE);

            $CI->email->initialize(array(
                'priority' => 1,
                'mailtype' => 'html',
                'charset' => 'iso-8859-1',
                'newline' => '\r\n',
                'crlf' => '\n'
            ));
            $CI->email->from($email_from);
            $CI->email->to($email_to);
            $CI->email->subject($email_subject);
            $CI->email->message($email_body);
            if (!empty($file_path)) {
                $file_path = FCPATH.$file_path;
                $CI->email->attach($file_path);
            }
            $CI->email->send();
        }  catch (Exception $e) {
            echo "Error: <br>";
            $this->util->echoObject($e);
            return false;
        } catch (ErrorException $e) {
            echo "Error: <br>";
            $this->util->echoObject($e);
            return false;
        }
    }

    public function makeInvoicePDFContent($userDetail, $subscriptionInfo, $invoice, $order_no, $last4, $discount = 0){
        try {
            $CI =& get_instance();
            $data = array();
            $data['invoice_id'] = $order_no;
            $data['first_name'] = $userDetail->first_name;
            $data['last_name'] = $userDetail->last_name;
            $data['start_date'] = date("F d, Y", $subscriptionInfo->current_period_start);
            $data['end_date'] = date("F d, Y", $subscriptionInfo->current_period_end);
            $data['plan'] = $subscriptionInfo->plan->name;
            $data['amount'] = sprintf("%.2f", $subscriptionInfo->plan->amount / 100);
            $data['discount'] = sprintf("%.2f", $discount / 100);

            $data['total_amount'] = sprintf("%.2f", ($subscriptionInfo->plan->amount - $discount) / 100);
            $data['last4'] = $last4;
            $emailBody = $CI->load->view('subscription/invoiceTemplate', $data, true);
//        echo 'makeInvoicePDFContent End';

            return $emailBody;
        }  catch (Exception $e) {
            echo "Error: <br>";
            $this->util->echoObject($e);
            return false;
        } catch (ErrorException $e) {
            echo "Error: <br>";
            $this->util->echoObject($e);
            return false;
        }
    }

    public function makeSuccessEmailBody($first_name, $last_name, $plan, $user_email, $order_no){
        $CI =& get_instance();
        $data = array();
        $data['first_name'] = $first_name;
        $data['last_name'] = $last_name;
        $data['plan'] = $plan;
        $data['user_email'] = $user_email;
        $data['invoice_id'] = $order_no;
        $emailBody = $CI->load->view('subscription/subscribeEmailTemplate', $data, true);

        return $emailBody;
    }

    public function getEncryptedFileName($key){
        return md5(config_item('invoice_encryption_key') . $key);
    }
}
?>