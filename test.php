<?php

$mbox = imap_open("{mail.domain.co.uk:993/imap/ssl/novalidate-cert}INBOX", "test@domain.co.uk", "password");

$msg_count = imap_num_msg($mbox);

for ($i = 1; $i <= $msg_count; $i++) {
    $msg_meta = imap_headerinfo($mbox, $i);
    $msg_body = imap_fetchstructure($mbox, $i);


    $from = $msg_meta->from;
    $subject = $msg_meta->subject;
    
    foreach ($from as $id => $object) {
        $fromname[$i] = $object->personal;
        $fromaddress[$i] = $object->mailbox . "@" . $object->host;
        //echo $object->personal . PHP_EOL;
        //echo $object->mailbox . "@" . $object->host;
    }
    //echo $fromname[$i];
    $body_text = imap_qprint(imap_body($mbox, $i));
    //var_dump($body);
    //$skuList = preg_split('/\r\n|\r|\n/', $body_text);
    //echo preg_split('/\r\n|\r|\n/', $body_text);
    imap_delete($mbox, $i);
}


imap_expunge($mbox);
imap_close($mbox);

?>
