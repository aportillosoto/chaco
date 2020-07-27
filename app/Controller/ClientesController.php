<?php
/* SERVER */
//require ("/var/www/html/sigest/app/Config/config_ip.php");
/* LOCAL */
require ("/wamp64/www/chaco/app/Config/config_ip.php");
class  ClientesController  extends AppController {

    public $helper = array('Html', 'Form', 'Javascript', 'Paginator', 'Session');
    public $components = array('RequestHandler', 'Session');

    public function index() {
        if ($this->request->is('get')) {            
            $this->set('clientes', $this->Cliente->query("select * from v_clientes where id_cliente > 0 order by nombres"));
        }
    }

    function add(){
        $db = ConnectionManager::getDataSource('default');
        Configure::write('debug', 2);
        if ($this->request->is('get')) {
            $this->set('tipos',$this->Cliente->query("select a.enumlabel::varchar as tipo_cliente,current_date as fecha
            from pg_enum a join pg_type t on a.enumtypid = t.oid 
            where t.typname = 'tipo_cliente'"));  
            
            $this->set('genero',$this->Cliente->query("select a.enumlabel::varchar as sexo
            from pg_enum a join pg_type t on a.enumtypid = t.oid 
            where t.typname = 'genero'"));        
            
            $this->set('ciudades', $this->Cliente->query("select * from v_ciudads where id_ciud > 0 order by nombre_ciud"));            
            $this->set('paises', $this->Cliente->query("select * from pais where id_pais > 0 order by gentilicio"));            
        } 
        if ($this->request->is('post')) {          
//((!empty($this->data['DescuentosPersona']['proveedor'])? $this->data['DescuentosPersona']['proveedor']:'null'))            
            try {
                $this->Cliente->query("select sp_clientes(1,0,'".$this->data['Cliente']['ci']."','".(($this->data['Cliente']['tipo']==='FISICA')? $this->data['Cliente']['nombres']:$this->data['Cliente']['razon'])."','".$this->data['Cliente']['apellidos']."','".$this->data['Cliente']['direccion']."','".$this->data['Cliente']['fecnac']."','".$this->data['Cliente']['correo']."','".$this->data['Cliente']['telefono']."',".((!empty($this->data['Cliente']['genero'])? $this->data['Cliente']['genero']:'null')).",null,".((!empty($this->data['Cliente']['residencia'])? $this->data['Cliente']['residencia']:'0')).",".((!empty($this->data['Cliente']['nacionalidad'])? $this->data['Cliente']['nacionalidad']:'0')).",'". $this->Auth->user('username')."{".getIP() ."}[INSERCION]'||now(),'".$this->data['Cliente']['tipo']."') as ultimo");
                $_SESSION['mensaje']='Se agrego correctamente el cliente_1';           
                $this->redirect(array('action' => 'index'));
            } catch (Exception $ex) {
                $dat = explode(":", $ex->getMessage());
                $_SESSION['mensaje'] = trim($dat[3]);
//                $this->Session->setFlash(__($e, true));
                $this->redirect(array('action' => 'index'));
            }            
        }                
    }  

    function edit(){
        $db = ConnectionManager::getDataSource('default');
        Configure::write('debug', 2);
        if ($this->request->is('get')) {            
            $clientes= $this->Cliente->query("select * from clientes where id_cliente=".$this->params['pass'][0]);
            $this->set('clientes', $clientes);            
            $this->set('tipos',$this->Cliente->query("select a.enumlabel::varchar as tipo_cliente,current_date as fecha
            from pg_enum a join pg_type t on a.enumtypid = t.oid 
            where t.typname = 'tipo_cliente' order by a.enumlabel::varchar = '".$clientes[0][0]['tipo_cliente']."' desc"));  
            
            $this->set('genero',$this->Cliente->query("select a.enumlabel::varchar as sexo
            from pg_enum a join pg_type t on a.enumtypid = t.oid 
            where t.typname = 'genero'"));        
            
            $this->set('ciudades', $this->Cliente->query("select * from v_ciudads where id_ciud > 0 order by id_ciud=".$clientes[0][0]['lugar_resid']." desc"));            
            $this->set('paises', $this->Cliente->query("select * from pais where id_pais > 0 order by id_pais =".$clientes[0][0]['id_pais']." desc"));            
        } 
        if ($this->request->is('post')) {          
//((!empty($this->data['DescuentosPersona']['proveedor'])? $this->data['DescuentosPersona']['proveedor']:'null'))            
            try {
                $this->Cliente->query("select sp_clientes(2,".$this->data['Cliente']['id'].",'".$this->data['Cliente']['ci']."','".(($this->data['Cliente']['tipo']==='FISICA')? $this->data['Cliente']['nombres']:$this->data['Cliente']['razon'])."','".$this->data['Cliente']['apellidos']."','".$this->data['Cliente']['direccion']."','".$this->data['Cliente']['fecnac']."','".$this->data['Cliente']['correo']."','".$this->data['Cliente']['telefono']."',".((!empty($this->data['Cliente']['genero'])? $this->data['Cliente']['genero']:'null')).",null,".((!empty($this->data['Cliente']['residencia'])? $this->data['Cliente']['residencia']:'0')).",".((!empty($this->data['Cliente']['nacionalidad'])? $this->data['Cliente']['nacionalidad']:'0')).",'". $this->Auth->user('username')."{".getIP() ."}[INSERCION]'||now(),'".$this->data['Cliente']['tipo']."') as ultimo");
                $_SESSION['mensaje']='Se modifico correctamente el cliente_2';           
                $this->redirect(array('action' => 'index'));
            } catch (Exception $ex) {
                $dat = explode(":", $ex->getMessage());
                $_SESSION['mensaje'] = trim($dat[3]);
//                $this->Session->setFlash(__($e, true));
                //debug($ex);
                $this->redirect(array('action' => 'index'));
            }            
        }                
    } 
    function delete() {
        if ($this->request->is('get')) {
            try {                
                $this->Cliente->query("select sp_clientes(3,".$this->params['pass'][0].",'".$this->params['pass'][1]."','','',null,null,null,null,null,null,0,0,'". $this->Auth->user('username')."{".getIP() ."}[BORRADO]'||now(),null) as ultimo");
                $_SESSION['mensaje']='Se borro correctamente el cliente_3'; 
                $this->redirect(array('action' => 'index'));
            } catch (Exception $ex) {
                $dat = explode(":", $ex->getMessage());
                $_SESSION['mensaje'] = trim($dat[3]);
               $this->redirect(array('action' => 'index'));
            }
        }
    }
    function print(){        
        if ($this->request->is('get')) {
        $this->set('consultas', $this->Cliente->query("select * from v_clientes"));
                       
            //Configure::write('debug', 2);
            $this->layout = 'pdf'; //this will use the pdf.ctp layout
            // Operaciones que deseamos realizar y variables que pasaremos a la vista.
            $this->render();
        }

}    
}

?>