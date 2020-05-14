<?php
	$filepath = realpath(dirname(__FILE__));
	include_once ($filepath.'/../helpers/constantPVS.php');
?>
<?php
/**
* Format Class
*/
class ErrorMessagePVS{
    const PASSWORD_NOT_MATCHED = _PASSWORD_NOT_MATCHED;
    const CHECK_REQUIRED_FIELDS = _CHECK_REQUIRED_FIELDS;
    const CHECK_BIRTHDAY_18_OR_OLDER = _CHECK_BIRTHDAY_18_OR_OLDER;
    const CHECK_ON_AGREE_CHECKBOX = _CHECK_ON_AGREE_CHECKBOX;
    const CHECK_EMAIL_FORMAT = _CHECK_EMAIL_FORMAT;
}
?>