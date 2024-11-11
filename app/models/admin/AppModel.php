<?php

namespace app\models\admin;

use core\Model;

class AppModel extends Model
{

    public function getSlug($table = null,$slug = null,$field = null,$idSlug=null)
    {

        if(!isset($idSlug)){
            $idSlug =$this->getIdSluglug($table);
        }

        if(!isset($str)){
            $slug = self::str2url($slug);
        }

        if(!empty(self::checkField($table,$slug,$field))){
            $slug = "{$slug}-{$idSlug}";
            if(!empty(self::checkField($table,$slug,$field))){
                $this->getSlug($table,$slug,$field,$idSlug);
            }
        }
        return $slug;
    }

    protected function checkField($table,$slug,$field)
    {

        $stmt = $this->conn->prepare("SELECT {$field} FROM $table WHERE $field = :value");

        $stmt->execute(['value'=>$slug]);

        return $stmt->fetch();
    }

    public static function str2url($str): string
    {
        // переводим в транслит
        $str = self::rus2translit($str);
        // в нижний регистр
        $str = strtolower($str);
        // заменям все ненужное нам на "-"
        $str = preg_replace('~[^-a-z0-9]+~u', '-', $str);
        // удаляем начальные и конечные '-'
        $str = trim($str, "-");
        return $str;
    }

    public static function rus2translit($string): string
    {

        $converter = array(

            'а' => 'a', 'б' => 'b', 'в' => 'v',

            'г' => 'g', 'д' => 'd', 'е' => 'e',

            'ё' => 'e', 'ж' => 'zh', 'з' => 'z',

            'и' => 'i', 'й' => 'y', 'к' => 'k',

            'л' => 'l', 'м' => 'm', 'н' => 'n',

            'о' => 'o', 'п' => 'p', 'р' => 'r',

            'с' => 's', 'т' => 't', 'у' => 'u',

            'ф' => 'f', 'х' => 'h', 'ц' => 'c',

            'ч' => 'ch', 'ш' => 'sh', 'щ' => 'sch',

            'ь' => '\'', 'ы' => 'y', 'ъ' => '\'',

            'э' => 'e', 'ю' => 'yu', 'я' => 'ya',


            'А' => 'A', 'Б' => 'B', 'В' => 'V',

            'Г' => 'G', 'Д' => 'D', 'Е' => 'E',

            'Ё' => 'E', 'Ж' => 'Zh', 'З' => 'Z',

            'И' => 'I', 'Й' => 'Y', 'К' => 'K',

            'Л' => 'L', 'М' => 'M', 'Н' => 'N',

            'О' => 'O', 'П' => 'P', 'Р' => 'R',

            'С' => 'S', 'Т' => 'T', 'У' => 'U',

            'Ф' => 'F', 'Х' => 'H', 'Ц' => 'C',

            'Ч' => 'Ch', 'Ш' => 'Sh', 'Щ' => 'Sch',

            'Ь' => '\'', 'Ы' => 'Y', 'Ъ' => '\'',

            'Э' => 'E', 'Ю' => 'Yu', 'Я' => 'Ya',

        );

        return strtr($string, $converter);

    }

    public function getIdSlug($table)
    {
        $stmt = $this->conn->query("SELECT id FROM {$table} ORDER BY id DESC LIMIT 1");

        return $id = $stmt->fetch()['id'] + 1;

    }

    public function insertSlug($table,$slug): int
    {
        $stmt = $this->conn->prepare("INSERT INTO $table (slug) VALUES (:slug)");

        $stmt->execute(['slug'=>$slug]);
        return $this->conn->lastInsertId();
    }

    public function insertIntoDescription($table,$id)
    {
        $name = $table . '_description';

        $idName = $table . '_id';
        $fields = '(' . $idName . ',language_id,';
        $values = "(";
        $data = [];
        foreach ($_POST[$name] as $lang_id=>$item){
            foreach ($item as $field=>$value) {
                $fields .= $field . ',';
            }

            $fields =rtrim($fields,',');
            $fields .= ')';
            break;
        }

        foreach ($_POST[$name] as $lang_id=>$item){
            $values  .= ":$idName,:language_id,";
            foreach ($item as $field=>$value) {
                $values .= ":$field,";
            }

            $values =rtrim($values,',');
            $values .= ')';
            break;
        }


        $sql = "INSERT INTO $name $fields VALUES $values";

        $stmt = $this->conn->prepare($sql);

        foreach ($_POST[$name] as $lang_id=>$item){

            $arr = [$table . '_id' =>$id,'language_id'=>$lang_id,...$item];

            $stmt->execute($arr);

        }
    }

    public function updateDescription($table,$id)
    {
        $name = $table . '_description';

        $idName = $table . '_id';


        foreach ($_POST[$name] as $lang_id=>$item){
            $values = [];
            $fields = '';
            foreach ($item as $key=>$value){
                $fields .= $key . '=:' . $key . ',';
                $values[$key] = $value;
            }
            $fields = rtrim($fields,',');

            $stmt = $this->conn->prepare("UPDATE $name SET $fields WHERE $idName = :$idName AND language_id = :language_id");
            $values[$idName] = $id;

            $values['language_id'] = $lang_id;

            $stmt->execute($values);
        }
        return true;
    }

    public function uploadImg(){

        $file = $this->attributes['img'];
        if(!is_array($file)) {
            $file = explode('/',$file);
            $file = array_pop($file);

        }
        $srcFileName = !empty($file['name']) ? $file['name']:  $file;


        $newFilePath = $_SERVER['DOCUMENT_ROOT'] . '/uploads/products/' . $srcFileName;

        $allowedExtensions = ['jpg', 'png', 'gif','jpeg'];
        $extension = pathinfo($srcFileName, PATHINFO_EXTENSION);
        if (!in_array($extension, $allowedExtensions)) {
            $_SESSION['errors'] = 'Загрузка файлов с таким расширением запрещена!';
        } elseif (!empty($file['error']) &&  $file['error'] !== UPLOAD_ERR_OK) {
            $_SESSION['errors'] = 'Ошибка при загрузке файла.';
        } elseif (file_exists($newFilePath)) {
            $_SESSION['errors'] = 'Файл с таким именем уже существует';
        } elseif (!move_uploaded_file($file['tmp_name'], $newFilePath)) {
            $_SESSION['errors'] = 'Ошибка при загрузке файла';
        } else {
            $result = 'http://myproject.loc/uploads/' . $srcFileName;
        }

        $this->attributes['img'] = 'assets/img/' . $srcFileName;
    }


}