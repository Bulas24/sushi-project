<?php


namespace app\controllers\admin;


use app\models\admin\Banner;
use app\models\AppModel;
use ishop\App;
use ishop\libs\Pagination;

class BannerController extends AppController
{
        public function indexAction()
        {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perpage = 5;
            $count = \R::count('banners');
            $pagination = new Pagination($page, $perpage, $count);
            $start = $pagination->getStart();

            $banners = \R::getAll("SELECT * FROM banners LIMIT $start, $perpage");
            $this->setMeta('Список всех баннеров');
            $this->set(compact('banners', 'pagination', 'count'));
        }

    public function addAction()
    {
        if (!empty($_POST)){
            $banner = new Banner();
            $data = $_POST;
            $banner->load($data);
            $banner->getImg(1);

            if (!$banner->validate($data)){
                $banner->getErrors();
                $_SESSION['form_data'] = $data;
                redirect();
            }

            if ($id = $banner->save('banners')){
                $_SESSION['success'] = 'Баннер добавлен';
            }
            redirect(ADMIN.'/banner');
        }
        $this->setMeta('Новый баннер');
    }

    public function addImageAction()
    {
        if (isset($_GET['upload'])){
            if ($_POST['name'] == 'single'){
                $wmax = App::$app->getProperty('banner_width');
                $hmax = App::$app->getProperty('banner_height');
            }else{
                $wmax = App::$app->getProperty('gallery_width');
                $hmax = App::$app->getProperty('gallery_height');
            }
            $name = $_POST['name'];
            $banner = new Banner();
            $banner->uploadImg($name, $wmax, $hmax);

        }
    }

    public function deleteImgAction()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $src = isset($_POST['src']) ? $_POST['src'] : null;
        $newsrc = "no_image.jpg";
        if (!$id || !$src){
            return;
        }
        if (\R::exec("UPDATE banners SET img = ? WHERE id = ?", [$newsrc, $id])){
            @unlink(WWW."/images/{$src}");
            exit('1');
        }
        return;
    }

    public function deleteAction()
    {
        $banner_id = $this->getRequestID();
        $banner = \R::load('banners', $banner_id);
        if (!$banner){
            throw new \Exception('Страница не найдена', 404);
        }
        if (\R::exec("DELETE FROM banners WHERE id = ?", [$banner_id])){
            if ($banner->img != 'no_image.jpg'){
                @unlink(WWW."/images/{$banner->img}");
            }
        }

        $_SESSION['success'] = 'Баннер удален';
        redirect();
    }

    public function editAction()
    {
        if (!empty($_POST)){
            $id = $this->getRequestID(false);
            $banner = new Banner();
            $data = $_POST;
            $banner->load($data);
            $banner->getImg();

            if (!$banner->validate($data)){
                $banner->getErrors();
                redirect();
            }

            if ($banner->update('banners', $id)){
                $_SESSION['success'] = 'Изменения сохранены';
            }
            redirect(ADMIN.'/banner');
        }
        $id = $this->getRequestID();
        $banner = \R::load('banners', $id);
        $this->setMeta("Редактирование баннера {$banner->title}");
        $this->set(compact('banner'));
    }
}