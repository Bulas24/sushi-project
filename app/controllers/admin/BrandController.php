<?php


namespace app\controllers\admin;


use app\models\admin\Brand;
use app\models\AppModel;
use ishop\App;
use ishop\libs\Pagination;

class BrandController extends AppController
{
        public function indexAction()
        {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perpage = 5;
            $count = \R::count('brand');
            $pagination = new Pagination($page, $perpage, $count);
            $start = $pagination->getStart();

            $brands = \R::findAll('brand', "LIMIT $start, $perpage");

            $this->setMeta('Список брендов');
            $this->set(compact('brands', 'pagination', 'count'));
        }

        public function editAction()
        {
            if (!empty($_POST)){
                $id = $this->getRequestID(false);
                $brand = new Brand();
                $data = $_POST;
                $brand->load($data);
                $brand->getImg();
                if (!$brand->validate($data)){
                    $brand->getErrors();
                    redirect();
                }
                if ($brand->update('brand', $id)){
                    $brand->saveGallery($id);
                    $alias = AppModel::createAlias('brand', 'alias', $data['title'], $id);
                    $brand = \R::load('brand', $id);
                    $brand->alias = $alias;
                    \R::store($brand);
                    $_SESSION['success'] = 'Изменения сохранены';
                }
                redirect(ADMIN.'/brand');
            }

            $id = $this->getRequestID();
            $brand = \R::load('brand' , $id);
            $gallery = \R::getCol('SELECT img FROM gallery_brand WHERE brand_id = ?', [$id]);
            $this->setMeta("Редактирование категории {$brand->title}");
            $this->set(compact('brand', 'gallery'));
        }

        public function deleteAction()
        {
            $id = $this->getRequestID();
            $errors = '';
            $products = \R::count('product', 'brand_id=?', [$id]);
            if ($products){
                $errors .= '<li>Удаление невозможно, в бренде есть товары</li>';
            }
            if ($errors){
                $_SESSION['error'] = "<ul>$errors</ul>";
                redirect();
            }
            $brand = \R::load('brand', $id);
            $gallery = \R::find('gallery_brand', "brand_id = ?", [$id]);
            if (\R::exec("DELETE FROM gallery_brand WHERE brand_id = ?", [$id])){
                foreach ($gallery as $item){
                    @unlink(WWW."/images/{$item['img']}");
                }
            }
            if (\R::exec("DELETE FROM brand WHERE id = ?", [$id])){
                if ($brand->img != 'brand_no_image.jpg'){
                    @unlink(WWW."/images/{$brand->img}");
                }
            }
            $_SESSION['success'] = 'Бренд удален';
            redirect();
        }

    public function deleteGalleryAction()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $src = isset($_POST['src']) ? $_POST['src'] : null;
        if (!$id || !$src){
            return;
        }
        if (\R::exec("DELETE FROM gallery_brand WHERE brand_id = ? AND img = ?", [$id, $src])){
            @unlink(WWW."/images/{$src}");
            exit('1');
        }
        return;
    }

    public function deleteImgAction()
    {
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $src = isset($_POST['src']) ? $_POST['src'] : null;
        $newsrc = "brand_no_image.jpg";
        if (!$id || !$src){
            return;
        }
        if (\R::exec("UPDATE brand SET img = ? WHERE id = ?", [$newsrc, $id])){
            @unlink(WWW."/images/{$src}");
            exit('1');
        }
        return;
    }

        public function addAction()
        {
            if (!empty($_POST)){
                $brand = new Brand();
                $data = $_POST;
                $brand->load($data);
                $brand->getImg(1);
                if (!$brand->validate($data)){
                    $brand->getErrors();
                    redirect();
                }
                if ($id = $brand->save('brand')){
                    $brand->saveGallery($id);
                    $alias = AppModel::createAlias('brand', 'alias', $data['title'], $id);
                    $bran = \R::load('brand', $id);
                    $bran->alias = $alias;
                    \R::store($bran);
                    $_SESSION['success'] = 'Бренд успешно добавлен';
                }
                redirect(ADMIN.'/brand');
            }
            $this->setMeta('Новый бренд');
        }

    public function addImageAction()
    {
        if (isset($_GET['upload'])){
            if ($_POST['name'] == 'single'){
                $wmax = App::$app->getProperty('img_brand_width');
                $hmax = App::$app->getProperty('img_brand_height');
            }else{
                $wmax = App::$app->getProperty('gallery_brand_width');
                $hmax = App::$app->getProperty('gallery_brand_height');
            }
            $name = $_POST['name'];
            $brand = new Brand();
            $brand->uploadImg($name, $wmax, $hmax);

        }
    }


}