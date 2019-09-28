<?php


namespace app\controllers;


use app\models\User;

class UserController extends AppController
{
        public function signupAction()
        {
                if (!empty($_POST)){
                    $user = new User();
                    $data = $_POST;
                    $user->load($data);
                    if (!$user->validate($data) || !$user->checkUnique()){
                        $user->getErrors();
                        $_SESSION['form_data'] = $data;
                    }else{
                        $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                        if ($user->save('user')){
                            $_SESSION['success'] = 'Вы успешно зарегистрированы и авторизованы';
                            if($user->login()){
                                redirect(PATH);
                            }
                        }else{
                            $_SESSION['error'] = 'Ошибка';
                            }
                        }
                    redirect();
                }
                $this->setMeta('Регистрация');

        }

        public function loginAction()
        {
                if (!empty($_POST)){
                    $user = new User();
                    if ($user->login()){
                        $_SESSION['success'] = 'Вы успешно авторизованы';
                        redirect(PATH.'/user/cabinet');
                    }else{
                        $_SESSION['error'] = 'Логин/пароль введены неверно';
                    }
                    if (isset($_SESSION['user'])) redirect(PATH);
                    redirect();

                }

            $this->setMeta('Вход');
        }

        public function logoutAction()
        {
                if (isset($_SESSION['user'])) unset($_SESSION['user']);
                redirect(PATH);
        }

        public function cabinetAction()
        {
            if (!User::checkAuth()) redirect(PATH.'/user/login');
            $this->setMeta('Личный кабинет');

        }

        public function editAction()
        {
            if (!User::checkAuth()) redirect(PATH.'/user/login');
            if (!empty($_POST)){
                $user = new \app\models\admin\User();
                $data = $_POST;
                $data['id'] = $_SESSION['user']['id'];
                $data['role'] = $_SESSION['user']['role'];
                $user->load($data);
                if (!$user->attributes['password']){
                    unset($user->attributes['password']);
                }else{
                    $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                }
                if (!$user->validate($data) || !$user->checkUnique()){
                    $user->getErrors();
                    redirect();
                }
                if ($user->update('user', $_SESSION['user']['id'])){
                    foreach ($user->attributes as $k => $v){
                        if ($k != 'password') $_SESSION['user'][$k] = $v;
                    }
                    $_SESSION['success'] = 'Изменения сохранены';
                }
                redirect(PATH.'/user/cabinet');

            }

            $this->setMeta('Изменение личных данных');

        }

        public function ordersAction()
        {
            if (!User::checkAuth()) redirect(PATH.'/user/login');
            $orders = \R::findAll('order', 'user_id = ?', [$_SESSION['user']['id']]);
            $this->set(compact('orders'));
            $this->setMeta('История заказов');
        }
}