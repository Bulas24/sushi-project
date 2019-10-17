<?php


namespace app\controllers\manager;


use app\models\User;
use ishop\libs\Pagination;

class UserController extends AppController
{

    public function indexAction()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 10;
        $count = \R::count('user');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();
        $users = \R::findAll('user', "LIMIT $start, $perpage");
        $this->setMeta('Список всех пользователей');
        $this->set(compact('users', 'pagination', 'count'));
    }

    public function editAction()
    {
        if (!empty($_POST)){
            $id = $this->getRequestID(false);
            $user = new \app\models\manager\User();
            if (empty($_POST['login'])){
                unset($_POST['login']);
            }
            $data = $_POST;
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
            $isAdmin = \R::load('user',$id);
            if ($isAdmin->role == 'admin'){
                $_SESSION['error'] = 'Нельзя изменить администратора';
                redirect(MANAGER.'/user');
            }
            if ($user->update('user', $id)){
                $_SESSION['success'] = 'Изменения сохранены';
            }
            redirect(MANAGER.'/user');
        }
        $user_id = $this->getRequestID();
        if ($user_id != $_SESSION['user']['id']){
            $_SESSION['error'] = 'Нельзя изменить другого пользователя';
            redirect(MANAGER);
        }
        $user = \R::load('user', $user_id);
        if (!$user){
            throw new \Exception('Страница не найдена', 404);
        }


        $this->setMeta('Редактирование профиля пользователя');
        $this->set(compact('user'));
    }

    public function loginManagerAction()
        {
            if (!empty($_POST)){
                $user = new User();
                if (!$user->login(false,true)){
                    $_SESSION['error'] = 'Логин/пароль введены неверно';
                }
                if (User::isManager()){
                    redirect(MANAGER);
                }else{
                    redirect();
                }
            }
            $this->layout = 'loginManager';
            $this->setMeta('Вход');
        }

}