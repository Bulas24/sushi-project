<?php


namespace app\models\admin;


use app\models\AppModel;

class Product extends AppModel
{
        public $attributes = [
            'title' => '',
            'category_id' => '',
            'price' => '',
            'old_price' => '',
            'keywords' => '',
            'description' => '',
            'content' => '',
            'status' => '',
            'hit' => '',
            'alias' => '',
        ];

        public $rules = [
            'required' => [
                ['title'],
                ['category_id'],
                ['price'],
            ],
            'integer' => [
                ['category_id'],
            ],
        ];

        public function editRelatedProduct($id, $data)
        {
            $related_product = \R::getCol('SELECT related_id FROM related_product WHERE product_id = ?', [$id]);

            // если менеджер убрал связанные товары - удаляем их (checkbox)
            if (empty($data['related']) && !empty($related_product)){
                \R::exec("DELETE FROM related_product WHERE product_id = ?", [$id]);
                return;
            }

            //если связанные товары добавляются
            if (!empty($data['related']) && empty($related_product)){
                $sql_part = '';
                foreach ($data['related'] as $v){
                    $sql_part .= "($id, $v),";
                }
                $sql_part = rtrim($sql_part,',');
                \R::exec("INSERT INTO related_product (product_id, related_id) VALUES $sql_part");
                return;
            }

            //если изменились связанные товары - удаляем те которые были, записываем новые
            if (!empty($data['related'])){
                $result = array_diff($related_product, $data['related']);
                if (!empty($result) || count($related_product) != count($data['related'])){
                    \R::exec("DELETE FROM related_product WHERE product_id = ?", [$id]);
                    $sql_part = '';
                    foreach ($data['related'] as $v){
                        $sql_part .= "($id, $v),";
                    }
                    $sql_part = rtrim($sql_part,',');
                    \R::exec("INSERT INTO related_product (product_id, related_id) VALUES $sql_part");
                }
                return;
            }

        }

        public function editFilter($id, $data)
        {
            $filter = \R::getCol('SELECT attr_id FROM attribute_product WHERE product_id = ?', [$id]);

            // если менеджер убрал фильтры - удаляем их (checkbox)
            if (empty($data['attrs']) && !empty($filter)){
                \R::exec("DELETE FROM attribute_product WHERE product_id = ?", [$id]);
                return;
            }

            //если фильтры добавляются
            if (!empty($data['attrs']) && empty($filter)){
                $sql_part = '';
                foreach ($data['attrs'] as $v){
                    $sql_part .= "($v, $id),";
                }
                $sql_part = rtrim($sql_part,',');
                \R::exec("INSERT INTO attribute_product (attr_id, product_id) VALUES $sql_part");
                return;
            }

            //если изменились фильтры - удаляем те которые были, записываем новые
            if(!empty($data['attrs'])){
                $result = array_diff($filter, $data['attrs']);
                if($result || count($filter) != count($data['attrs'])){
                    \R::exec("DELETE FROM attribute_product WHERE product_id = ?", [$id]);
                    $sql_part = '';
                    foreach($data['attrs'] as $v){
                        $sql_part .= "($v, $id),";
                    }
                    $sql_part = rtrim($sql_part, ',');
                    \R::exec("INSERT INTO attribute_product (attr_id, product_id) VALUES $sql_part");
                }
            }
        }

    public function editModif($id, $data)
    {
        $modif = \R::getCol('SELECT id FROM modification WHERE product_id = ?', [$id]);

        // если менеджер убрал модификации - удаляем их (checkbox)
        if (empty($data['modif']) && !empty($modif)){
            \R::exec("DELETE FROM modification WHERE product_id = ?", [$id]);
            return;
        }

        //если модификации добавляются
        if (!empty($data['modif']) && empty($modif)){
            $sql_part = '';
            $mas = [];
            foreach ($data['modif'] as $k => $v){
                    foreach ($v as $key => $value){
                        $mas[$key][$k] = $value;
                    }

            }
            foreach ($mas as $ma){
                $ma['price'] = $ma['price'] ? (int)$ma['price'] : 0;
                $ma['old_price'] = $ma['old_price'] ? (int)$ma['old_price'] : 0;
                $sql_part .= "($id, '{$ma['title']}', {$ma['price']}, {$ma['old_price']}),";
            }
            $sql_part = rtrim($sql_part,',');
            \R::exec("INSERT INTO modification (product_id, title, price, old_price) VALUES $sql_part");
            return;
        }

        //если изменились модификации - удаляем те которые были, записываем новые
        if (!empty($data['modif'])){
            $mas = [];
            foreach ($data['modif'] as $k => $v){
                foreach ($v as $key => $value){
                    $mas[$key][$k] = $value;
                }

            }
            $result = array_diff_key($modif, $mas);
            if (!$result || count($modif) != count($mas)){
                \R::exec("DELETE FROM modification WHERE product_id = ?", [$id]);
                $sql_part = '';
                foreach ($mas as $ma){
                    $ma['price'] = $ma['price'] ? (int)$ma['price'] : 0;
                    $ma['old_price'] = $ma['old_price'] ? (int)$ma['old_price'] : 0;
                    $sql_part .= "($id, '{$ma['title']}', {$ma['price']}, {$ma['old_price']}),";
                }
                $sql_part = rtrim($sql_part,',');
                \R::exec("INSERT INTO modification (product_id, title, price, old_price) VALUES $sql_part");
            }
            return;
        }
    }

