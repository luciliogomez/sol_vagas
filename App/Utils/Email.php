<?php
namespace App\Utils;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception as PHPMailerException;

class Email{

    const HOST = 'smtp.gmail.com';
    const USER = 'geral.solvagas@gmail.com';
    const PASS = '1A2E3I4O5U#';
    const SECURE= PHPMailer::ENCRYPTION_STARTTLS;
    const PORT = 587;
    const CHARSET = 'UTF-8';

    const FROM_EMAIL = 'geral.solvagas@gmail.com';
    const FROM_NAME  = 'SOLVAGAS';

    public $error;


    public function getError()
    {
        return $this->error;
    }

    public function sendEmail($addresses,$subject,$body,$attachments = [],$ccs = [], $bccs = [])
    {
        $this->error = '';

        $obMail = new PHPMailer(true);
        try{
            // CREDENCIAIS DE ACESSO AO SMTP
            $obMail->isSMTP(true);
            $obMail->Host = self::HOST;
            $obMail->SMTPAuth = true;
            $obMail->Username = self::USER;
            $obMail->Password = self::PASS;
            $obMail->SMTPSecure = self::SECURE;
            $obMail->Port = self::PORT;
            $obMail->CharSet = self::CHARSET;

            // REMETENTE
            $obMail->setFrom(self::FROM_EMAIL,self::FROM_NAME);

            // DESTINATARIO
            $addresses = is_array($addresses)? $addresses : [$addresses];
            foreach($addresses as $address){
                $obMail->addAddress($address);
            }
            // ANEXOS
            $attachments = is_array($attachments)? $attachments : [$attachments];
            foreach($attachments as $attachment){
                $obMail->addAttachment($attachment);
            }
            // CCS
            $ccs = is_array($ccs)? $ccs : [$ccs];
            foreach($ccs as $cc){
                $obMail->addCC($cc);
            }

            // BCC
            $bccs = is_array($bccs)? $bccs : [$bccs];
            foreach($bccs as $bcc){
                $obMail->addBCC($bcc);
            }

            // CONTEUDO

            $obMail->isHtml(true);
            $obMail->Subject = $subject;
            $obMail->Body = $body;

            return $obMail->send();




        }catch(PHPMailerException $e)
        {
            $this->error = $e->getMessage();
            return false;
        }
    }
}

?>