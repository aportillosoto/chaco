<?php

/* SERVER */
require ("/var/www/html/sigest/app/Config/config_ip.php");
/* LOCAL */
//require ("/wamp64/www/sigest/app/Config/config_ip.php");
require("bancard.php");
?>
<?php

class PreCobrosController extends AppController {

    public $helper = array('Html', 'Form', 'Javascript', 'Paginator', 'Session');
    public $components = array('RequestHandler', 'Session');

    public function beforeFilter() {
        parent::beforeFilter();
        //$this->Auth->allow('create', 'confirm', 'reconfirm', 'rollback', 'cancel', 'finish');
        $this->Auth->allow('confirm');
    }
    function index() {

        if ($this->request->is('get')) {
            $consultas = $this->PreCobro->query("select * from v_pre_cobros where alu_cod =" . $this->Auth->user('alu_cod') . " and estado in('PENDIENTE','NO CONFIRMADO') and pre_venc > current_timestamp");            
            if (!empty($consultas)) {
                if ($consultas[0][0]['estado'] === 'PENDIENTE') {
                    $this->redirect(array('action' => 'view'));
                }
                if ($consultas[0][0]['estado'] === 'NO CONFIRMADO') {
                    $this->redirect(array('action' => 'add_transaction'));
                }                
            }else{
                $consultas = $this->PreCobro->query("select * from v_pre_cobros where alu_cod =" . $this->Auth->user('alu_cod') . " and estado in('CONFIRMADO','PAGADO') order by nro_pcobro desc");            
            }
            $this->set('consultas', $consultas);
        }
    }
    public function add_transaction() {
        $this->layout = "bootstrap";
        if ($this->request->is('get')) {
            $sedes = $this->PreCobro->query("select distinct sed_nombre,id_sede,current_date as fecha from public.v_cuentas_pendientes where alu_cod =" . $this->Auth->user('alu_cod') . " and estado='PENDIENTE'");
            $this->set('sedes', $sedes);
            $consultas = $this->PreCobro->query("select * from v_pre_cobros where alu_cod =" . $this->Auth->user('alu_cod') . " and estado in('PENDIENTE','NO CONFIRMADO') and pre_venc > current_timestamp");
            if (!empty($consultas)) {
                $this->set('detalles', $this->PreCobro->query("select * from det_pcobros where nro_pcobro =" . $consultas[0][0]['nro_pcobro'] . " order by nro_cta asc"));
                if ($consultas[0][0]['estado'] === 'PENDIENTE') {
                    $this->redirect(array('action' => 'view'));
                }
            }
            $this->set('consultas', $consultas);
        }
    }

    function view() {

        if ($this->request->is('get')) {
            $consultas = $this->PreCobro->query("select * from v_pre_cobros where alu_cod =" . $this->Auth->user('alu_cod') . " and estado='PENDIENTE' and pre_venc > current_timestamp");
            if (empty($consultas)) {
                $this->redirect(array('action' => 'index'));
            }
            $this->set('consultas', $consultas);
        }
    }

    function details($nro = null) {
        $this->layout = "ajax";
        if ($this->request->is('get')) {
            $this->set('detalles', $this->PreCobro->query("select * from det_pcobros where nro_pcobro =$nro order by nro_cta asc"));
        }
    }

    public function carrera($sed = null) {
        $this->layout = "bootstrap";
        if ($this->request->is('get')) {
            $carreras = $this->PreCobro->query("select distinct nombre_carre,id_carre from public.v_cuentas_pendientes where alu_cod =" . $this->Auth->user('alu_cod') . " and id_sede = $sed and estado='PENDIENTE'");
            $this->set('carreras', $carreras);
        }
    }

    function curso($idcarre = null) {
        $this->layout = 'ajax';
        $this->set('cursos', $this->PreCobro->query("select distinct id_curso, nombre_curso from public.v_cuentas_pendientes where alu_cod = " . $this->Auth->user('alu_cod') . " and id_carre = " . $idcarre . " and estado='PENDIENTE' order by id_curso desc"));
    }

