<?php
    function getDataAll($koneksidb,$query){
        try{
            $stmt = $koneksidb->prepare($query); 
            $stmt->execute();
            $result = $stmt->fetchAll();
            return $result;
            
        }catch(PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    function getDataCriteria($koneksidb,$query,$arrCriteria){
        try{
            $result = $koneksidb->prepare($query); 
            $result->execute($arrCriteria); 
            $user = $result->fetch();
            return $user;

        }catch(PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    function getDataCriteriaAll($koneksidb,$query,$arrCriteria){
        try{
            $result = $koneksidb->prepare($query); 
            $result->execute($arrCriteria); 
            $user = $result->fetchAll();
            return $user;

        }catch(PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

    function getDataNumber($koneksidb,$query,$arrCriteria){
        $result = $koneksidb->prepare($query); 
        $result->execute($arrCriteria); 
        $number_of_rows = $result->fetchColumn();
        return $number_of_rows;
    }
    function getDataNumber2($koneksidb,$query,$arrCriteria){
        $result = $koneksidb->prepare($query); 
        $result->execute($arrCriteria); 
        $n = 0;
      
            foreach ($result as $row) {
                $n++;
            }

        return $n;
    }

    

    function getColumn($koneksidb,$query){
        $result = $koneksidb->query($query.' LIMIT 0');
        for ($i = 0; $i < $result->columnCount(); $i++) {
            $col = $result->getColumnMeta($i);
            $columns[] = $col['name'];
        }
        return $columns;
    }
    
    function getColumnNumber($koneksidb,$query){
        $result = $koneksidb->prepare($query); 
        $result->execute();
        $colcount = $result->columnCount();
        return $colcount;
    }
    
    function getColumnSpace($koneksidb,$query){
        $result = $koneksidb->query($query.' LIMIT 0');
        for ($i = 0; $i < $result->columnCount(); $i++) {
            $col = $result->getColumnMeta($i);
            $columns[] = $col['name'];
           
        }

        for ($i = 0; $i < $result->columnCount(); $i++) {
        $columns[$i] = strtolower($columns[$i]);
            if(strpos($columns[$i],"_")!=0){
            $columns[$i] = substr_replace($columns[$i]," ",strpos($columns[$i],"_"),1);
            }
            $columns[$i]=ucwords($columns[$i]);
        }
        return $columns;
    }

    function execSql($koneksidb,$query,$arrCriteria){
        try{
            $result = $koneksidb->prepare($query); 
            $result->execute($arrCriteria); 
            return true;
        }catch(PDOException $e) {
            return "Error: " . $e->getMessage();
        }
    }

?>