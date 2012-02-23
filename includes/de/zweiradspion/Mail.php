<?php
namespace de\zweiradspion;

require_once ("Mail.php");
require_once ("Mail/mime.php");


/**
 * Helferfunktionen
 *
 * @author christ
 */
class Mail {
    public function send($to, $subject, $text) {
        $message                              = $text;
        $html_message                         = '<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="content-type" content="text/html; charset=UTF-8">
<title>' . $subject . '</title>
</head>
<body style="background:#F5D36E;">
<img src="http://2radspion.de/resources/images/logo_folgeseiten.png" alt="Zweiradspion">
<p>' . str_replace("\n", '<br>', $text) . '</p>
</body>
</html>';

        $headers["From"]                      = 'webmaster@zweiradspion.de';
        #$headers["To"] = "oliver.christ@web.de"; 
        $headers["Subject"]                   = $subject;
        $headers["Content-Type"]              = 'text/html; charset=UTF-8';
        $headers["Content-Transfer-Encoding"] = "8bit";

        $mime                                 = new \Mail_mime; 
        $mime->setTXTBody($message); 
        $mime->setHTMLBody($html_message); 
        $mimeparams=array(); 
        $mimeparams['text_encoding'] = "8bit"; 
        $mimeparams['text_charset']  = "UTF-8"; 
        $mimeparams['html_charset']  = "UTF-8"; 
        $mimeparams['head_charset']  = "UTF-8"; 
        
        #$mimeparams["debug"] = "True"; 
        
        $body         = $mime->get($mimeparams); 
        $headers      = $mime->headers($headers); 
        $page_content = "Mail now."; 
        
        
        // SMTP server name, port, user/passwd 
        #$smtpinfo["debug"] = "True"; 
        
        
        // Create the mail object using the Mail::factory method
        $mail =& \Mail::factory("smtp", $smtpinfo);
        
        return $mail->send('oliver.christ@web.de', $headers, $body);
    }
}