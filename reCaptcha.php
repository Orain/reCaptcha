<?php
if ( !defined( 'MEDIAWIKI' ) ) {
	die( 'Not an entry point.' );
}

$GLOBALS['wgMessagesDirs']['Recaptcha'] = __DIR__ . '/i18n';
$GLOBALS['wgMessagesDirs']['reCaptcha'] = __DIR__ . '/i18n';

$wgExtensionCredits['antispam'][] = array(
	'path' => __FILE__,
	'name' => 'reCaptcha',
	'author' => array( 'Vedmaka' ),
	'version' => '0.1',
	'url' => 'https://www.mediawiki.org/wiki/Extension:reCaptcha',
	'descriptionmsg' => 'recaptcha-desc',
	'license-name' => 'GPL-2.0+'
);

//Configuration variables
$wgReCaptchaKey = '';
$wgReCaptchaSecret = '';

$wgAutoloadClasses['reCaptchaHooks'] = $dir . '/reCaptcha.hooks.php';

$hooksHandler = new reCaptchaHooks();

//Protect account creation
$GLOBALS['wgHooks']['UserCreateForm'][]         =
$GLOBALS['wgHooks']['AbortNewAccount'][]        =
//Protect content edition
$GLOBALS['wgHooks']['PageContentSave'][]        = array( $hooksHandler );
$GLOBALS['wgHooks']['EditPage::showEditForm:initial'][]   = array( $hooksHandler, 'onShowEditForm' );



