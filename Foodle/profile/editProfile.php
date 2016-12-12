<?php

$userId = $_POST['userId'];

$inputName = $_POST['fullname'];
$inputNewPassword = $_POST['newPassword'];
$inputNewPasswordConfirm = $_POST['newPasswordConfirm'];

$inputPassword = $_POST['currentPassword'];
$inputPasswordConfirm = $_POST['currentPasswordConfirm'];

//$text = '<div><?php echo $userId $inputName $inputNewPassword $inputNewPasswordConfirm $inputPassword $inputPasswordConfirm </div>'

$text = '<div class="alert alert-success" role="alert">Profile details updated successfully.</div>';

$dataBack = array('text' => $text,
	'userId' => $userId, 
	'inputName' => $inputName, 'inputNewPassword' => $inputNewPassword, 'inputNewPasswordConfirm' => $inputNewPasswordConfirm,
	'inputPassword' => $inputPassword, 'inputPasswordConfirm' => $inputPasswordConfirm
	);

$dataBack = json_encode($dataBack);
echo $dataBack;

?>