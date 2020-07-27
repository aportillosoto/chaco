<?php

class CiudadsController extends AppController {

    public $helper = array('Html', 'Form', 'Javascript', 'Paginator', 'Session');
    public $components = array('RequestHandler', 'Session');

    public function index() {
        $this->layout = "bootstrap";
        if ($this->request->is('get')) {
            $ciudades = $this->Ciudad->query("select * from v_ciudads where id_ciud > 0 order by nombre_ciud");
            $this->set('ciudades', $ciudades);
            $this->set('paises', $this->Ciudad->query("select * from pais where id_pais > 0"));
        }
        if ($this->request->is('post')) {
            $ciudades = $this->Ciudad->query("select * from ciudads where id_ciud > 0 and nombre_ciud ilike trim('%" . $this->data['buscar'] . "%')");
            $this->set('ciudades', $ciudades);
        }
    }

    function add(){
        $db = ConnectionManager::getDataSource('default');
        Configure::write('debug', 2);
        
        if ($this->request->is('post')) {

            $this->Ciudad->query("select sp_abm_ciudades(1,0,'".$this->data['nombre_ciud']."',".$this->data['id_pais'].")");
            if($db->lastError()==null){
            $_SESSION['mensaje']='Se agrego correctamente la ciudad_1';           
            $this->redirect(array('action' => 'index'));
            }else{
            $errorCompleto = $db->lastError();
            //$this->PedidoVenta->CapturarError("Solicitudes TCCP - Agregar Solicitante", $this->Auth->user('username'));
            $_SESSION['mensaje']= trim($errorCompleto, "' in C");
            $this->redirect(array('action' => 'index'));                 
            }
        }

    }

    function edit() {        
        if ($this->request->is('post')) {
            try {
                $this->Ciudad->query("select sp_abm_ciudades(2,".$this->data['id_ciud'].",'".$this->data['nombre_ciud']."',".$this->data['id_pais'].")");
                $_SESSION['mensaje']='Se actualizo correctamente la ciudad_2'; 
                $this->redirect(array('action' => 'index'));
            } catch (Exception $ex) {
                $dat = explode(":", $ex);
                //$this->Session->setFlash(__(trim($dat[3], "' in C"), true));
                $this->Session->setFlash('<span class="glyphicon glyphicon-remove"></span>   ' . trim($dat[3], "' in C"), 'default', array('class' => 'alert alert-danger'));
//                $this->Session->setFlash(__($e, true));
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    function delete() {
        if ($this->request->is('get')) {
            try {
                $this->Ciudad->query("select sp_abm_ciudades(3,".$this->params['pass'][0].",'".$this->params['pass'][1]."',0)");
                $_SESSION['mensaje']='Se borro correctamente la ciudad_3'; 
                $this->redirect(array('action' => 'index'));
            } catch (Exception $ex) {
                $dat = explode(":", $ex);
                //$this->Session->setFlash(__(trim($dat[3], "' in C"), true));                
                $_SESSION['mensaje']= trim($dat[3], "' in C");
                $this->redirect(array('action' => 'index'));
            }
        }
    }
    function print(){        
        if ($this->request->is('get')) {
        $this->set('consultas', $this->Ciudad->query("select * from v_ciudads where id_ciud > 0"));
                       
            //Configure::write('debug', 2);
            $this->layout = 'pdf'; //this will use the pdf.ctp layout
            // Operaciones que deseamos realizar y variables que pasaremos a la vista.
            $this->render();
        }

}     
}

?>