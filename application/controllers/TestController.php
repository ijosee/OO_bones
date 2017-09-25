<?php
namespace application\modules\admin\controllers;

class TestController extends \MY_Controller
{
    function __construct(){
        parent::__construct();
    }
    
    public function getCsvAndSave(){
        
        $csvFile = file('../somefile.csv');
        $data = [];
        foreach ($csvFile as $line) {
            $data[] = str_getcsv($line);
        }
        
        echo var_dump($data);
        
    }
    
    public function test(){
        
        $servername = "localhost";
        $username = "root";
        $password = "root";
        $dbname = "color";
        
        // Create connection
        //$conn1 = new mysqli($servername, $username, $password, $dbname);
        $sql1 = "SELECT * from cliente c left join cliente_has_producto ch on c.idcliente = ch.cliente_idcliente";
        
        $result1 = $conn1->query($sql1);
        
        // output data of each row
        while($row = $result1->fetch_assoc()) {
            
            $servername2 = "localhost";
            $username2 = "root";
            $password2 = "root";
            $dbname2 = "color";
            
            // Create connection
            //$conn2 = new mysqli($servername2, $username2, $password2, $dbname2);
            
            //echo var_dump($row);
            
            $sql2 = "SELECT * from cliente c left join cliente_has_producto ch on c.idcliente = ch.cliente_idcliente where idcliente  = ".$row["idcliente"];
            //echo 'sql :'.$sql2.' < ---> ';
            $result2 = $conn2->query($sql2);
            
            $descriptionCustomer = "<ul>";
            while($row2 = $result2->fetch_assoc()) {
                
                $descriptionCustomer .= "<li><strong>".$row2["fecha"]." -&gt;</strong> ".$row2["descripcion"]."<strong>&nbsp;</strong></li>";
                
            }
            $descriptionCustomer .= "</ul>";
            
            $servernamee = "localhost";
            $usernamee = "root";
            $passwordd = "root";
            $dbnamee = "db697237100";
            // Create connection
            //$conne = new mysqli($servernamee, $usernamee, $passwordd, $dbnamee);
            
            $email = strtolower($row["email"]);
            $nombre = ucfirst($row["nombre"]);
            $apellido = ucfirst($row["apellido"]);
            $descriptionCustomer = strtolower($descriptionCustomer);
            
            echo "Nombre tal cual : ".$row["nombre"]."<br>";
            echo "Nombre con el lowercase : ".ucfirst(strtolower($row["nombre"]))."<br>";
            echo "Nombre desde variable \$nombre : ".$nombre."<br>";
            
            $query_insert = "INSERT INTO
                        `customers` (`customer_id`
                        , `ip_address`
                        , `username`
                        , `password`
                        , `salt`
                        , `email`
                        , `activation_code`
                        , `forgotten_password_code`
                        , `forgotten_password_time`
                        , `remember_code`
                        , `created_on`
                        , `last_login`
                        , `active`
                        , `first_name`
                        , `last_name`
                        , `company`
                        , `phone`
                        , `observations`)
                        VALUES (
                        NULL
                        , '127.0.0.1'
                        , NULL
                        , '".$email."'
                        , NULL
                        , '".$email."'
                        , NULL
                        , NULL
                        , NULL
                        , NULL
                        , '".date("Y-m-d H:i:s")."'
                        , '".date("Y-m-d H:i:s")."'
                        , '1'
                        , '".ucfirst(strtolower($row["nombre"]))."'
                        , '".ucfirst(strtolower($row["apellido"]))."'
                        , NULL
                        , '".$row["telefono"]."'
                        , '".$descriptionCustomer."') ";
            
            //echo '- query_insert :'.$query_insert."<br>";
            
            $checkIfExist = "Select * from customers where first_name = '".$row["nombre"]."' and last_name ='".$row["apellido"]."'" ;
            echo "query exist : ".$checkIfExist;
            $resultado = $conne->query($checkIfExist);
            $num_rows = $resultado->num_rows;
            echo "Esta query excupe  : ".$num_rows."<br>";
            if($num_rows == 0){
                
                $resultt = $conne->query($query_insert);
                
            }
            
        }
        
        //$conn->close();
    }
}

