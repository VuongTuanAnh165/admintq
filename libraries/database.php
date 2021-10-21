<?php
    class Database
    {
        public $link;
        
        public function __construct()
        {
            $this->link = mysqli_connect("127.0.0.1","root","","website_multiple_management") or die ();
            mysqli_set_charset($this->link,"utf8");
        }

        public function insert($table,array $data)
        {
            $sql = "INSERT INTO {$table} ";
            $columns = implode(',',array_keys($data));
            $values = "";
            $sql .= '('.$columns.")";
            foreach($data as $field => $value)
            {
                if(is_string($value))
                {
                    $values .= "'".mysqli_real_escape_string($this->link,$value)."',";
                }
                else
                {
                    $values .= mysqli_real_escape_string($this->link,$value).",";
                }
            }
            $values = substr($values, 0, -1);
            $sql .= " VALUES(".$values.")";

            //debug($sql);die;
            mysqli_query($this->link,$sql) or die ("Lỗi query insert ----" .mysqli_error($this->link));
            return mysqli_insert_id($this->link);
        }

        public function update($table, array $data, array $conditions)
        {
            $sql = "UPDATE {$table}";
            $set = " SET ";
            $where = " WHERE ";
            foreach($data as $field => $value)
            {
                if(is_string($value))
                {
                    $set .= $field .'='.'\''. mysqli_real_escape_string($this->link, $value) .'\',';
                }
                else
                {
                    $set .= $field .'='. mysqli_real_escape_string($this->link,$value) . ',';
                }
            }

            $set=substr($set,0,-1);

            foreach($conditions as $field =>$value)
            {
                if(is_string($value))
                {
                    $where .= $field .'='.'\''. mysqli_real_escape_string($this->link,$value) .'\' AND ';
                }
                else
                {
                    $where .= $field .'='. mysqli_real_escape_string($this->link,$value) .' AND ';
                }
            }

            $where=substr($where, 0, -5);
            $sql .= $set . $where;

            //debug($sql);die;
            mysqli_query($this->link,$sql) or die("Lỗi truy vấn Update ----".mysqli_error($this->link));
            return mysqli_affected_rows($this->link);
        }

        //xuất
        public function fetchdata($sql)
        {
            $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn sql ".mysqli_error($this->link));
            $data =[];
            if($result)
            {
                while($num=mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }
        public function fetchcheck($sql)
        {
            $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchID ".mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }

        //xóa
        public function delete($sql)
        {
            mysqli_query($this->link,$sql) or die("Lỗi truy vấn delete--------".mysqli_error($this->link));
            return mysqli_affected_rows($this->link);
        }

        public function updateview($sql)
        {
            $result = mysqli_query($this->link,$sql) or die ("Looix update view ".mysqli_error($this->link));
            return mysqli_affected_rows($this->link);
        }

        public function countTable($table)
        {
            $sql ="SELECT id FROM {$table}";
            $result = mysqli_query($this->link,$sql) or die ("Lỗi truy vấn countTable------".mysqli_error($this->link));
            $num=mysqli_num_rows($result);
            return $num;
        }

        /*public function delete($table,$id)
        {
            $sql="DELETE FROM {$table} WHERE ID=$id";
            mysqli_query($this->link,$sql) or die("Lỗi truy vấn delete--------".mysqli_error($this->link));
            return mysqli_affected_rows($this->link);
        }*/

        public function deleteALL($table)
        {
            $sql="DELETE FROM {$table}";
            mysqli_query($this->link,$sql) or die("Lỗi truy vấn delete--------".mysqli_error($this->link));
            return mysqli_affected_rows($this->link);
        }

        public function deletewhere($table,$data=array())
        {
            foreach($data as $id)
            {
                $id=intval($id);
                $sql="DELETE FROM {$table} WHERE id=$id";
                mysqli_query($this->link,$sql) or die ("Lỗi truy vấn delete----".mysqli_error($this->link));
            }
            return true;
        }

        public function fetchsqlTK($sql)
        {
            $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn sql ".mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }


        public function fetchID($table, $id)
        {
            $sql = "SELECT * FROM {$table} WHERE ID=$id";
            $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchID ".mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }
        public function fetchKH($table, $id)
        {
            $sql = "SELECT * FROM {$table} WHERE MaKH=$id";
            $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchID ".mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }
        public function fetchHDB($table, $id)
        {
            $sql = "SELECT * FROM {$table} WHERE MaHDB=$id";
            $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchID ".mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }
        public function fetchXuat($sql)
        {
            $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn sql ".mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }

        public function fetchSPtheoDM($table, $id)
        {
            $sql = "SELECT * FROM {$table} WHERE category_id=$id";
            $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchALL---- " .mysqli_error($this->link));
            $data = [];
            if($result)
            {
                while($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }
        public function fetchChiTiet($table1,$table2,$sql,$id)
        {
            $sql = "SELECT * FROM {$table1}, {$table2} WHERE ".$sql." AND MaHDB=$id";
            $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchALL---- " .mysqli_error($this->link));
            $data = [];
            if($result)
            {
                while($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

        public function fetchOne($table,$query)
        {
            $sql = "SELECT * FROM {$table} WHERE ";
            $sql .= $query;
            $sql .= " LIMIT 0, 1";
            $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchOne " .mysqli_error($this->link));
            return mysqli_fetch_assoc($result);
        }

        public function deletesql($table, $sql)
        {
            $sql = "DELETE FROM {$table} WHERE ".$sql;
            //debug($sql);die
            mysqli_query($this->link,$sql) or die("Lỗi truy vấn delete ---- " .mysqli_error($this->link));
            return mysqli_affected_rows($this->link);
        }

        public function fetchALL($table)
        {
            $sql = "SELECT * FROM {$table} WHERE 1";
            $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchALL---- " .mysqli_error($this->link));
            $data = [];
            if($result)
            {
                while($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

        public function fetchALL2($table1,$table2, $sql)
        {
            $sql = "SELECT * FROM {$table1} , {$table2} WHERE ".$sql;
            $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchALL---- " .mysqli_error($this->link));
            $data = [];
            if($result)
            {
                while($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

        public function fetchLogin($table,$query)
        {
            $sql = "SELECT * FROM {$table} WHERE ";
            $sql .= $query;
            $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchALL---- " .mysqli_error($this->link));
            $data = [];
            if($result)
            {
                while($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

        public function fetchJones($table, $sql, $total = 1, $page, $row, $pagi = true)
        {
            $data = [];
            $result=mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone-----" .mysqli_error($this->link));
            if($pagi==true)
            {
                $total = $this->countTable($table);
                $sotrang = ceil($total / $row);
                $start= ($page-1) * $row;
                $sql .= " LIMIT $start,$row";
                $data = [ "page" => $sotrang];

                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone-----" .mysqli_error($this->link));
            }
            else
            {
                $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJone-----" .mysqli_error($this->link));
            }

            if($result)
            {
                while($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

        public function fetchJoneDetail($table, $sql, $page = 0, $total, $pagi)
        {
            $result = mysqli_query($this->link,$sql) or die("Lỗi truy vấn fetchJoneDetail----- " .mysqli_error($this->link));

            $sotrang = ceil($total / $pagi);
            $start = ($page - 1) * $pagi;
            $sql .= "LIMIT $start,$pagi";

            $result = mysqli_query($this->link,$sql);
            $data = [];
            $data = [ "page" => $sotrang];
            if($result)
            {
                while ($num = mysqli_fetch_assoc($result))
                {
                    $data[] = $num;
                }
            }
            return $data;
        }

        public function total($sql)
        {
            $result = mysqli_query($this->link,$sql);
            $tien = mysqli_fetch_assoc($result);
            return $tien;
        }
    }
?>