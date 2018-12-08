<?php

class HomeController{
    public function showAction(){
        $home = new View('home');
        $content = $this->getContent();
        $home->assign('content', $content);

        $layout = new View('layout');
        $layout->import('content', $home);
        $layout->display();
    }
    private function getContent(){
        ob_start();
        if (! isset ( $_GET ['page'] )) {
            $page = 1;
        }
        else {
            $page = $_GET ['page'];
        }
        $db = new PDO ( 'mysql:host=localhost;dbname=petitions_db', 'root', '', array (
            PDO::ATTR_PERSISTENT => true
        ) );

        $sql = "select p.*, u.email, count(s.id) as qty
        from petitions as p
        left join signatures as s on p.id = s.id_petition
        left join users as u on p.id_autor = u.id
        where p.active = 1
        group by p.id";
        $query = $db->prepare ( $sql, array (
            PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY
        ) );
        $query->execute ();
        $allPetitions = $query->fetchAll ();
        $countPetition = count ( $allPetitions );

        $countOnPage = 3;
        $pages = ceil ( $countPetition / $countOnPage );

        $start = $countOnPage * ($page - 1);
        for($i = 0; $i < 3; $i ++) {
            $petition = $allPetitions [$i + $start];
            $subject = $petition ['subject'];
            $body = $petition ['body'];
            $count = $petition ['qty'];
            $email = $petition['email'];
            if ($i + $start < $countPetition) {
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
                        <a href='petition?id=" . $petition ['id'] . "' class='btn btn-info'>Get Up</a>
                    </div>
                </div>";
            }
        }

        $prevPage = $page > 1 ? $page - 1 : 1;
        $nextPage = $page < pages ? $page + 1 : $pages;
        $prevDisabled = $page > 1 ? '' : 'disabled';
        $nextDisabled = $page < $pages ? '' : 'disabled';
        echo "<nav aria-label='Page navigation'>
        <ul class='pagination justify-content-center'>
            <li class='page-item $prevDisabled'>
            <a class='page-link' href='/?page=$prevPage'>Previous</a></li>";

        for($i = 1; $i <= $pages; $i ++) {
            $current =$i == $page?"current":"";
            echo "<li class='page-item'>
        <a class='page-link $current' href='/?page=$i'>$i</a></li>";
        }
        echo "<li class='page-item $nextDisabled'>
            <a class='page-link' href='/?page=$nextPage'>Next</a></li>
        </ul>
    </nav>";
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}
