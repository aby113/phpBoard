<?php
define('url', "mysql:host=localhost;dbname=web");
define('user', "bm");
define('pw', "bm");

class BoardDAO
{

    // 게시물 전체 가져오기
    public function getBoardListAll(): array
    {
        $db = $this->getConnection();
        $sql = "SELECT * FROM board";

        $q = $db->query($sql);
        return $q->fetchAll();
    }

    // 게시물 부분적으로 가져오기
    public function getBoardList(&$cri):array
    {
        $sql = "SELECT * FROM board ORDER BY bno DESC 
                LIMIT ?, ?";
        $stmt = $this->getPrePare($sql);
        // $stmt->execute(array($cri->getStartPage(), $cri->perPageNum));
        $stmt->bindValue(1, $cri->getStartPage(), PDO::PARAM_INT);
        $stmt->bindValue(2, $cri->perPageNum, PDO::PARAM_INT);
        try{
            $stmt->execute();         
        }catch(Exception $e){
           print $e->getMessage();
        }
        
        return $stmt->fetchAll();
    }


    // 게시물입력
    public function insertBoard($title, $writer, $content)
    {
        $sql = "INSERT INTO board
    (title, writer, content)
    VALUES
    (?,?,?)";

        $stmt = $this->getPrePare($sql);
        $stmt->execute(array($title, $writer, $content));
    }

    // 게시물수정
    public function updateBoard($title, $content, $bno)
    {
        $sql = "UPDATE board SET
                title = ?,
                content = ?
            WHERE bno = ?";
        $stmt = $this->getPrePare($sql);
        $stmt->execute(array($title, $content, $bno));
    }

    // 게시물삭제
    public function deleteBoard($bno)
    {
        $sql = "DELETE FROM board WHERE bno = ?";
        $stmt = $this->getPrePare($sql);
        $stmt->execute(array($bno));
    }
    // 게시물가져오기
    public function getBoard($bno): array
    {
        $sql = "SELECT * FROM board WHERE bno = ?";
        $stmt = $this->getPrePare($sql);
        $stmt->execute(array($bno));

        return $stmt->fetch();
    }

    // 전체 게시물 갯수 가져오기
    public function getBoardCnt():int
    {
        $stmt = $this->getConnection();
        $result = $stmt->query("SELECT COUNT(*) FROM board");
        return $result->fetch()['0'];
    }

    // PrePareStatement객체 가져오기
    public function getPrePare($sql): PDOStatement
    {
        try {
            $db = new PDO(url, user, pw);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            print $e->getMessage();
        }

        return $db->prepare($sql);
    }

    // 커넥션 가져오기
    public function getConnection(): PDO
    {
        try {
            $db = new PDO(url, user, pw);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $e) {
            print $e->getMessage();
        }

        return $db;
    }
}
