<?php

class  CajasController  extends AppController {

    public $helper = array('Html', 'Form', 'Javascript', 'Paginator', 'Session');
    public $components = array('RequestHandler', 'Session');

    public function index() {
        if ($this->request->is('get')) {            
            $this->set('cajas', $this->Caja->query("select * from v_cajas where id_caja > 0 order by caja_nomb"));
            $this->set('sucursal', $this->Caja->query("select * from sucursales where id_sucursal =".$this->Auth->user('id_sucursal')));
        }
    }

    function add(){
        $db = ConnectionManager::getDataSource('default');
        Configure::write('debug', 2);
        
        if ($this->request->is('post')) {

            $this->Caja->query("select sp_abm_cajas(1,0,'".$this->data['caja_nomb']."',".$this->Auth->user('id_sucursal').")");
            if($db->lastError()==null){
            $_SESSION['mensaje']='Se agrego correctamente la caja_1';           
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
                $this->Caja->query("select sp_abm_cajas(2,".$this->data['id_caja'].",'".$this->data['caja_nomb']."',".$this->Auth->user('id_sucursal').")");
                $_SESSION['mensaje']='Se actualizo correctamente la caja_2'; 
                $this->redirect(array('action' => 'index'));
            } catch (Exception $ex) {
                $dat = explode(":", $ex);
                $_SESSION['mensaje']= trim($dat[3], "' in C");
//                $this->Session->setFlash(__($e, true));
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    function delete() {
        if ($this->request->is('get')) {
            try {
                $this->Caja->query("select sp_abm_cajas(3,".$this->params['pass'][0].",'".$this->params['pass'][1]."',".$this->Auth->user('id_sucursal').")");
                $_SESSION['mensaje']='Se borro correctamente la caja_3'; 
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
        $this->set('consultas', $this->Caja->query("select * from v_cajas"));
                       
            //Configure::write('debug', 2);
            $this->layout = 'pdf'; //this will use the pdf.ctp layout
            // Operaciones que deseamos realizar y variables que pasaremos a la vista.
            $this->render();
        }

}    
}

?>