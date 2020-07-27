<?php

/* SERVER */
//require ("/var/www/html/sigest/app/Config/config_ip.php");
/* LOCAL */
require ("/wamp64/www/chaco/app/Config/config_ip.php");
?>
<?php

class PedidoVentasController extends AppController {

    public $helper = array('Html', 'Form', 'Javascript', 'Paginator', 'Session');
    public $components = array('RequestHandler', 'Session');

    function index() {
            $this->set('tipos',$this->PedidoVenta->query("select a.enumlabel::varchar as tipo_cliente
            from pg_enum a join pg_type t on a.enumtypid = t.oid 
            where t.typname = 'tipo_cliente'"));    
        if ($this->request->is('get')) {
            $consultas = $this->PedidoVenta->query("select * from v_pedido_ventas where id_sucursal =" . $this->Auth->user('id_sucursal') . " and ped_estado in('PENDIENTE') order by ped_fecha desc");            
            $this->set('consultas', $consultas);          
        }
    }
    function add(){
        $this->layout = 'ajax';
        $db = ConnectionManager::getDataSource('default');
        Configure::write('debug', 2);
        if ($this->request->is('get')) {

                $this->set('clientes',$this->PedidoVenta->query("select *,current_date as fecha from v_clientes"));        
        }
        if ($this->request->is('post')) {

            $valor=$this->PedidoVenta->query("select sp_pedidos(1,0,". $this->Auth->user('id_sucursal').",".$this->data['PedidoVenta']['cliente'].",". $this->Auth->user('id').",'".$this->data['PedidoVenta']['obs']."',0,0,0,'". $this->Auth->user('username')."{".getIP() ."}[INSERCION]'||now()) as ultimo");
            if($db->lastError()==null){
            $_SESSION['mensaje']='Se agrego correctamente el pedido_1';           
            $this->redirect(array('action' => 'det/'.$valor[0][0]['ultimo']));
            }else{
            $errorCompleto = $db->lastError();
            //$this->PedidoVenta->CapturarError("Solicitudes TCCP - Agregar Solicitante", $this->Auth->user('username'));
            $_SESSION['mensaje']= trim($errorCompleto, "' in C");
            $this->redirect(array('action' => 'index'));                 
            }
        }

    } 
    function det(){
        $this->layout = 'ajax';
        $db = ConnectionManager::getDataSource('default');
        Configure::write('debug', 2);
        if ($this->request->is('get')) {
            //debug($this->params['pass'][0]);
                $this->set('consultas',$this->PedidoVenta->query("select * from v_pedido_ventas where ped_cod =".$this->params['pass'][0]));        
                $this->set('articulos',$this->PedidoVenta->query("select * from v_articulos"));        
                $this->set('detalles',$this->PedidoVenta->query("select * from v_detalle_pventas where ped_cod =".$this->params['pass'][0]));        
        } 
        if ($this->request->is('post')) {

            $valor=$this->PedidoVenta->query("select sp_pedidos(4,".$this->data['PedidoVenta']['pedido'].",0,0,0,'',split_part('".$this->data['PedidoVenta']['articulo']."','_',1)::integer,".$this->data['PedidoVenta']['cantidad'].",".str_replace('.', '',$this->data['PedidoVenta']['precio']).",'". $this->Auth->user('username')."{".getIP() ."}[INSERTAR DET]'||now()) as ultimo");
            if($db->lastError()==null){
            $_SESSION['mensaje']='Se agrego correctamente el item_1';           
            $this->redirect(array('action' => 'detalles/'.$valor[0][0]['ultimo']));   
            }else{
            $errorCompleto = $db->lastError();
            //$this->PedidoVenta->CapturarError("Solicitudes TCCP - Agregar Solicitante", $this->Auth->user('username'));
            $_SESSION['mensaje']= trim($errorCompleto, "' in C");
            $this->redirect(array('action' => 'index/'.$this->data['PedidoVenta']['pedido']));                 
            }
        }        
        
    }
    function detalles(){
        $this->layout = 'ajax';
        $this->set('detalles',$this->PedidoVenta->query("select * from v_detalle_pventas where ped_cod =".$this->params['pass'][0])); 
    }
    function add_cli(){
        $this->layout = 'ajax';
        $db = ConnectionManager::getDataSource('default');
        Configure::write('debug', 2);
        if ($this->request->is('get')) {
            $this->set('tipos',$this->PedidoVenta->query("select a.enumlabel::varchar as tipo_cliente
            from pg_enum a join pg_type t on a.enumtypid = t.oid 
            where t.typname = 'tipo_cliente'"));    
        } 
        if ($this->request->is('post')) {          
            $valor=$this->PedidoVenta->query("select sp_clientes(1,0,'".$this->data['PedidoVenta']['ci']."','".$this->data['PedidoVenta']['nombres']."','".$this->data['PedidoVenta']['apellidos']."',null,null,null,null,null,null,0,0,'". $this->Auth->user('username')."{".getIP() ."}[INSERCION]'||now(),'".$this->data['PedidoVenta']['tipo']."') as ultimo");
            if($db->lastError()==null){
            $_SESSION['mensaje']='Se agrego correctamente el cliente_1';           
            $this->redirect(array('action' => 'clientes/'.$valor[0][0]['ultimo']));   
            }else{
            $errorCompleto = $db->lastError();
            //$this->PedidoVenta->CapturarError("Solicitudes TCCP - Agregar Solicitante", $this->Auth->user('username'));
            $_SESSION['mensaje']= trim($errorCompleto, "' in C");
            $this->redirect(array('action' => 'clientes/0'));                 
            }
        }                
    }    
    function clientes(){
        $this->layout = 'ajax';
         $this->set('clientes',$this->PedidoVenta->query("select * from v_clientes order by id_cliente =".$this->params['pass'][0]." desc")); 
    }
    function det_edit(){
        $this->layout = 'ajax';
        $db = ConnectionManager::getDataSource('default');
        Configure::write('debug', 2);
        if ($this->request->is('get')) {
           // debug($this->params['pass'][0]);
                $this->set('pedido_detalle',$this->PedidoVenta->query("select * from v_detalle_pventas where ped_cod =".$this->params['pass'][0]." and art_cod=".$this->params['pass'][1]));               
        } 
        if ($this->request->is('post')) {

            $valor=$this->PedidoVenta->query("select sp_pedidos(5,".$this->data['PedidoVenta']['pedido'].",0,0,0,'',".$this->data['PedidoVenta']['articulo'].",".$this->data['PedidoVenta']['cantidad'].",".str_replace('.', '',$this->data['PedidoVenta']['precio']).",'". $this->Auth->user('username')."{".getIP() ."}[EDITAR DET]'||now()) as ultimo");
            if($db->lastError()==null){
            $_SESSION['mensaje']='Se actualizo correctamente el item_2';           
            $this->redirect(array('action' => 'detalles/'.$valor[0][0]['ultimo']));   
            }else{
            $errorCompleto = $db->lastError();
            //$this->PedidoVenta->CapturarError("Solicitudes TCCP - Agregar Solicitante", $this->Auth->user('username'));
            $_SESSION['mensaje']= trim($errorCompleto, "' in C");
            $this->redirect(array('action' => 'index/'.$this->data['PedidoVenta']['pedido']));                 
            }
        }        
        
    }   
    function det_del(){
        $this->layout = 'ajax';
        $db = ConnectionManager::getDataSource('default');
        Configure::write('debug', 2);
        if ($this->request->is('get')) {
           // debug($this->params['pass'][0]);
                $this->set('pedido_detalle',$this->PedidoVenta->query("select * from v_detalle_pventas where ped_cod =".$this->params['pass'][0]." and art_cod=".$this->params['pass'][1]));               
        } 
        if ($this->request->is('post')) {

            $valor=$this->PedidoVenta->query("select sp_pedidos(6,".$this->data['PedidoVenta']['pedido'].",0,0,0,'',".$this->data['PedidoVenta']['articulo'].",null,null,'". $this->Auth->user('username')."{".getIP() ."}[BORRAR DET]'||now()) as ultimo");
            if($db->lastError()==null){
            $_SESSION['mensaje']='Se quito correctamente el item_3';           
            $this->redirect(array('action' => 'detalles/'.$valor[0][0]['ultimo']));   
            }else{
            $errorCompleto = $db->lastError();
            //$this->PedidoVenta->CapturarError("Solicitudes TCCP - Agregar Solicitante", $this->Auth->user('username'));
            $_SESSION['mensaje']= trim($errorCompleto, "' in C");
            $this->redirect(array('action' => 'index/'.$this->data['PedidoVenta']['pedido']));                 
            }
        }        
        
    }    
}

?>