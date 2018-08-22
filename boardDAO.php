<?php
define('url', "mysql:host=localhost;dbname=web");
define('user', "bm");
define('pw', "bm");
require "fileUtils.php";
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
    public function getBoardList(&$cri): array
    {
        $sql = "SELECT * FROM board ORDER BY bno DESC
                LIMIT ?, ?";
        $stmt = $this->getPrePare($sql);
        $stmt->bindValue(1, $cri->getStartPage(), PDO::PARAM_INT);
        $stmt->bindValue(2, $cri->perPageNum, PDO::PARAM_INT);
        try {
            $stmt->execute();
        } catch (Exception $e) {
            print $e->getMessage();
        }

        return $stmt->fetchAll();
    }

    // 게시물 검색 요청
    public function getSearchBoard(&$cri): array
    {

        $searchSql = "SELECT * FROM board ";
        $startPage = $cri->getStartPage();
        // 검색조건별로 기간, 제목, 제목+내용, 작성자 쿼리를 만든다
        $searchSql .= $this->mkPeriodSql($cri->period);
        if ($cri->keyword && $cri->searchType) { // 검색타입+키워드 둘다 있어야 실행된다.
            $searchSql .= $this->mkSearchSql($cri->searchType);
        }
        $searchSql .= " ORDER BY bno DESC LIMIT :startPage, :perPageNum";
        $stmt = $this->getPrePare($searchSql);

        if ($cri->keyword) {
            $stmt->bindParam(":keyword", $cri->keyword, PDO::PARAM_STR);
        }
        $stmt->bindParam(":startPage", $startPage, PDO::PARAM_INT);
        $stmt->bindParam(":perPageNum", $cri->perPageNum, PDO::PARAM_INT);
        try {
            $stmt->execute();
        } catch (Exception $e) {
            print $e->getMessage();
        }

        return $stmt->fetchAll();
    }

    // 전체 게시물 갯수 가져오기
    public function getBoardCnt(&$cri): int
    {

        $sql = "SELECT COUNT(*) FROM board ";
        $sql .= $this->mkPeriodSql($cri->period);
        if ($cri->keyword && $cri->searchType) { // 검색타입+키워드 둘다 있어야 실행된다.
            $sql .= $this->mkSearchSql($cri->searchType);
        }
        $stmt = $this->getPrePare($sql);
        if ($cri->keyword) {
            $stmt->bindParam(":keyword", $cri->keyword, PDO::PARAM_STR);
        }
        try {
            $stmt->execute();
        } catch (Exception $e) {
            print $e->getMessage();
        }

        $result = $stmt->fetch()['0'];
        return empty($result) ? 0 : $result;
    }

    // 기간 검색 sql ex) SELECT * FROM board WHERE regdate <= now() AND title LIKE CONCAT('%', 변수, '%');
    public function mkSearchSql($searchType)
    {
        $searchSql = "";
        switch ($searchType) {
            case "tc":
                $searchSql .= "AND (
                            title LIKE CONCAT('%', :keyword, '%')
                            OR content LIKE CONCAT('%', :keyword, '%')
                               )";
                break;
            case "t":
                $searchSql .= "AND title LIKE CONCAT('%', :keyword , '%')";
                break;
            case "w":
                $searchSql .= "AND writer LIKE CONCAT('%', :keyword , '%')";
                break;
        }
        return $searchSql;
    }
    // 기간 날짜 설정 sql
    public function mkPeriodSql($period)
    {
        $searchSql = "WHERE ";
        switch ($period) {
            case "fd":
                $searchSql .= "regdate <= now()";
                break;
            case "1d";
                $searchSql .= "regdate >= date_add(now(), interval - 1 day)";
                break;
            case "1w";
                $searchSql .= "regdate >= date_add(now(), interval - 1 week)";
                break;
            case "1m";
                $searchSql .= "regdate >= date_add(now(), interval - 1 month)";
                break;
            case "6m";
                $searchSql .= "regdate >= date_add(now(), interval - 6 month)";
                break;
            case "1y";
                $searchSql .= "regdate >= date_add(now(), interval - 1 year)";
                break;
            default:
                $searchSql .= "bno > 0 ";
                break;
        }

        return $searchSql;
    }

    // 게시물입력
    public function insertBoard($title, $writer, $content)
    {
        
        $fileURL = FileUtils::uploadFile('file');
        $sql = "INSERT INTO board
    (title, writer, content, file_url)
    VALUES
    (?,?,?,?)";

        $stmt = $this->getPrePare($sql);
        $stmt->execute(array($title, $writer, $content, $fileURL));
    }

    // 게시물수정
    public function updateBoard($title, $content, $bno, $fileUrl)
    {
    // 사용자가 새로 업로드를 했을경우 서버에 파일저장하고 url을 리턴함.
        if ($fileUrl === null) {
            $fileUrl = FileUtils::uploadFile('file');
        }
       $sql = "UPDATE board SET
                title = ?,
                content = ?,
                file_url = ?
            WHERE bno = ?";
        $stmt = $this->getPrePare($sql);
        echo $fileUrl;
        $stmt->execute(array($title, $content, $fileUrl, $bno));
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