    function cuentas($car = null, $cur = null) {
        $this->layout = 'ajax';
        $persona = $this->PreCobro->query("select per_ci from personas where id_persona =(select id_persona from alumnos where alu_cod =" . $this->Auth->user('alu_cod') . ")");
        $this->set('cuentas', $this->PreCobro->query("select * from v_cuentas_pendientes where per_ci='" . trim($persona[0][0]['per_ci']) . "' and id_carre=" . trim($car) . " and id_curso=" . trim($cur) . " and (estado='PENDIENTE' or estado='NEGOCIADO') and not cta_provision order by fec_venc limit 3"));
        $this->set('ctaant', $this->PreCobro->query("select min(fec_venc)as venc_min from v_cuentas_pendientes where per_ci='" . trim($persona[0][0]['per_ci']) . "' and id_carre=" . trim($car) . " and id_curso=" . trim($cur) . " and (estado='PENDIENTE' or estado='NEGOCIADO') and not cta_provision and tp_aranc=16"));
    }

    function cuentas_1($car = null, $cur = null, $nro = null) {
        $this->layout = 'ajax';
        $persona = $this->PreCobro->query("select per_ci from personas where id_persona =(select id_persona from alumnos where alu_cod =" . $this->Auth->user('alu_cod') . ")");
        $this->set('cuentas', $this->PreCobro->query("select * from v_cuentas_pendientes where per_ci='" . trim($persona[0][0]['per_ci']) . "' and id_carre=" . trim($car) . " and id_curso=" . trim($cur) . " and (estado='PENDIENTE' or estado='NEGOCIADO') and not cta_provision order by fec_venc limit 3"));
        $this->set('ctaant', $this->PreCobro->query("select min(fec_venc)as venc_min from v_cuentas_pendientes where per_ci='" . trim($persona[0][0]['per_ci']) . "' and id_carre=" . trim($car) . " and id_curso=" . trim($cur) . " and (estado='PENDIENTE' or estado='NEGOCIADO') and not cta_provision and tp_aranc=16"));
        $this->set('consultas', $this->PreCobro->query("select * from v_pre_cobros where nro_pcobro = $nro and estado='NO CONFIRMADO'"));
    }

    function add($idcuenta = null) {
        $this->layout = "ajax";
        $db = ConnectionManager::getDataSource('default');
        Configure::write('debug', 0);
        $ip = "'" . getIP() . "'";
        $consultas = $this->PreCobro->query("select id_persona,per_ci,alumno from v_alumnos where alu_cod =" . $this->Auth->user('alu_cod'));

        if ($this->request->is('post')) {
            try {
                $this->PreCobro->query("select public.sp_precobros(1,0,
                                            " . $this->data['PreCobro']['idsede'] . ",'" . $consultas[0][0]['alumno'] . "','" . $consultas[0][0]['per_ci'] . "',
                                            " . $consultas[0][0]['id_persona'] . ",
                                            " . $this->data['PreCobro']['cuenta'] . ",
                                            " . $this->data['PreCobro']['monto'] . ",'[INSERT]ALU:" . $this->Auth->user('username') . "[" . getIP() . "]','')");
                $_SESSION['mensaje'] = 'Se genero correctamente la provisión de pago_1';
                //$this->redirect(array('action' => 'view/'.$this->data['Precobro']['id_contrato']));                                            
                $this->redirect(array('action' => 'add_transaction'));
            } catch (Exception $ex) {
                $dat = explode(":", $ex->getMessage());
                $_SESSION['mensaje'] = trim($dat[3]);
                $this->redirect(array('action' => 'index'));
            }
        }

        if ($this->request->is('get')) {
            $this->set('cuentas', $this->PreCobro->query("select * from v_cuentas_pendientes where nro_cta=$idcuenta"));
        }
    }

