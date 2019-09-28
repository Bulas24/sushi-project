<?php


namespace app\controllers\admin;


use app\models\admin\Currency;

class CurrencyController extends AppController
{
        public function indexAction()
        {
            $currencies = \R::findAll('currency');
            $this->setMeta('Список валют');
            $this->set(compact('currencies'));
        }

        public function addAction()
        {
            if (!empty($_POST)){
                $currency = new Currency();
                $data = $_POST;
                $currency->load($data);
                $currency->attributes['base'] = $currency->attributes['base'] ? '1' : '0';
                if (!$currency->validate($data)){
                    $currency->getErrors();
                    redirect();
                }
                if ($currency->save('currency')){
                    $_SESSION['success'] = 'Валюта добавлена';
                }
                redirect(ADMIN.'/currency');
            }
            $this->setMeta('Добавление валюты');
        }

        public function editAction()
        {
            if (!empty($_POST)){
                $id = $this->getRequestID(false);
                $currency = new Currency();
                $data = $_POST;
                $currency->load($data);
                $currency->attributes['base'] = $currency->attributes['base'] ? '1' : '0';
                if (!$currency->validate($data)){
                    $currency->getErrors();
                    redirect();
                }
                if ($currency->update('currency', $id)){
                    $_SESSION['success'] = 'Изменения сохранены';
                }
                redirect(ADMIN.'/currency');
            }
            $id = $this->getRequestID();
            $currency = \R::load('currency', $id);
            $this->setMeta("Редактирование группы {$currency->code}");
            $this->set(compact('currency'));
        }

        public function deleteAction()
        {
            $id = $this->getRequestID();
            \R::exec("DELETE FROM currency WHERE id = ?", [$id]);
            $_SESSION['success'] = 'Валюта удалена';
            redirect();
        }
}