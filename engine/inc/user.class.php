<?php
/*
 *  This file is part of Formula One Manager.
 *
 *  Formula One Manager is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  Formula One Manager is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  You should have received a copy of the GNU General Public License
 *  along with Formula One Manager. If not, see http://www.gnu.org/licenses/
 *
 *  @copyright  (c) Formula One Manager 2007/2012
 *  @author     Charles 'Barbatos' Duprey
 *  @email      barbatos@f1m.fr
 */

class User
{
	private $db;
	private $bld;
	
	public function __construct($bld)
	{
		$this->db = Bld::$db;
		$this->bld = $bld;
		
		if(empty($_SESSION['id']) && !empty($_COOKIE['f1msession']) && !empty($_COOKIE['f1mid']))
		{
			$browser = (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : '';

			$query = $this->db->prepare('SELECT user_mail, user_id, user_pwd, user_group FROM users WHERE user_id = :id');
			$query->bindValue(':id', s($_COOKIE['f1mid']));
			$query->execute();
			$data = $query->fetch(PDO::FETCH_OBJ);
			$query->closeCursor();
			
			$hash = sha1('zejZGFkzHr786786efrkjbh68796'.sha1($browser).'jkhzyuiGYUGYfe54761U'.sha1($data->user_mail).'897kjhhkjHujGFEf9678kJKBHKJ5'.sha1($data->user_id).'poze98678HJhz76hjgzYZYg'.sha1($data->user_pwd).'mdrxdptdrlool975FEFrgeg3456643xdlol');
			if($hash == $_COOKIE['f1msession'])
			{
				setcookie("f1msession", $hash, strtotime("+1 month"), '/'); // 1 an
				setcookie("f1mid", $data->user_id, strtotime("+1 month"), '/'); // 1 an
				
				if(!empty($_COOKIE['auto']))
					setcookie("auto", "1", strtotime("+1 month"), '/');
					
				$_SESSION['id'] = $data->user_id;
				$_SESSION['group'] = $data->user_group;
				
			}
			else
			{
				$this->logout();
			}
		}
	}
	
	public function level($userid = null)
	{
		$query = $this->db->prepare('SELECT user_group FROM users WHERE user_id = :id');
		if($userid != null)
			$query->bindValue(':id', $userid);
		else
			$query->bindValue(':id', $_SESSION['id']);
			
		$query->execute();
		$datas = $query->fetch(PDO::FETCH_OBJ);
		$query->closeCursor();
		
		if(!isset($this->bld['groups'][$datas->user_group]['level']))
			$level = 0;
		else 
			$level = $this->bld['groups'][$datas->user_group]['level'];
			
		return $level;
	}
	
	public function isLogged()
	{
		if( isset($_SESSION['id']) && ((int)$_SESSION['id'] != 0))
			return true;
		else 
			return false;
	}
	
	public function count()
	{
		return $this->db->query('SELECT COUNT(*) FROM users')->fetchColumn();
	}
	
	public function name($id = null)
	{
		$SearchName = $this->db->prepare('SELECT pref_name FROM users_prefs WHERE pref_userid = :id');
		if($id != null):
			$SearchName->execute(array(':id' => s($id)));
		else:
			$SearchName->execute(array(':id' => s($_SESSION['id'])));
		endif;
		
		$datas = $SearchName->fetch(PDO::FETCH_OBJ);
		$SearchName->closeCursor();
		
		return $datas->pref_name;
	}
	
	public function findID($id = null)
	{	
		$SearchID = $this->db->prepare('SELECT user_id FROM users WHERE user_id = :id');
		if($id != null):
			$SearchID->execute(array(':id' => s($id)));
		else:
			$SearchID->execute(array(':id' => s($_SESSION['id'])));
		endif;
		
		$datas = $SearchID->fetch(PDO::FETCH_OBJ);
		$SearchID->closeCursor();
		
		return $datas->user_id;
	}
	
	public function findMail($mail)
	{
		$SearchMail = $this->db->prepare('SELECT COUNT(*) FROM users WHERE user_mail = :mail');
		$SearchMail->execute(array(':mail' => s($mail)));
		return (bool) $SearchMail->fetchColumn();
	}
	
	public function add()
	{
		if($this->findMail(P('email'))):
			redirect(8, MSG_ERROR);
		endif;
		
		$query = $this->db->prepare('
			INSERT INTO users (user_mail, user_pwd, user_group, user_hash, user_regdate, user_lastseen, user_lastip, user_posts) VALUES
			(:mail, :pwd, :group, :hash, :now, :now, :ip, :posts)');
		$query->bindValue(':mail', s(P('email')));
		$query->bindValue(':pwd', sha1(P('password')));
		$query->bindValue(':group', 1);
		$query->bindValue(':hash', '');
		$query->bindValue(':now', time());
		$query->bindValue(':ip', getIP());
		$query->bindValue(':posts', 0);
		$query->execute();
		$query->CloseCursor();
		
		$id = $this->db->lastInsertId();
		
		$query = $this->db->prepare('
			INSERT INTO users_prefs (pref_userid, pref_name, pref_birth, pref_nation, pref_avatar, pref_sig) VALUES 
			(:id, :name, :nothing, :nation, :nothing, :nothing)');
		$query->bindValue(':id', $id);
		$query->bindValue(':name', s(P('name')));
		$query->bindValue(':nation', s(P('country')));
		$query->bindValue(':nothing', '');
		$query->execute();
		$query->closeCursor();
		
	
		/*
		$dest = P('email');
		$sujet = l('Email Subject');
		$entetes = "From: \"The FOM Team\" <no-reply@f1m.fr>\n";
		$entetes .= "Reply-To: no-reply@f1m.fr\n";
		$entetes .= "Return-Path: no-reply@f1m.fr\n";
		$entetes .= "Organization: \"Formula One Manager\"\n";
		$entetes .= "MIME-Version: 1.0\n";
		$entetes .= "Content-Type: text/html; charset=UTF-8\n";
		$txt = "<html><body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\"><p>aa</p></body></html>";
		
		mail($dest, $sujet, $txt, $entetes);
		*/
		redirect(1, MSG_SUCCESS, '/players/login');
		
	}
	
	public function login()
	{
		
		$query = $this->db->prepare('SELECT user_id, user_mail, user_pwd, user_group FROM users WHERE user_mail = :mail');
		$query->bindValue(':mail', P('email'));
		$query->execute();
		$datas = $query->fetch(PDO::FETCH_OBJ);
		$query->closeCursor();
		
		/* No user found */
		if(!$datas->user_id)
			redirect(9, MSG_ERROR, '/players/login');
		
		/* Wrong password */
		if($datas->user_pwd != sha1(P('password')))
			redirect(9, MSG_ERROR, '/players/login');
			
		$query = $this->db->prepare('UPDATE users SET user_lastseen = :now, user_lastip = :ip WHERE user_id = :id');
		$query->bindValue(':now', time());
		$query->bindValue(':ip', getIP());
		$query->bindValue(':id', $datas->user_id);
		$query->execute();
		$query->closeCursor();
		
		$_SESSION['id'] = $datas->user_id;
		$_SESSION['group'] = $datas->user_group;
		
		$browser = (isset($_SERVER['HTTP_USER_AGENT'])) ? $_SERVER['HTTP_USER_AGENT'] : '';

		$hash = sha1('zejZGFkzHr786786efrkjbh68796'.sha1($browser).'jkhzyuiGYUGYfe54761U'.sha1($datas->user_mail).'897kjhhkjHujGFEf9678kJKBHKJ5'.sha1($datas->user_id).'poze98678HJhz76hjgzYZYg'.sha1($datas->user_pwd).'mdrxdptdrlool975FEFrgeg3456643xdlol');
		setcookie("f1msession", $hash, strtotime("+1 month"), '/'); // 1 an
		setcookie("f1mid", $datas->user_id, strtotime("+1 month"), '/'); // 1 an
		
		if (P('auto') && 'on' == strtolower(P('auto')))
			setcookie("auto", "1", strtotime("+1 month"), '/');
			
		redirect(3, MSG_SUCCESS, '/');
	}
	
	public function logout()
	{
		session_destroy();
		
		setcookie("f1msession", false, strtotime("-1 month"), '/');
		setcookie("f1mid", false, strtotime("-1 month"), '/');
		setcookie("auto", false, strtotime("-1 month"), '/');
		
		$_SESSION = array();
		$_COOKIE = array();
		
		session_start();
		
		redirect(2, MSG_SUCCESS, '/');
	}
	
	public function forgotPassword()
	{
		$query = $this->db->prepare('SELECT user_mail FROM users WHERE user_mail = :mail');
		$query->bindValue(':mail', P('forgot_email'));
		$query->execute();
		$datas = $query->fetch(PDO::FETCH_OBJ);
		$query->closeCursor();
		
		/* No user found */
		if(!$datas->user_mail)
			redirect(11, MSG_ERROR, '/players/login/forgot');
		
		$hash = sha1("ezr987kHHKJGhg89767".uniqid()."a9876agklhjLGH");
		
		$query = $this->db->prepare('UPDATE users SET user_hash = :hash WHERE user_mail = :mail');
		$query->bindValue(':hash', $hash);
		$query->bindValue(':mail', P('forgot_email'));
		$query->execute();
		$query->closeCursor();
		
		$dest = P('forgot_email');
		$sujet = "Password change";
		$entetes = "From: no-reply@f1m.fr\n";
		$entetes .= "MIME-Version: 1.0\n";
		$entetes .= "Content-Type: text/html; charset=UTF-8\n";
		$txt = "<html><body style=\"font-family:Verdana, Verdana, Geneva, sans-serif; font-size:12px; color:#666666;\">
			<p>Hi, </p>
			<p><strong>PLEASE DO NOT REPLY TO THIS AUTOMATIC MESSAGE!</strong></p>
			<p>You've asked a password change. Please click on the link below if you really want to change it. If you did not ask to change 
			your password, please ignore this email.</p>
			<p>Click here: <a href=\"".$this->bld['site_url']."players/login/forgot/".$hash."\">".$this->bld['site_url']."players/login/forgot/".$hash."</a> </p>
			<p>Thanks, <br />
			<i>The Formula One Manager Team</i><br />
			<a href=\"http://www.f1m.fr\">www.f1m.fr</a></p>
		</body></html>";
		
		mail($dest, $sujet, $txt, $entetes);
		
		redirect(5, MSG_SUCCESS, '/');
	}
	
	public function changePassword($pw, $hash = "")
	{
		$pw = sha1($pw);
		
		if(!empty($hash)):
			$query = $this->db->prepare('SELECT user_id FROM users WHERE user_hash = :hash');
			$query->bindValue(':hash', s($hash));
			$query->execute();
			$datas = $query->fetch(PDO::FETCH_OBJ);
			$query->closeCursor();
			
			if(!$datas->user_id)
				redirect(12, MSG_ERROR, '/players/login/forgot');
				
		endif;
		
		$query = $this->db->prepare('UPDATE users SET user_pwd = :pwd, user_hash = :nothing WHERE user_hash = :hash');
		$query->bindValue(':hash', $hash);
		$query->bindValue(':pwd', $pw);
		$query->bindValue(':nothing', '');
		$query->execute();
		$query->closeCursor();
		
		redirect(4, MSG_SUCCESS, '/');
	}
}
