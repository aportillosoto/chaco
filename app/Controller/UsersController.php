<?php

App::uses('CakeEmail', 'Network/Email');

class UsersController extends AppController {

    public $helper = array('Html', 'Form', 'Javascript', 'Paginator', 'Session');
    public $components = array('RequestHandler', 'Session');

    /* Si ya esta en el app controller no es necesario dentro de user
     * public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow('recuperar','logout');
    }*/

    public function isAuthorized($user) {
        if ($user['role'] == 'admin') {
            return true;
        }
        if (in_array($this->action, array('edit', 'delete'))) {
            if ($user['id'] != $this->request->params['pass'][0]) {
                return false;
            }
        }
        return true;
    }

    public function login() {
        $this->layout = "bootstrap";
        Security::setHash('md5');
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $this->redirect($this->Auth->redirect());
            } else {
//                $this->Session->setFlash('El usuario o la contraseña son incorrectos');
                $this->Session->setFlash('<span class="glyphicon glyphicon-remove"></span> Usuario o contraseña incorrectos', 'default', array('class'=>'alert alert-danger'));
            }
        }
    }

    public function logout() {
        $this->redirect($this->Auth->logout());
    }

    public function index() {
        $this->layout = "bootstrap";
        if ($this->request->is('get')) {
            $this->set('usuarios', $this->User->query("select * from v_usuarios limit 5"));
        }
        if ($this->request->is('post')) {
            $this->set('usuarios', $this->User->query("select * from v_usuarios "
                            . "where upper(username) like upper('%" . trim($this->data['User']['buscar']) . "%') limit 5"));
        }
    }

    public function view($id = null) {
        $this->User->id = $id;

        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }

        if (!$id) {
            $this->Session->setFlash('Invalid user');
            $this->redirect(array('action' => 'index'));
        }
        $this->set('user', $this->User->read());
    }

    public function add() {
        $this->layout = "bootstrap";
        if ($this->request->is('post')) {
            try {
                $this->User->save($this->request->data);
//                $this->Session->setFlash('El usuario ha sido registrado');
                $this->Session->setFlash('<span class="glyphicon glyphicon-ok"></span>  El usuario <strong>'.$this->data['User']['username'].'</strong> ha sido registrado exitosamente', 'default', array('class'=>'alert alert-success'));
                $this->redirect(array('action' => 'login'));
            } catch (Exception $ex) {
                $dat = explode(":", $ex);
                $this->Session->setFlash(__(trim($dat[3], "' in C"), true));
                $this->Session->setFlash('<span class="glyphicon glyphicon-remove"></span>  '.trim($dat[3], "' in C"), 'default', array('class'=>'alert alert-danger'));
//                $this->Session->setFlash(__($e, true));
                $this->redirect(array('action' => 'login'));
            }
        }
        if ($this->request->is('get')) {
            
        }
    }

    public function edit($id = null) {
        $this->User->id = $id;

        if (!$this->User->exists()) {
            throw new NotFoundException('Invalid user');
        }

        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash('The user has been saved');
                $this->redirect(array('action' => 'index'));
            } else {
                $this->Session->setFlash('The user could not be saved. Please, try again.');
            }
        } else {
            //$this->request->data = $this->User->read();
            $usuarios = $this->User->query("select * from users where id=" . $id);
            $this->request->data['User']['id'] = $usuarios[0][0]['id'];
            $this->request->data['User']['username'] = $usuarios[0][0]['username'];
            //$this->request->data['User']['password']=$usuarios[0][0]['password'];
            //////////////////COMBO GRUPOS///////////////
            $grupos = $this->User->query("select grup_id,grup_nombre from grupos order by grup_id=" . $usuarios[0][0]['grupo'] . " desc");
            $grup = array();
            foreach ($grupos as $grupo) {
                $inde = $grupo[0]['grup_id'];
                $val = $grupo[0]['grup_nombre'];
                $grup[$inde] = $val;
            }
            $this->set('grupos', $grup);
            /////////////////////////////////////////////
        }
    }

    public function delete($id = null) {
        if ($this->request->is('get')) {
            try {
                $this->User->delete($id);
                $this->Session->setFlash('Usuario borrado exitosamente');
                $this->redirect(array('action' => 'index'));
            } catch (Exception $ex) {
                $dat = explode(":", $ex);
                $this->Session->setFlash(__(trim($dat[3], "' in C"), true));
//                $this->Session->setFlash(__($e, true));
                $this->redirect(array('action' => 'index'));
            }
        }
    }

    public function forgotpassword() {
        $this->layout = "bootstrap";
        if ($this->request->is('post')) {
            try {
                $docente = $this->User->query("select ud.id,ud.id_doc,username,trim(p.per_nombre)||' '||trim(p.per_apelli) as persona,trim(per_email)as per_email from user_docs ud
                join docentes d on ud.id_doc = d.id_doc
                join personas p on d.id_persona = p.id_persona where username ='".$this->data['User']['username']."' and trim(per_email)='".$this->data['User']['correo']."'");
                if(!empty($docente)){
                    $token = $this->User->query("select * from generar_token(".$docente[0][0]['id'].")");
                    if(!empty($token)){
                    //$Email = new CakeEmail();
                        $Email = new CakeEmail('smtp');
                        $Email->emailFormat('html');
                        $Email->to($docente[0][0]['per_email']);
                        $Email->subject('Recuperacion');
                        $Email->send("<strong>Señor:<br>"
						.$docente[0][0]['persona']."</strong><br>
						La Universidad Tecnológica le informa que ha aprobado su solicitud de recuperación de clave de acceso a los servicios para docentes por internet, a través del Sistema SIGESTU.<br>
						La clave tiene carácter personal y es intransferible, razón por la cual, la responsabilidad en el uso adecuado de la misma, radica sólo en usted.
						Antes de la creación de su clave le recomendamos tener en cuenta las siguientes instrucciones:
						<ul>
						<li>No debe contener el nombre de usuario.</li>
						<li>Debe tener al menos 8 (ocho) caracteres.</li>
						<li>Debe contener al menos 1 (una) letra mayúscula y 1 (una) minúscula.</li>
						<li>Debe tener números. </li>
						</ul><br>
						La clave no tiene una cantidad máxima de caracteres, sin embargo le recomendamos crear una que pueda usted memorizar fácilmente.<br>	
						Para recuperar su contraseña ingrese al siguiente enlace <a href='http://www.utic.edu.py/sigest/users/resetpassword/".$token[0][0]['token']."'>Recuperar</a><br>
						<strong>Importante:</strong> El enlace de recuperación posee un periodo de caducidad por ese motivo vuelva a realizar los pasos de recuperación pasado el tiempo de caducidad <br>
						Cordiales Saludos,<br><br>

						<strong>UNIVERSIDAD TECNOLOGICA INTERCONTINENTAL</strong>");                     
                        $this->Session->setFlash('<span class="glyphicon glyphicon-ok"></span>  Se envió el correo de recuperación al correo <strong>'.$this->data['User']['correo'].'</strong>', 'default', array('class'=>'alert alert-info'));                          
                    }
              
                }else{
                    $this->Session->setFlash('<span class="glyphicon glyphicon-info"></span>  No se encontraron datos coincidentes</strong>', 'default', array('class'=>'alert alert-info'));                    
                }
                $this->redirect(array('action' => 'login'));                    
//                $this->Session->setFlash('El usuario ha sido registrado');
            } catch (Exception $ex) {
                $dat = explode(":", $ex);
                $this->Session->setFlash(__(trim($dat[3], "' in C"), true));
                $this->Session->setFlash('<span class="glyphicon glyphicon-remove"></span>  '.trim($dat[3], "' in C"), 'default', array('class'=>'alert alert-danger'));
//                $this->Session->setFlash(__($e, true));
                $this->redirect(array('action' => 'login'));
            }
        }
        if ($this->request->is('get')) {
            
        }
    }

    function resetpassword($val=null){
        $this->layout = "bootstrap";         
        if ($this->request->is('post')) {
                $docente = $this->User->query("select ud.id,ud.id_doc,username,trim(p.per_nombre)||' '||trim(p.per_apelli) as persona,trim(per_email)as per_email from user_docs ud
                join docentes d on ud.id_doc = d.id_doc
                join personas p on d.id_persona = p.id_persona where access_token ='".$this->data['User']['token']."' and createt_token>=current_timestamp - interval '30 min'");            
                if(!empty($docente)){
                    try {
                    $this->User->query("select public.sp_users_docente(2,
                                            " . $docente[0][0]['id'] . ",
                                            '','" . $this->data['User']['password'] . "',0,0)");                        
                        $this->Session->setFlash('<span class="glyphicon glyphicon-info"></span>  Se actualizo correctamente</strong>', 'default', array('class'=>'alert alert-success'));                                        
                    } catch (Exception $ex) {
                        $dat = explode(":", $ex);
                        $this->Session->setFlash('<span class="glyphicon glyphicon-remove"></span>   ' . trim($dat[4], "' in C"), 'default', array('class' => 'alert alert-danger'));
                    }
                }else{
                    $this->Session->setFlash('<span class="glyphicon glyphicon-info"></span>  No se encontraron datos coincidentes</strong>', 'default', array('class'=>'alert alert-info'));                    
                }                                                
                $this->redirect(array('action' => 'login'));
        }
        
       if ($this->request->is('get')) {
                        $datos=$this->User->query("select id,access_token from user_docs
                        where access_token ='".$val."' and createt_token>=current_timestamp - interval '30 min'");
                        if (!empty($datos)) {
                            $this->set('datos',$datos); 
                        }else{
                           $this->Session->setFlash('<span class="glyphicon glyphicon-info"></span>  El enlace ya no se encuentra disponible</strong>', 'default', array('class'=>'alert alert-danger'));                                                                            
                            $this->redirect(array('action' => 'login'));                           
                        }
        }       
    }
}

?>
