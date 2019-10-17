<?php


namespace app\controllers\admin;


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
            $user = new \app\models\admin\User();
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
            if ($user->update('user', $id)){
                $_SESSION['success'] = 'Изменения сохранены';
            }
            redirect(ADMIN.'/user');
        }
        $user_id = $this->getRequestID();
        $user = \R::load('user', $user_id);
        if (!$user){
            throw new \Exception('Страница не найдена', 404);
        }

        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 3;
        $count = \R::count('order',"user_id = ?", [$user_id]);
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();

        $orders = \R::getAll("SELECT `order`.`id`, `order`.`user_id`, `order`.`status`,
             `order`.`date`, `order`.`update_at`, `order`.`currency`,
             ROUND(SUM(`order_product`.`price`), 2) AS `sum` FROM `order`
             JOIN `order_product` ON `order`.`id` = `order_product`.`order_id`
             WHERE user_id = {$user_id}
             GROUP BY `order`.`id` ORDER BY `order`.`status`, `order`.`id` LIMIT $start, $perpage");

        $this->setMeta('Редактирование профиля пользователя');
        $this->set(compact('user', 'orders', 'pagination', 'count'));
    }

    public function addAction()
    {
        if (!empty($_POST)){
            $user = new \app\models\admin\User();
            if (empty($_POST['login'])){
                unset($_POST['login']);
            }
            if (empty($_POST['password'])){
                unset($_POST['password']);
            }
            $data = $_POST;
            $user->load($data);
            if (!$user->validate($data) || !$user->checkUniqueLog()){
                $user->getErrors();
                $_SESSION['form_data'] = $data;
            }else{
                if (!$user->attributes['password']){
                    unset($user->attributes['password']);
                }else{
                    $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);
                }
                if ($user->save('user')){
                    $_SESSION['success'] = 'Пользователь добавлен';
                        redirect(ADMIN.'/user');

                }else{
                    $_SESSION['error'] = 'Ошибка';
                }
            }
            redirect();
        }
        $this->setMeta('Новый пользователь');
    }

    public function deleteAction()
    {
        $user_id = $this->getRequestID();
        $user = \R::load('user', $user_id);
        $orders = \R::find('order', "user_id = ?", [$user_id]);
        if (!$user){
            throw new \Exception('Страница не найдена', 404);
        }
        if ($user->role == 'admin'){
            $_SESSION['error'] = 'Нельзя удалить администратора';
            redirect();
        }

        \R::trashAll($orders);
        \R::trash($user);
        $_SESSION['success'] = 'Пользователь удален';
        redirect(ADMIN.'/user');
    }


    public function loginAdminAction()
        {
            if (!empty($_POST)){
                $user = new User();
                if (!$user->login(true)){
                    $_SESSION['error'] = 'Логин/пароль введены неверно';
                }
                if (User::isAdmin()){
                    redirect(ADMIN);
                }else{
                    redirect();
                }
            }
            $this->layout = 'loginAdmin';
            $this->setMeta('Вход');
        }

}