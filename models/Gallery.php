<?php


class Gallery extends AbstractModel  {

    public $name;

    public $path;

    public $views;

    public $id;

    protected static $table = 'images';

    protected static $class = 'Gallery';

    //Сохранение изображения в БД
    public static function save_image( $file , $dir , $name = "Без имени" ) {

        switch($file['type']) {
            case 'image/jpeg':
                $ext = true;
                break;
            case 'image/gif':
                $ext = true;
                break;
            case 'image/png':
                $ext = true;
                break;
            case 'image/tiff':
                $ext = true;
                break;
            default:
                $ext = false;
        }
        if ($ext) {
            $db = new Database;
            $name = mysql_real_escape_string($name);
            $tmp_name = $file["tmp_name"];
            $file_name = basename(rand(0,500).$file['name']);
            move_uploaded_file($tmp_name, ABSPATH.$dir.'/'.$file_name);
            $query = "INSERT INTO ".self::$table."(name,path) VALUES('".$name."','".$dir."/".$file_name."')";
            if ($db->query_exec($query)){
                header('Location: /?result=uploaded');
                return true;
            }
            else {
                echo 'Не удалось запиcать данные в БД';
                return false;
            }

        }
        else {
            echo 'Недопустимый формат файла!';
            return false;
        }
    }



    //Удаление изображения из БД
    public static  function delete_image( $id  ) {
        $image = self::get_one($id);
        $file_path = ABSPATH.$image->path;;
        $query = "DELETE FROM ".self::$table." WHERE id=".$id;
        $db = new Database;
        if ($db->query_exec($query) && unlink($file_path)){
            header('Location: /index.php/?result=deleted');
            return true;
        }
        else {
            echo 'Не удалось удалить файл';
            return false;
        }
    }

    //Увеличение просмотра на 1
    public function increment_view() {
        $db = new Database;
        $this->views++;
        $query = "UPDATE ".self::$table." SET views=".$this->views." WHERE id=".$this->id;
        return $db->query_exec($query);
    }

}
