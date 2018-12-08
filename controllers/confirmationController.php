<?php

class ConfirmationController{
    public function confirmAction(){

        $token = $_GET ['token'];
        $db = new PDO ( 'mysql:host=localhost;dbname=petitions_db', 'root', '', array (
            PDO::ATTR_PERSISTENT => true
        ) );
        $sql = "select *
		from users
		where id=:token";
        $query = $db->prepare ( $sql, array (
            PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY
        ) );
        $query->execute ( array (
            ':token' => $token
        ) );
        $findEmail = $query->fetch ();
        if ($findEmail) {
            $sql = "update users
			set active = true
			where id=:token";
            $query = $db->prepare ( $sql, array (
                PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY
            ) );
            $query->execute ( array (
                ':token' => $token
            ) );
            if (isset ( $_GET ['id'] )) {
                $sql = "insert into signatures (id_user, id_petition)
				values (:id_user, :id_petition);";
                $query = $db->prepare ( $sql, array (
                    PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY
                ) );
                $query->execute ( array (
                    ':id_user' => $token,
                    ':id_petition' => $_GET ['id']
                ) );

            }
            else {
                $sql = "update petitions
			set active = true
			where id_autor=:token";
                $query = $db->prepare ( $sql, array (
                    PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY
                ) );
                $query->execute ( array (
                    ':token' => $token
                ) );
            }
            header ( "Location: http://localhost/" );
        }
        else {
            header ( "Location: http://localhost/info?info=Email not found!" );
        }
    }
}