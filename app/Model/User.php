<?php
class User extends AppModel {
    //public $name = 'UserAlum';
    public $displayField = 'name';

    public $validate = array(

            'username'=>array(
                            'The username must be between 5 and 15 characters.'=>array(
                                            'rule'=>array('between', 5, 15),
                                            'message'=>'The username must be between 5 and 15 characters.'
                            ),
                            'That username has already been taken'=>array(
                                            'rule'=>'isUnique',
                                            'message'=>'That username has already been taken.'
                            )
            ),
            'password'=>array(
                            'Not empty'=>array(
                                            'rule'=>'notEmpty',
                                            'message'=>'Please enter your password'
                            )
//                ,
//                            'Match passwords'=>array(
//                                            'rule'=>'matchPasswords',
//                                            'message'=>'Your passwords do not match'
//                            )
            )
    );

//    public function matchPasswords($data) {
//        if ($data['password'] == $this->data['User']['password_confirmation']) {
//            return true;
//        }
//        $this->invalidate('password_confirmation', 'Your passwords do not match');
//        return false;
//    }

    public function beforeSave($options=null) {
        if (isset($this->data['User']['password'])) {
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
        return true;
    }
}
?>
