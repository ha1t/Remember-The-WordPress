<?php 
require 'qdmail.1.2.6b/qdmail.php';

/**
 * RtwMailクラス
 * remember_the_wordpressでメール送るクラスです。
 * カプセル化したかっただけなので再利用はあんまり考えていない。
 */

class RtwMail{

    public  $log_path;
    private $to, $from, $type;

    public function __construct($to, $from, $type = 'text') {
        $this->log_path  = 'mail.log';
        $this->to        = $this->_explodeTo($to);
        $this->from      = $from;
        $this->type      = $type; 
    }

    public function sendMail($subject, $body) {
        if($this->type = 'html') {
            $this->sendHtml($this->to, $subject, $body);
        }else{
            $this->sendText($this->to, $subject, $body);
        }
        $this->logMessage('Complete:Email execute');
    }

    private function _explodeTo($to) {
        if(preg_match('@/n@u', $to_email)) {
            return explode('/n', $to_email);
        }else{
            return $email;
        }
    }


    private function sendHtml($to, $subject, $body) {    
        $qd = new qdmail();
        
        if(count($this->to) > 1) {
            foreach($this->to as $to) {
                if($qd->easyHtml($to, $subject, $body)) {
                    $this->logMessage('Send Text Email: ' . $to);
                }else{
                    $this->logMessage('Fail Text Email: ' . $to);
                }
            }
        }else{
            if($qd->easyText($to, $subject, $body)) {
                $this->logMessage('Send Text Email: ' . $to);
            }else{
                $this->logMessage('Fail Text Email: ' . $to);
            }
        }
    }

    private function sendText($to, $subject, $body) {    
        $qd = new qdmail(); 
        
        if(count($this->to) > 1) {
            foreach($this->to as $to) {
                if($qd->easyText($to, $subject, $body)) {
                    $this->logMessage('Send Text Email: ' . $to);
                }else{
                    $this->logMessage('Fail Text Email: ' . $to);
                }
            }
        }else{
            if($qd->easyText($to, $subject, $body)) {
                $this->logMessage('Send Text Email: ' . $to);
            }else{
                $this->logMessage('Fail Text Email: ' . $to);
            }
        }
    }

    private function logMessage($message) {
        $dest = $this->log_path;
        if($this->log_mode) {
            error_log($message, 3, $dest);
            return;
        }
    }   
}