    function add_1($idcuenta = null, $nro = null) {
        $this->layout = "ajax";
        $db = ConnectionManager::getDataSource('default');
        Configure::write('debug', 0);
        $ip = "'" . getIP() . "'";
        $consultas = $this->PreCobro->query("select id_persona,per_ci,alumno from v_alumnos where alu_cod =" . $this->Auth->user('alu_cod'));

        if ($this->request->is('post')) {
            try {
                $this->PreCobro->query("select public.sp_precobros(2," . $this->data['PreCobro']['nro'] . ",
                                            " . $this->data['PreCobro']['idsede'] . ",'" . $consultas[0][0]['alumno'] . "','" . $consultas[0][0]['per_ci'] . "',
                                            " . $consultas[0][0]['id_persona'] . ",
                                            " . $this->data['PreCobro']['cuenta'] . ",
                                            " . $this->data['PreCobro']['monto'] . ",'[INSERT]ALU:" . $this->Auth->user('username') . "[" . getIP() . "]','')");
                $_SESSION['mensaje'] = 'Se agrego correctamente la cuenta_1';
                //$this->redirect(array('action' => 'view/'.$this->data['Precobro']['id_contrato']));                                            
                $this->redirect(array('action' => 'add_transaction'));
            } catch (Exception $ex) {
                $dat = explode(":", $ex->getMessage());
                $_SESSION['mensaje'] = trim($dat[3]) . "_3";
                $this->redirect(array('action' => 'add_transaction'));
            }
        }

        if ($this->request->is('get')) {
            $this->set('cuentas', $this->PreCobro->query("select * from v_cuentas_pendientes where nro_cta=$idcuenta"));
            $this->set('consultas', $this->PreCobro->query("select * from v_pre_cobros where nro_pcobro = $nro and estado='NO CONFIRMADO'"));
        }
    }

