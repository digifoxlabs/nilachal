<?php

namespace Config;

use CodeIgniter\Config\BaseConfig;

class Email extends BaseConfig
{
    /**
     * @var string
     */
   // public $fromEmail = "support@nilachalstaytour.com";
    public $fromEmail = "amlan17bhuyan@gmail.com";

    /**
     * @var string
     */
    public $fromName ="Nilachal Stay Tour";

    /**
     * @var string
     */
    public $recipients;

    /**
     * The "user agent"
     *
     * @var string
     */
    public $userAgent = 'CodeIgniter';

    /**
     * The mail sending protocol: mail, sendmail, smtp
     *
     * @var string
     */
    public $protocol = 'mail';

    /**
     * The server path to Sendmail.
     *
     * @var string
     */
   // public $mailPath = '/usr/sbin/sendmail';
    public $mailPath = "\"C:\xampp\sendmail\sendmail.exe\" -t";

    /**
     * SMTP Server Address
     *
     * @var string
     */
    //public $SMTPHost = "mail.nilachalstaytour.com";
    public $SMTPHost = "smtp.googlemail.com";

    /**
     * SMTP Username
     *
     * @var string
     */
   // public $SMTPUser = "support@nilachalstaytour.com";
    public $SMTPUser = "amlan17bhuyan@gmail.com";

    /**
     * SMTP Password
     *
     * @var string
     */
   // public $SMTPPass ="d5h6PXi[1)3uDR";
    public $SMTPPass ="hzpi mpzt eyqn avwk";

    /**
     * SMTP Port
     *
     * @var int
     */
    //public $SMTPPort = 465;
    public $SMTPPort = 587;

    /**
     * SMTP Timeout (in seconds)
     *
     * @var int
     */
    public $SMTPTimeout = 60;

    /**
     * Enable persistent SMTP connections
     *
     * @var bool
     */
    public $SMTPKeepAlive = false;

    /**
     * SMTP Encryption. Either tls or ssl
     *
     * @var string
     */
    public $SMTPCrypto = 'tls';

    /**
     * Enable word-wrap
     *
     * @var bool
     */
    public $wordWrap = true;

    /**
     * Character count to wrap at
     *
     * @var int
     */
    public $wrapChars = 76;

    /**
     * Type of mail, either 'text' or 'html'
     *
     * @var string
     */
    public $mailType = 'html';

    /**
     * Character set (utf-8, iso-8859-1, etc.)
     *
     * @var string
     */
    public $charset = 'UTF-8';

    /**
     * Whether to validate the email address
     *
     * @var bool
     */
    public $validate = false;

    /**
     * Email Priority. 1 = highest. 5 = lowest. 3 = normal
     *
     * @var int
     */
    public $priority = 3;

    /**
     * Newline character. (Use “\r\n” to comply with RFC 822)
     *
     * @var string
     */
    public $CRLF = "\r\n";

    /**
     * Newline character. (Use “\r\n” to comply with RFC 822)
     *
     * @var string
     */
    public $newline = "\r\n";

    /**
     * Enable BCC Batch Mode.
     *
     * @var bool
     */
    public $BCCBatchMode = false;

    /**
     * Number of emails in each BCC batch
     *
     * @var int
     */
    public $BCCBatchSize = 200;

    /**
     * Enable notify message from server
     *
     * @var bool
     */
    public $DSN = false;
}
