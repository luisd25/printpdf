<?php  
  
 
  class connect
  {
     // public $conn;
      public $result;
      public function connect(){
          
      }
     
      public function select($table){
            $servername = "us-cdbr-azure-east-a.cloudapp.net";
            $username = "bbebec5df7b000";
            $password = "4002da23";
            $dbname = "intimacion-mc";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);
            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
                //echo 'hey';
            } 

            if($table!='intimaciones')$sql = "SELECT  *  FROM ".$table;
            else 
                $sql='select b.nombre, a.prestamo_id, a.status,
                      b.telefono, c.monto, c.fecha_limite 
                      From intimaciones a 
                      left join clientes b on a.cliente_id = b.id
                      left join cuotas c on a.prestamo_id = c.prestamo_id  
                      where a.status = "pendiente"';
            //echo $sql;
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // output data of each row
                $i=0;
                while($row = $result->fetch_assoc()) {
                    //echo "id: " . $row["id"]. " - Name: " . $row["prestamo_id"]. " " . $row["fecha_generacion"]. "<br>";
                    //$data[$i] = "id: " . $row["id"]. " - Name: " . $row["prestamo_id"]. " " . $row["fecha_generacion"]. "<br>";
                    if($table=='intimaciones'){
                        $data['nombre'][$i] = $row['nombre'];
                        $data['prestamo_id'][$i] = $row['prestamo_id'];
                        $data['fecha_limite'][$i] = $row['fecha_limite'];
                        $data['monto'][$i] = $row['monto'];
                        $data['status'][$i] = $row['status'];
                        $data['telefono'][$i] = $row['telefono'];
                        $i++;
                    }
                    
                    else if($table=='cuota'){
                        $data['id'][$i] = $row['id'];
                        $data['prestamo_id'][$i] = $row['prestamo_id'];
                        $data['fecha_generacion'][$i] = $row['fecha_generacion'];
                        $i++;
                    }
                    else if($table=='clientes'){
                        $data['id'][$i] = $row['id'];
                        $data['nombre'][$i] = $row['nombre'];
                        $data['tipo_identificacion'][$i] = $row['tipo_identificacion'];
                        $i++;
                    }
                    
                }
            } else {
                echo "0 results";
            }
            
            $conn->close();
            //echo $data["nombre"][0];
            return $data;
      } 
     
  }

   

?>