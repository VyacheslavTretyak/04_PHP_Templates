<?php


class PetitionController
{
    public function showAction(){
        $home = new View('petition');
        $content = $this->getContent();
        $home->assign('content', $content);
        $home->assign('id', $_GET['id']);

        $layout = new View('layout');
        $layout->import('content', $home);
        $layout->display();
    }

    private function getContent()
    {
        ob_start();
        $id = $_GET['id'];
        $db = new PDO ('mysql:host=localhost;dbname=petitions_db', 'root', '', array (PDO::ATTR_PERSISTENT => true));
        $sql = "select p.*, u.email, count(s.id) as qty
					from petitions as p
					left join signatures as s on p.id = s.id_petition
					left join users as u on p.id_autor = u.id
					where p.id = :id
					group by p.id";
        $query = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
        $query->execute(array(':id'=>$id));
        while($petition = $query->fetch()){
            $subject = $petition['subject'];
            $body = $petition['body'];
            $count = $petition['qty'];
            $email = $petition['email'];
            echo "<div class='card'>
					<div class='card-header'>
						<div class='row'>
						  <div class='col-auto mr-auto'>$subject</div>
							<div class='col-auto'>[$email]</div>
						  <div class='col-auto'>Count: $count</div>
						</div>
					</div>
						<div class='card-body'>
							<p class='card-text'>$body</p>							
						</div>
					</div>";
        }
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }

    private function sendMail($token, $idPetition){
        $msg = "http://localhost/confirmation?token=$token&id=$idPetition";
        mail("reg@petition.org","Confirmation",$msg);
        header ( "Location: http://localhost/info?info=We send confirmation email on your address!" );
    }

    public function getupAction(){
        $email= $_POST['email'];
        $idPetition = $_POST['id_petition'];
        $db = new PDO ( 'mysql:host=localhost;dbname=petitions_db', 'root', '', array (
            PDO::ATTR_PERSISTENT => true
        ) );
        $sql = "select *
		from users		
		where email = :email";
        $query = $db->prepare ( $sql, array (
            PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY
        ) );
        $query->execute ( array (
            ':email' => $email
        ) );
        $findEmail = $query->fetch ();
        if(!$findEmail){
            $sql = "insert into users(id,email)
							values (:id, :email);";
            $query = $db->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $token = hash('sha256', $email);
            $query->execute(array(':id'=>$token, ':email'=>$email));
            $this->sendMail($token, $idPetition);
        }
        else if(!$findEmail['active']){
            $this->sendMail($findEmail['id'], $idPetition);
        }else{
            $token = $findEmail['id'];
            $sql = "select *
		from signatures
		where id_user = :token and id_petition = :idPetition";
            $query = $db->prepare ( $sql, array (
                PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY
            ) );
            $query->execute ( array (
                ':token' => $token,
                ':idPetition' => $idPetition
            ) );
            $findSignatures = $query->fetch ();
            if($findSignatures){
                header("Location: http://localhost/info?info=You already get up!");
            }else{
                $sql = "insert into signatures (id_user, id_petition)
				values (:id_user, :id_petition);";
                $sth = $db->prepare($sql);
                $sth->bindValue(':id_user', $token);
                $sth->bindValue(':id_petition', $idPetition);
                $sth->execute();
                header ( "Location: http://localhost/petition?id=$idPetition");
            }

        }
    }
}