<?php
/**
 * @author CoderSpy Ltd
 * @email info@coderspy.com
 * @create date 2021-01-17 06:42:07
 * @modify date 2021-01-17 06:42:07
 * @desc [description]
 */
require dirname(__FILE__) . '/php-email-address-validator.php';

use PHPEmailAddressValidator\PHPEmailAddressValidator;

//Setting up lists.
PHPEmailAddressValidator::setWhiteListDatabasePath(dirname(__FILE__) . '/whitelist.txt');
PHPEmailAddressValidator::setBlackListDatabasePath(dirname(__FILE__) . '/blacklist.txt');
PHPEmailAddressValidator::setDisposableProvidersDatabasePath(dirname(__FILE__) . '/disposable.txt');
if(isset($_POST['submit'])){ 
    $emails = preg_split('/\s+/',$_POST['emails']);
    foreach( $emails as $key=>$email){
        $result = PHPEmailAddressValidator::validateString($email);
        if($result === true){
            $result = PHPEmailAddressValidator::validate($email);
            if($result === true){
                $resultArray[]=$email;
            }
        }
    }
}
$email = 'foo.bar@mail.com';
$disposable = 'foo.bar@yourdomain.com';

//Checking if the e-mail address is valid.
$result = PHPEmailAddressValidator::validateString($email);
echo 'Is a valid e-mail address? ' . ( $result === true ? 'Yes' : 'No' ) . PHP_EOL;

//Checking if the e-mail address is valid and existing.
$result = PHPEmailAddressValidator::validate($email);
echo 'Is a valid and existing e-mail address? ' . ( $result === true ? 'Yes' : 'No' ) . PHP_EOL;

//Checking if the e-mail address is accepted (its provider can be within the white list but not in the black list).
$result = PHPEmailAddressValidator::isTrustedProvider($disposable, false, true);
echo 'Is an accepted e-mail address? ' . ( $result === true ? 'Yes' : 'No' ) . PHP_EOL;

//Checking if the provider of the e-mail address is disposable or not.
$result = PHPEmailAddressValidator::isDisposableProvider($disposable);
echo 'Is a disposable e-mail address? ' . ( $result === true ? 'Yes' : 'No' ) . PHP_EOL;