    public function editProdContent($id, $data)
    {
        $prod_content = \R::getCol('SELECT id FROM prod_content WHERE product_id = ?', [$id]);

        // если менеджер убрал кбжу - удаляем их (checkbox)
        if (empty($data['prodCont']) && !empty($prod_content)){
            \R::exec("DELETE FROM prod_content WHERE product_id = ?", [$id]);
            return;
        }

        //если кбжу добавляются
        if (!empty($data['prodCont']) && empty($prod_content)){
            $sql_part = '';
            $mas = [];
            foreach ($data['prodCont'] as $k => $v){
                foreach ($v as $key => $value){
                    $mas[$key][$k] = $value;
                }

            }
            foreach ($mas as $ma){
                $ma['value'] = $ma['value'] ? $ma['value'] : 0;
                $sql_part .= "($id, '{$ma['title']}', '{$ma['value']}'),";
            }
            $sql_part = rtrim($sql_part,',');
            \R::exec("INSERT INTO prod_content (product_id, title, value) VALUES $sql_part");
            return;
        }

        //если изменились кбжу - удаляем те которые были, записываем новые
        if (!empty($data['prodCont'])){
            $mas = [];
            foreach ($data['prodCont'] as $k => $v){
                foreach ($v as $key => $value){
                    $mas[$key][$k] = $value;
                }

            }
            $result = array_diff_key($prod_content, $mas);
            if (!$result || count($prod_content) != count($mas)){
                \R::exec("DELETE FROM prod_content WHERE product_id = ?", [$id]);
                $sql_part = '';
                foreach ($mas as $ma){
                    $ma['value'] = $ma['value'] ? $ma['value'] : 0;
                    $sql_part .= "($id, '{$ma['title']}', '{$ma['value']}'),";
                }
                $sql_part = rtrim($sql_part,',');
                \R::exec("INSERT INTO prod_content (product_id, title, value) VALUES $sql_part");
            }
            return;
        }
    }

    public function getImg($add = false)
    {
        if (!empty($_SESSION['single'])){
            $this->attributes['img'] = $_SESSION['single'];
            unset($_SESSION['single']);
        }else{
            if ($add){
                $this->attributes['img'] = 'no_image.jpg';
            }
        }
    }

    public function saveGallery($id)
    {
        if (!empty($_SESSION['multi'])){
            $sql_part = '';
            foreach ($_SESSION['multi'] as $v){
                $sql_part .= "($id, '$v'),";
            }
            $sql_part = rtrim($sql_part, ',');
            \R::exec("INSERT INTO gallery (product_id, img) VALUES $sql_part");
            unset($_SESSION['multi']);
        }
    }

    public function uploadImg($name, $wmax, $hmax){
        $uploaddir = WWW . '/images/';
        $ext = strtolower(preg_replace("#.+\.([a-z]+)$#i", "$1", $_FILES[$name]['name'])); // расширение картинки
        $types = array("image/gif", "image/png", "image/jpeg", "image/pjpeg", "image/x-png"); // массив допустимых расширений
        if($_FILES[$name]['size'] > 5242880){
            $res = array("error" => "Ошибка! Максимальный вес файла - 5 Мб!");
            exit(json_encode($res));
        }
        if($_FILES[$name]['error']){
            $res = array("error" => "Ошибка! Возможно, файл слишком большой.");
            exit(json_encode($res));
        }
        if(!in_array($_FILES[$name]['type'], $types)){
            $res = array("error" => "Допустимые расширения - .gif, .jpg, .png");
            exit(json_encode($res));
        }
        $new_name = md5(time()).".$ext";
        $uploadfile = $uploaddir.$new_name;
        if(@move_uploaded_file($_FILES[$name]['tmp_name'], $uploadfile)){
            if($name == 'single'){
                $_SESSION['single'] = $new_name;
            }else{
                $_SESSION['multi'][] = $new_name;
            }
            self::resize($uploadfile, $uploadfile, $wmax, $hmax, $ext);
            $res = array("file" => $new_name);
            exit(json_encode($res));
        }
    }

    /**
     * @param string $target путь к оригинальному файлу
     * @param string $dest путь сохранения обработанного файла
     * @param string $wmax максимальная ширина
     * @param string $hmax максимальная высота
     * @param string $ext расширение файла
     */
    public static function resize($target, $dest, $wmax, $hmax, $ext){
        list($w_orig, $h_orig) = getimagesize($target);
        $ratio = $w_orig / $h_orig; // =1 - квадрат, <1 - альбомная, >1 - книжная

        if(($wmax / $hmax) > $ratio){
            $wmax = $hmax * $ratio;
        }else{
            $hmax = $wmax / $ratio;
        }

        $img = "";
        // imagecreatefromjpeg | imagecreatefromgif | imagecreatefrompng
        switch($ext){
            case("gif"):
                $img = imagecreatefromgif($target);
                break;
            case("png"):
                $img = imagecreatefrompng($target);
                break;
            default:
                $img = imagecreatefromjpeg($target);
        }
        $newImg = imagecreatetruecolor($wmax, $hmax); // создаем оболочку для новой картинки

        if($ext == "png"){
            imagesavealpha($newImg, true); // сохранение альфа канала
            $transPng = imagecolorallocatealpha($newImg,0,0,0,127); // добавляем прозрачность
            imagefill($newImg, 0, 0, $transPng); // заливка
        }

        imagecopyresampled($newImg, $img, 0, 0, 0, 0, $wmax, $hmax, $w_orig, $h_orig); // копируем и ресайзим изображение
        switch($ext){
            case("gif"):
                imagegif($newImg, $dest);
                break;
            case("png"):
                imagepng($newImg, $dest);
                break;
            default:
                imagejpeg($newImg, $dest);
        }
        imagedestroy($newImg);
    }
}