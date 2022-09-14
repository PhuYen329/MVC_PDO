<?php
class DB{
    private $_numRow;
    private $pdo= null;
    private $newID;
    function __construct()
    {
        $driver="mysql:host=". HOST."; dbname=".DATABASE;
        try{
            $this->pdo=new PDO($driver,USERNAME,PASSWORD);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->pdo->query("set names 'utf8' ");
        }
        catch(PDOException $e){
            echo "ERR:".$e->getMessage();
            exit;
        }
    }

    public function __destruct()
    {
        $this->pdo= null;
    }
    public function beginTransaction()
    {
        $this->pdo->beginTransaction();
    }
    public function commit()
    {
        $this->pdo->commit();
    }
    public function rollback()
    {
        $this->pdo->rollBack();
    }
    public function setAttribute($arr=array())
    {
        foreach($arr as $key=>$value)
            $this->setAttribute($key,$value);
    }
    public function getNewID()
    {
        return $this->newID;
    }
    public function getRowCount()
    {
        return $this->_numRow;
    }
    private function sql_debug($sql_string, array $params = null) {
        if (!empty($params)) {
            $indexed = $params == array_values($params);
            foreach($params as $k=>$v) {
                if (is_object($v)) {
                    if ($v instanceof \DateTime) $v = $v->format('Y-m-d H:i:s');
                    else
                        continue;
                }
                elseif (is_string($v)) $v="'$v'";
                elseif ($v === null) $v='NULL';
                elseif (is_array($v)) $v = implode(',', $v);

                if ($indexed) {
                    $sql_string = preg_replace('/\?/', $v, $sql_string, 1);
                }
                else {
                    if ($k[0] != ':') $k = ':'.$k; //add leading colon if it was left out
                    $sql_string = str_replace($k,$v,$sql_string);
                }
            }
        }
        return $sql_string;
    }
    private function query($sql, $arr = array(), $mode = PDO::FETCH_ASSOC)
    {
        $stm = $this->pdo->prepare($sql);
        if (!$stm->execute( $arr))
        {
            echo "Sql lỗi."; //exit;
            echo $this->sql_debug($sql,$arr);
        }
        $this->_numRow = $stm->rowCount();
        return $stm->fetchAll($mode);

    }
    /*
    Sử dụng cho các sql select
    */
    public function exeQuery($sql,  $arr = array(), $mode = PDO::FETCH_ASSOC)
    {
        return $this->query($sql, $arr, $mode);
    }
    /*
    Sử dụng cho các sql cập nhật dữ liệu. Kết quả trả về số dòng bị tác động
    */
    public function exeNoneQuery($sql,  $arr = array(), $mode = PDO::FETCH_ASSOC)
    {
        $this->query($sql, $arr, $mode);
        $this->newID=$this->pdo->lastInsertId();
        return $this->getRowCount();
    }

}

?>