    function anular($nro = null) {
        $this->layout = "ajax";
        $db = ConnectionManager::getDataSource('default');
        Configure::write('debug', 0);
        $ip = "'" . getIP() . "'";
        $consultas = $this->PreCobro->query("select id_persona,per_ci,alumno from v_alumnos where alu_cod =" . $this->Auth->user('alu_cod'));

        if ($this->request->is('get')) {
            try {
                $this->PreCobro->query("select public.sp_precobros(5," . $nro . ",0,'','',0,0,0,'[ANULAR]ALU:" . $this->Auth->user('username') . "[" . getIP() . "]','')");
                $_SESSION['mensaje'] = 'Se anulo correctamente la provisi&oacute;n de pago_3';
                $this->redirect(array('action' => 'index'));
            } catch (Exception $ex) {
                $dat = explode(":", $ex->getMessage());
                $_SESSION['mensaje'] = trim($dat[3]) . "_3";
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function create($nro = null) {
        $this->layout = "ajax";
        if ($this->request->is('get')) {
            //var_dump($bancard);
            // exit;

            $consultas = $this->PreCobro->query("select * from v_pre_cobros where nro_pcobro = $nro and estado='PENDIENTE' and pre_venc > current_timestamp");
            if (!empty($consultas)) {
                //DEFINIR VARIABLES                    
                $shop_id = $nro;
                $amount = $consultas[0][0]['total'];
                $db = $this->PreCobro;
                $bancard = new Bancard($db);
                $transacciones = $this->PreCobro->query("select id,process_code from transacciones.vpos_transactions where nro_pcobro = $nro and status='pendiente'");

                $this->set('consultas', $consultas);
                //$this->autoRender = false;		
                if (!empty($transacciones)) {
                    //$this->set('resp', $transacciones[0][0]['process_code']);
                    $script = $bancard->getConfirmation($transacciones[0][0]["id"]);
                    if ($script['status'] === "success") {
                        $bancard->confirm($script['confirmation']);
                        if ($script['confirmation']['response_code'] === "00") {
                            $this->redirect(array('action' => 'finish/' . $script['confirmation']['shop_process_id']));
                        }
                    } else {
                        $this->PreCobro->query("update transacciones.vpos_transactions set status = 'cancelado' where id = " . $transacciones[0][0]["id"] . " and status='pendiente'");
                    }
                }
                $script = $bancard->single_buy($amount, $shop_id);
                //echo $script;
                //exit;
                if ($script->status === "success") {
                    $this->set('resp', $script->process_id);
                } else {
                    $_SESSION['mensaje'] = 'No se pudo completar el proceso. Intente nuevamente más tarde';
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $_SESSION['mensaje'] = 'No se pudo completar el proceso. Intente nuevamente más tarde';
                $this->redirect(array('action' => 'index'));
            }
        }
    }
    public function create_zimple($nro = null) {
        $this->layout = "ajax";
        if ($this->request->is('get')) {
            //var_dump($bancard);
            // exit;

            $consultas = $this->PreCobro->query("select * from v_pre_cobros where nro_pcobro = $nro and estado='PENDIENTE' and pre_venc > current_timestamp");
            if (!empty($consultas)) {
                //DEFINIR VARIABLES                    
                $shop_id = $nro;
                $amount = $consultas[0][0]['total'];                
                $phone = $this->PreCobro->query("select trim(per_telmov) as per_telmov from v_alumnos where alu_cod =" . $this->Auth->user('alu_cod'));
                $db = $this->PreCobro;
                $bancard = new Bancard($db);
                $transacciones = $this->PreCobro->query("select id,process_code from transacciones.vpos_transactions where nro_pcobro = $nro and status='pendiente'");

                $this->set('consultas', $consultas);
                //$this->autoRender = false;		
                if (!empty($transacciones)) {
                    //$this->set('resp', $transacciones[0][0]['process_code']);
                    $script = $bancard->getConfirmation($transacciones[0][0]["id"]);
                    if ($script['status'] === "success") {
                        $bancard->confirm($script['confirmation']);
                        if ($script['confirmation']['response_code'] === "00") {
                            $this->redirect(array('action' => 'finish/' . $script['confirmation']['shop_process_id']));
                        }
                    } else {
                        $this->PreCobro->query("update transacciones.vpos_transactions set status = 'cancelado' where id = " . $transacciones[0][0]["id"] . " and status='pendiente'");
                    }
                }
                $script = $bancard->single_buy_zimple($amount, $shop_id,$phone[0][0]['per_telmov']);
                //echo $script;
                //exit;
                if ($script->status === "success") {
                    $this->set('resp', $script->process_id);
                } else {
                    $_SESSION['mensaje'] = 'No se pudo completar el proceso. Intente nuevamente más tarde';
                    $this->redirect(array('action' => 'index'));
                }
            } else {
                $_SESSION['mensaje'] = 'No se pudo completar el proceso. Intente nuevamente más tarde';
                $this->redirect(array('action' => 'index'));
            }
        }
    }
    public function confirmar($nro = null) {
        $this->layout = "ajax";
        $db = ConnectionManager::getDataSource('default');
        Configure::write('debug', 0);
        $ip = "'" . getIP() . "'";
        if ($this->request->is('post')) {
            try {
                $sql = $this->PreCobro->query("select public.sp_precobros(4," . $this->data['PreCobro']['nro'] . ",
                                            0,'" . $this->data['PreCobro']['razon'] . "','" . $this->data['PreCobro']['ruc'] . "',
                                            0,0,0,'[CONFIRMAR]ALU." . $this->Auth->user('username') . "[" . getIP() . "]','".$this->data['PreCobro']['forma']."') as valor");
                switch ($this->data['PreCobro']['forma']) {
                    case 'VPOS':
                    $_SESSION['mensaje'] = 'Se confirmo correctamente la provisión de pago';
                    $this->redirect(array('action' => 'create/' . $sql[0][0]['valor']));
                    break;
                    case 'ZIMPLE':
                    $_SESSION['mensaje'] = 'Se confirmo correctamente la provisión de pago';
                    $this->redirect(array('action' => 'create_zimple/' . $sql[0][0]['valor']));
                    break;
                    default:
                        $_SESSION['mensaje'] = 'Se confirmo correctamente la provisión de pago';
                        $this->redirect(array('action' => 'view'));                        
                        break;
                }
               /* if ($this->data['PreCobro']['forma'] === 'VPOS') {
                    $_SESSION['mensaje'] = 'Se confirmo correctamente la provisión de pago';
                    $this->redirect(array('action' => 'create/' . $sql[0][0]['valor']));
                } else {
                    $_SESSION['mensaje'] = 'Se confirmo correctamente la provisión de pago';
                    $this->redirect(array('action' => 'view'));
                }*/
            } catch (Exception $ex) {
                $dat = explode(":", $ex->getMessage());
                $_SESSION['mensaje'] = trim($dat[3]);
                $this->redirect(array('action' => 'index'));
            }
        }
        if ($this->request->is('get')) {

            $this->set('consultas', $this->PreCobro->query("select * from v_pre_cobros where nro_pcobro = $nro and estado='NO CONFIRMADO'"));
        }
    }

    public function confirm() {
        $this->layout = false;
        $this->autoRender = false;
        $status = 'success';
        $appResponse = array();

        $db = $this->PreCobro;
        $bancard = new Bancard($db);

        // Recuperamos el objeto enviado por Bancard 
        $response = file_get_contents('php://input');

        // Lo convertimos en un array
        $response = json_decode($response, true);

        // Evaluamos el código de respuesta y asignamos un status
        if ($response['operation']['response_code'] == "00") {
            $response['operation']['status'] = "aprobado";
        } else {
            $response['operation']['status'] = "rechazado";
        }
        // Guardamos todos los datos en la base de datos

        $bancard->confirm($response['operation']);


        $appResponse['status'] = $status;


        echo json_encode($appResponse);
        exit;
    }

    public function rollback($id) {
        $this->layout = "ajax";
        //$this->autoRender = false;

        $db = $this->PreCobro;
        $bancard = new Bancard($db);
        $consultas = $this->PreCobro->query("select * from v_pre_cobros where nro_pcobro = $id and estado='CONFIRMADO'");
        if (!empty($consultas)) {
            $transacciones = $this->PreCobro->query("select id,process_code from transacciones.vpos_transactions where nro_pcobro = $id and status='aprobado'");
            if (!empty($transacciones)) {
                $script = $bancard->rollback($transacciones[0][0]['id']);
                //debug($script);
                if ($script["status"]==='success') {
                    $_SESSION['mensaje'] = 'Se revertio correctamente el pago de la provisión';
                } else {
                    $_SESSION['mensaje'] = $script['messages'][0]['dsc'];
                }  
            } else {
                $_SESSION['mensaje'] = 'No se pudo realizar la reversión de pago de la provisión. Favor comunicarse con su sede de origen';
            }
        } else {
            $_SESSION['mensaje'] = 'No se pudo realizar la reversión de pago de la provisión. Favor comunicarse con su sede de origen';
        }

        $this->redirect(array('action' => 'index'));
    }

    public function cancel($id) {
        $this->layout = "ajax";
        $db = $this->Donation;
        $bancard = new Bancard($db);
        $bancard->rollback($id);
        $this->Donation->id = $id;
        $this->Donation->saveField('status', 2);
        // if($status =$bancard -> rollback($id)){
        // debug($status);
        // }
    }

    public function finish($id) {
        $this->layout = "ajax";
        $db = $this->PreCobro;

        $transaccion = $this->PreCobro->query("select * from transacciones.vpos_transactions where id = $id");
        //debug($transaccion);		 

        if (!empty($transaccion)) {
            $this->set('consultas', $this->PreCobro->query("select * from v_pre_cobros where nro_pcobro =" . $transaccion[0][0]['nro_pcobro']));
            $bancard = new Bancard($db);
            $script = $bancard->getConfirmation($id);
            //debug($script);
            if ($script['confirmation']['response_code'] === "00") {
                $this->set('transaccion', $transaccion);
            } else {
                $_SESSION['mensaje'] = 'No se pudo completar el proceso. Intente nuevamente más tarde';
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function editar($nro = null) {
        $this->layout = "ajax";
        $db = ConnectionManager::getDataSource('default');
        Configure::write('debug', 0);
        $ip = "'" . getIP() . "'";
        if ($this->request->is('post')) {
            try {
                $sql = $this->PreCobro->query("select public.sp_precobros(6," . $this->data['PreCobro']['nro'] . ",
                                            0,'" . $this->data['PreCobro']['razon'] . "','" . $this->data['PreCobro']['ruc'] . "',
                                            0,0,0,'[EDICION]ALU." . $this->Auth->user('username') . "[" . getIP() . "]','".$this->data['PreCobro']['forma']."') as valor");
                switch ($this->data['PreCobro']['forma']) {
                    case 'VPOS':
                    $_SESSION['mensaje'] = 'Se confirmo correctamente la provisión de pago';
                    $this->redirect(array('action' => 'create/' . $sql[0][0]['valor']));
                    break;
                    case 'ZIMPLE':
                    $_SESSION['mensaje'] = 'Se confirmo correctamente la provisión de pago';
                    $this->redirect(array('action' => 'create_zimple/' . $sql[0][0]['valor']));
                    break;
                    default:
                        $_SESSION['mensaje'] = 'Se confirmo correctamente la provisión de pago';
                        $this->redirect(array('action' => 'view'));                        
                        break;
                }                
            /*    if ($this->data['PreCobro']['forma'] === 'VPOS') {
                    $_SESSION['mensaje'] = 'Se confirmo correctamente el pago aguarde un momento que cargue el formulario';
                    $this->redirect(array('action' => 'create/' . $sql[0][0]['valor']));
                } else {
                    $_SESSION['mensaje'] = 'Se actualizaron correctamente los datos de la provisión de pago';
                    $this->redirect(array('action' => 'view'));
                }*/
            } catch (Exception $ex) {
                $dat = explode(":", $ex->getMessage());
                $_SESSION['mensaje'] = trim($dat[3]);
                $this->redirect(array('action' => 'index'));
            }
        }
        if ($this->request->is('get')) {
            $this->set('consultas', $this->PreCobro->query("select * from v_pre_cobros where nro_pcobro = $nro and estado='PENDIENTE' and pre_venc > current_timestamp"));
        }
    }

    public function pay($nro = null,$tipo=null) {
        $this->layout = "ajax";
        $db = ConnectionManager::getDataSource('default');
        Configure::write('debug', 0);
        $ip = "'" . getIP() . "'";
        if ($this->request->is('post')) {
            try {
                $sql = $this->PreCobro->query("select public.sp_precobros(6," . $this->data['PreCobro']['nro'] . ",
                                            0,'" . $this->data['PreCobro']['razon'] . "','" . $this->data['PreCobro']['ruc'] . "',
                                            0,0,0,'[EDICION]ALU." . $this->Auth->user('username') . "[" . getIP() . "]','') as valor");

                $_SESSION['mensaje'] = 'Se confirmo correctamente el pago aguarde un momento que cargue el formulario';
                if ($tipo === 'N') {
                    $this->redirect(array('action' => 'create/' . $sql[0][0]['valor']));
                }else{
                    $this->redirect(array('action' => 'create_zimple/' . $sql[0][0]['valor']));
                }
                
            } catch (Exception $ex) {
                $dat = explode(":", $ex->getMessage());
                $_SESSION['mensaje'] = trim($dat[3]);
                $this->redirect(array('action' => 'index'));
            }
        }
        if ($this->request->is('get')) {
            $this->set('consultas', $this->PreCobro->query("select * from v_pre_cobros where nro_pcobro = $nro and estado='PENDIENTE'"));
        }
    }

}

?>