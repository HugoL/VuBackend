<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	
	private $_id;
 
    public function authenticate(){

       if( $this->auth_pop3_ssl($this->username, $this->password,Yii::app()->params['popserver']) ){
       		$criteria = new CDbCriteria;
       		$criteria->conditions = 'username = :username';
       		$criteria->params = array(':username' => $this->username);
       		$user = User::model()->find( $criteria );
       		print_r($user);
       		if( empty($user) )
       			return false;
       		else{
       			$this->_id=$user->id;
        		$this->setState('lastLoginTime', $user->lastLoginTime);
        		$this->errorCode=self::ERROR_NONE;
        		return true;
        	}
        }else if( !empty($this->password) ){ //miro si es usuario interno de la plataforma
        	$criteria = new CDbCriteria;
        	$criteria->condition = 'username = :username AND password = :password';
        	$criteria->params = array(':username' => $this->username,'password' => $this->password);
        	$user = User::model()->find( $criteria );
        	if( !empty($user) )
        		return true;
        	return false;
        }
        return false;
    }
 
    public function getId(){
        return $this->_id;
    }

    public function auth_pop3_ssl( $username, $password, $popserver ){
		$isSSL = 0;
		
		if( substr($popserver, 0, 6) == "ssl://" ){
			$isSSL = 1;
		}
		
		if( trim($username)=='' ){
			return false;
		}else{
			if( $isSSL){
				$fp = fsockopen("$popserver", 995, $errno, $errstr);
			}else{
				$fp = fsockopen("$popserver", 110, $errno, $errstr);
			}
	
			if(!$fp){
				// failed to open POP3
				return false;
			}else{
				set_socket_blocking($fp,-1); // Turn off blocking

				/*
				Clear the POP server's Banner Text.
				eg.. '+OK Welcome to etc etc'
				*/

				$trash = fgets($fp,128); // Trash to hold the banner
				fwrite($fp,"USER $username\r\n"); // POP3 USER CMD
				$user = fgets($fp,128);
				$user = ereg_replace("\n","",$user);
	
				if ( ereg ("^\+OK(.+)", $user ) ){
					fwrite($fp,"PASS $password\r\n"); // POP3 PASS CMD
					$pass = fgets($fp,128);
					$pass = ereg_replace("\n","",$pass);
	
					if ( ereg ("^\+OK(.+)", $pass ) ){
						// User has successfully authenticated
						$auth = true;
					}else{
						// bad password
						$auth = false;
					}
				}else{
					// bad username
					$auth = false;
				}
	
				fwrite($fp,"QUIT\r\n");
				fclose($fp);
				return $auth;
			}
		}
	}
}