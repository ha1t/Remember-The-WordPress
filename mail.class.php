<?php 
/**
 * Mailクラス
 *
 * [Notice]
 * $toには、配列または改行区切り、1件のメールアドレスを与えてください
 */

class Mail{
    private $mail_type, $to_email, $subject, $body, $from;
    public  $log_mode, $log_path;

    public function __construct($to, $from, $subject, $body, $mail_type) {
        $this->subject   = $subject;
        $this->body      = $body;  
        $this->to_email  = _explode_email($to);
        $this->mail_type = $mail_type;
        $this->from      = $from;

        $this->log_mode  = FALSE;
        $this->log_path  = 'mail.log';
    }

    public function sendmail() {
        $this->_send_mail_html($this->to_email, $this->subject, $this->body);
        $this-log_message('Completed:Send HTML mail');
    }

    private function _explode_email($to_email) {
        if(preg_match('@/n@u', $to_email)) {
            return explode('/n', $to_email);
        }else{
            return $email;
        }
    }

    private function send_mail() {
        if(count($this->to_email) > 1) {
            foreach($this->to_email as $to) {
                if(wp_mail($to, $this->subject, $this->message)) {
                    log_message('Send Email: ' . $to);
                }else{
                    log_message('Fail Email: ' . $to);
                }
            }
        
        }else{
            
            if(wp_mail($to, $this->subject, $this->message)) {
                log_message('Send Email: ' . $to);
            }else{
                log_message('Fail Email: ' . $to);
            }
        }
    }

    private function log_message($message) {
        $dest = $this->log_path;
        if($this->log_mode) {
            error_log($message, 3, $dest);
            return;
        }
    }   
}
