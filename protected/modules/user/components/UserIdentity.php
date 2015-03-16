<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
{
	private $_id;
	const ERROR_EMAIL_INVALID=3;
	const ERROR_STATUS_NOTACTIV=4;
	const ERROR_STATUS_BAN=5;
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
	public function authenticate(){

       if( $this->auth_pop3_ssl($this->username, $this->password,Yii::app()->params['popserver']) ){
       		$criteria = new CDbCriteria;
       		$criteria->condition = 'username = :username';
       		$criteria->params = array(':username' => $this->username);
       		$user = User::model()->find($criteria);
       		if( !empty($user) ){
	       		if($user->status==0 && Yii::app()->getModule('user')->loginNotActiv==false)
					$this->errorCode=self::ERROR_STATUS_NOTACTIV;
				else if($user->status==-1)
					$this->errorCode=self::ERROR_STATUS_BAN;
				else {
					$this->_id=$user->id;
					$this->username=$user->username;
					$this->errorCode=self::ERROR_NONE;
				}
					$user->lastvisit_at = date("Y-m-d H:i:s");
					$user->update();
		        	$this->setState('lastvisit_at', $user->lastvisit_at);
		        	$this->setState('username', $user->username);	 
		        	$this->setState('rol',$user->profile->rol);       
		        	return !$this->errorCode;	        
	        }else{
	        	return false;
	        }
        }else if( !empty($this->password) ){ //miro si es usuario interno de la plataforma
        	$password = md5($this->password);
        	$criteria = new CDbCriteria;
        	$user = User::model()->findByAttributes(array('username' => $this->username,'password' => $password));
        	
        	if( $user !== null ){
        		if($user->status==0 && Yii::app()->getModule('user')->loginNotActiv==false)
					$this->errorCode=self::ERROR_STATUS_NOTACTIV;
				else if($user->status==-1)
					$this->errorCode=self::ERROR_STATUS_BAN;
				else {
					$this->_id=$user->id;
					$this->username=$user->username;
					$this->errorCode=self::ERROR_NONE;
				}
					$user->lastvisit_at = date("Y-m-d H:i:s");
					$user->update();
		        	$this->setState('lastvisit_at', $user->lastvisit_at);
		        	$this->setState('username', $user->username);	 
		        	$this->setState('rol',$user->profile->rol);       
		        	return !$this->errorCode;
        	}else{
        		return false;        
        	}
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