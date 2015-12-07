<?php 

namespace marcinmisiak\kontoldap;

use Yii;
// use yii\base\Object;
use yii\base\ErrorHandler;


class Kontoldap extends \yii\base\Object {
	public $adminUser; // CN name eg 'cn=Administrator,dc=wsepinm,dc=edu,dc=pl',
	public $adminPass;
	public $host; 
	public $dc;
	
	public function init() {
		if (!isset( Yii::$app->params ['ldap'] ['host']) || !isset( Yii::$app->params ['ldap'] ['user']) ||!isset( Yii::$app->params ['ldap'] ['pass']) ) {
			Yii::error("Ldap params in file config/params.php is not set!");
			exit;
		}
		$this->host = Yii::$app->params ['ldap'] ['host'];
		$this->adminUser = Yii::$app->params ['ldap'] ['user'];
		$this->adminPass = Yii::$app->params ['ldap'] ['pass'];
		
		$ds = ldap_connect ( Yii::$app->params ['ldap'] ['host'] );
		ldap_set_option ( $ds, LDAP_OPT_PROTOCOL_VERSION, 3 );
		$r = @ldap_bind ( $ds, Yii::$app->params ['ldap'] ['user'], Yii::$app->params ['ldap'] ['pass'] );
	}
}
?>