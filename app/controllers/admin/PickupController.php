<?php


namespace app\controllers\admin;


use app\models\admin\Pickup;
use ishop\libs\Pagination;

class PickupController extends AppController
{
    public function indexAction()
    {
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $perpage = 5;
        $count = \R::count('pickup_address');
        $pagination = new Pagination($page, $perpage, $count);
        $start = $pagination->getStart();

        $pickup_address = \R::findAll('pickup_address', "LIMIT $start, $perpage");

        $this->setMeta('Список адресов самовывоза');
        $this->set(compact('pickup_address', 'pagination', 'count'));
    }

    public function addAction()
    {
        if(!empty($_POST)){
            $address_pickup = new Pickup();
            $data = $_POST;
            $address_pickup->load($data);
            if (!$address_pickup->validate($data)){
                $address_pickup->getErrors();
                redirect();
            }
            if ($address_pickup->save('pickup_address',false)){
                $_SESSION['success'] = 'Адрес добавлен';
            }
            redirect(ADMIN.'/pickup');
        }

        $this->setMeta('Добавление адреса самовывоза');
    }

    public function deleteAction()
    {
        $id = $this->getRequestID();

        $pickup_address = \R::load('pickup_address', $id);
        \R::trash($pickup_address);

        $_SESSION['success'] = 'Адрес удален';
        redirect();
    }

    public function editAction()
    {
        if(!empty($_POST)){
            $id = $this->getRequestID(false);
            $address_pickup = new Pickup();
            $data = $_POST;
            $address_pickup->load($data);
            if (!$address_pickup->validate($data)){
                $address_pickup->getErrors();
                redirect();
            }
            if ($address_pickup->update('pickup_address',$id)){
                $_SESSION['success'] = 'Адрес изменен';
            }
            redirect(ADMIN.'/pickup');
        }

        $id = $this->getRequestID();
        $address_pickup = \R::load('pickup_address' , $id);
        $this->setMeta("Редактирование адреса {$address_pickup->title}");
        $this->set(compact('address_pickup'));
    }
}