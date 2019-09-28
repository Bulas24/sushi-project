<?php


namespace app\controllers\admin;


use app\models\admin\Product;
use app\models\AppModel;
use ishop\App;
use ishop\libs\Pagination;

class ProductController extends AppController
{
        public function indexAction()
        {
            $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
            $perpage = 10;
            $count = \R::count('product');
            $pagination = new Pagination($page, $perpage, $count);
            $start = $pagination->getStart();

            $products = \R::getAll("SELECT product.*, category.title AS cat FROM product
                    JOIN category ON category.id = product.category_id ORDER BY product.category_id LIMIT $start, $perpage");
            $this->setMeta('Список товаров');
            $this->set(compact('products', 'pagination', 'count'));
        }

        public function addImageAction()
        {
            if (isset($_GET['upload'])){
                if ($_POST['name'] == 'single'){
                    $wmax = App::$app->getProperty('img_width');
                    $hmax = App::$app->getProperty('img_height');
                }else{
                    $wmax = App::$app->getProperty('gallery_width');
                    $hmax = App::$app->getProperty('gallery_height');
                }
                $name = $_POST['name'];
                $product = new Product();
                $product->uploadImg($name, $wmax, $hmax);

            }
        }

        public function editAction()
        {
            if (!empty($_POST)){
                $id = $this->getRequestID(false);
                $product = new Product();
                $data = $_POST;
                $product->load($data);
                $product->attributes['status'] = $product->attributes['status'] ? '1' : '0';
                $product->attributes['hit'] = $product->attributes['hit'] ? '1' : '0';
                $product->getImg();

                if (!$product->validate($data)){
                    $product->getErrors();
                    redirect();
                }

                if ($product->update('product', $id)){
                    $product->editFilter($id, $data);
//                    $product->editRelatedProduct($id, $data);
                    $product->editModif($id,$data);
                    $product->editProdContent($id,$data);
//                    $product->saveGallery($id);
                    $alias = AppModel::createAlias('product', 'alias', $data['title'], $id);
                    $product = \R::load('product', $id);
                    $product->alias = $alias;
                    \R::store($product);
                    $_SESSION['success'] = 'Изменения сохранены';
                }
                redirect(ADMIN.'/product');

            }
            $id = $this->getRequestID();
            $product = \R::load('product', $id);
            App::$app->setProperty('parent_id', $product->category_id);
            $modif = \R::getAll("SELECT * FROM modification WHERE product_id = ?", [$id]);
            $prod_cont = \R::getAll("SELECT * FROM prod_content WHERE product_id = ?", [$id]);
            $filter = \R::getCol('SELECT attr_id FROM attribute_product WHERE product_id = ?', [$id]);
//            $related_product = \R::getAll("SELECT related_product.related_id, product.title
//                    FROM related_product JOIN product ON product.id = related_product.related_id
//                    WHERE related_product.product_id = ?", [$id]);
//            $gallery = \R::getCol('SELECT img FROM gallery WHERE product_id = ?', [$id]);
            $this->setMeta("Редактирование товара {$product->title}");
            $this->set(compact('product', 'filter', 'related_product', 'gallery','modif','prod_cont'));
        }

        public function addAction()
        {
            if (!empty($_POST)){
                $product = new Product();
                $data = $_POST;
                $product->load($data);
                $product->attributes['status'] = $product->attributes['status'] ? '1' : '0';
                $product->attributes['hit'] = $product->attributes['hit'] ? '1' : '0';
                $product->getImg(1);

                if (!$product->validate($data)){
                    $product->getErrors();
                    $_SESSION['form_data'] = $data;
                    redirect();
                }

                if ($id = $product->save('product')){
//                    $product->saveGallery($id);
                    $alias = AppModel::createAlias('product', 'alias', $data['title'], $id);
                    $prod = \R::load('product', $id);
                    $prod->alias = $alias;
                    \R::store($prod);
                    $product->editFilter($id, $data);
//                    $product->editRelatedProduct($id, $data);
                    $product->editModif($id,$data);
                    $product->editProdContent($id,$data);
                    $_SESSION['success'] = 'Товар добавлен';
                }
                redirect(ADMIN.'/product');
            }
            $this->setMeta('Новый товар');
        }

        public function relatedProductAction()
        {
            $q = isset($_GET['q']) ? $_GET['q'] : '';
            $data['items'] = [];
            $products = \R::getAssoc('SELECT id, title FROM product WHERE title LIKE ? LIMIT 10', ["%{$q}%"]);
            if ($products){
                $i = 0;
                foreach ($products as $id => $title){
                    $data['items'][$i]['id'] = $id;
                    $data['items'][$i]['text'] = $title;
                    $i++;
                }
            }
            echo json_encode($data);
            die;
        }

        public function deleteGalleryAction()
        {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $src = isset($_POST['src']) ? $_POST['src'] : null;
            if (!$id || !$src){
                return;
            }
            if (\R::exec("DELETE FROM gallery WHERE product_id = ? AND img = ?", [$id, $src])){
                    @unlink(WWW."/images/{$src}");
                    exit('1');
            }
            return;
        }

        public function deleteImgAction()
        {
            $id = isset($_POST['id']) ? $_POST['id'] : null;
            $src = isset($_POST['src']) ? $_POST['src'] : null;
            $newsrc = "no_image.jpg";
            if (!$id || !$src){
                return;
            }
            if (\R::exec("UPDATE product SET img = ? WHERE id = ?", [$newsrc, $id])){
                @unlink(WWW."/images/{$src}");
                exit('1');
            }
            return;
        }

    public function deleteAction()
    {
        $product_id = $this->getRequestID();
        $product = \R::load('product', $product_id);
        $gallery = \R::find('gallery', "product_id = ?", [$product_id]);
        if (!$product){
            throw new \Exception('Страница не найдена', 404);
        }
        if ($product->status == '1'){
            $_SESSION['error'] = 'Нельзя удалить товар, который в наличии';
            redirect();
        }

        \R::exec("DELETE FROM attribute_product WHERE product_id = ?", [$product_id]);
        if (\R::exec("DELETE FROM gallery WHERE product_id = ?", [$product_id])){
                    foreach ($gallery as $item){
                        @unlink(WWW."/images/{$item['img']}");
                    }
        }
        \R::exec("DELETE FROM modification WHERE product_id = ?", [$product_id]);
        \R::exec("DELETE FROM prod_content WHERE product_id = ?", [$product_id]);
        \R::exec("DELETE FROM related_product WHERE product_id = ?", [$product_id]);
        if (\R::exec("DELETE FROM product WHERE id = ?", [$product_id])){
            if ($product->img != 'no_image.jpg'){
                @unlink(WWW."/images/{$product->img}");
            }
        }

        $_SESSION['success'] = 'Товар удален';
        redirect();
    }

}