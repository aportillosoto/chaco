<?php

class AppController extends Controller {

    public $uses = array('User');
    public $components = array(
        'Session',
        'Auth' => array(
            'loginRedirect' => array('controller' => 'pages', 'action' => 'display', 'home'),
//                            'loginRedirect'=>array('controller'=>'movimientos', 'action'=>'principal'),
            'logoutRedirect' => array('controller' => 'users', 'action' => 'login'),
            'authError' => "No puedes tener acceso a esta página",
            'loginError' => "El nombre de usuario y/o la contraseña
                            no son correctos. Por favor, inténtalo otra vez",
        //'authenticate' =>array('Form'=>array('scope'=>array('User.usu_estado'=>'ACTIVO'))),
        //,'authorize'=>array('Controller')
        )
    );

    public function beforeFilter() {
        $this->Auth->allow('logout', 'forgotpassword','resetpassword');
        if (!empty($this->Auth->user('username'))) {        
		 //Security::setHash('md5');
        $datos=  $this->User->query("select a.id,username,estado,a.id_funcio,b.fun_ci,fun_nombre,fun_apelli,fun_email,fun_foto,d.gru_descri from users a
        join funcionarios b on a.id_funcio = b.id_funcio
        left join grupos d on a.id_grupo=d.id_grupo
        where username='".$this->Auth->user('username')."'");
        $this->set('usuario', $this->Auth->user('username'));
        $this->set('datos', $datos);
//        $this->set('usufoto', $this->Auth->user('usu_foto'));
        //$this->set('usuadmin', $this->Auth->user('usu_admin'));
//        if(!empty($datos)){
//            $cargo=$datos[0][0]['car_nombre'];
//        }else{
//            $cargo=null;
//        }
//        $this->set('cargo', $cargo);
        if ($this->Auth->user('usu_admin') == true) {//SI EL USUARIO ES ADMINISTRADOR
            $modulos = $this->User->query("select distinct on(mod_descri)* from modulos a
            join paginas b on a.id_mod=b.id_mod
            order by mod_descri");

            $interfaces = array();

            foreach ($modulos as $modulo) {
                $ind = $modulo[0]['mod_descri'];
                $val = $this->User->query("select * from paginas a "
                        . "join modulos b on a.id_mod=b.id_mod where mod_descri='" . $ind . "' "
                        . "order by pag_descri");
                $interfaces[$ind] = $val;
            }
            $this->set('interfaces', $interfaces);
        } else {//SI EL USUARIO NO ES ADMINISTRADOR
           // $modulos = $this->User->query("select distinct on(a.id_mod)* from modulos a
           // join paginas b on a.id_mod=b.id_mod");
            $modulos = $this->User->query("select * from sp_verpermisos('".$this->Auth->user('username')."',1,'','')as (mod_descri character varying) order by mod_descri");
            $interfaces = array();

            foreach ($modulos as $modulo) {
                $ind = $modulo[0]['mod_descri'];
                /*$val = $this->User->query("select * from paginas a join "
                        . "modulos b on a.id_mod=b.id_mod where mod_descri='" . $ind . "'");*/
                $val = $this->User->query("select * from sp_verpermisos('".$this->Auth->user('username')."',2,'$ind','')as (mod_descri character varying,pag_descri character varying,nomb_menu character varying,leer character varying,insertar character varying, editar character varying,borrar character varying) order by nomb_menu ");                
                $interfaces[$ind] = $val;
                //$_SESSION[$interfaces[$ind]] = $val;
            }
            $this->set('interfaces', $interfaces);
           //debug($interfaces);
        }

        $this->Auth->authenticate = array(
            AuthComponent::ALL => array('userModel' => 'User', 'scope' => array("User.estado" => 'ACTIVO')),
            'Form');            
        }

    }

}
