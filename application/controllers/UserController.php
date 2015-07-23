<?php
//Контроллер для вывода информации о пользователе(-ях)
class UserController implements IController{
    //Метод вывода информации о конкретном пользователе
    public function helloAction(){
        $fc = FrontController::getInstance();
        $params = $fc->getParams();//Получаем параметры из адресной строки
        $model = new FileModel();//Вызываем модель,для обработки этих параметров
        $model->name = $params["name"];
        $result = $model->render(USER_DEFAULT_FILE);//Указываем шаблон

        $fc->setBody($result);

    }

    //Метод вывода списка пользователей
    public function listAction(){
        $fc = FrontController::getInstance();
        $model = new FileModel();
        $model->list = unserialize(file_get_contents(USER_DB));//Вытягиваем данные из файла пользователей
        $result = $model->render(USER_LIST_FILE);

        $fc->setBody($result);
    }

    //Метод вывода роли пользователя
    public function getAction(){
        $fc = FrontController::getInstance();
        $params = $fc->getParams();//Получаем роль из адресной строки
        $model = new FileModel();
        $model->role = $params["role"];
        $model->list = unserialize(file_get_contents(USER_DB));//Вытягиваем данные из файла пользователей
        $result = $model->render(USER_ROLE_FILE);

        $fc->setBody($result);
    }

    //Метод добавления пользователя
    public function addAction(){
        $fc = FrontController::getInstance();
        $params = $fc->getParams();//Получаем параметры из адресной строки(name/role)
        $model = new FileModel();
        $model->name = $params["name"];
        $model->role = $params["role"];
        $model->user[$model->name]=$model->role;//Записываем наши значения в "темповый" массив User
        $model->list = unserialize(file_get_contents(USER_DB));//Вытягиваем данные из файла пользователей
        $model->list = array_merge($model->list,$model->user);//Объеденяем массив текущих пользователей с массивом темпового.Перезаписываем
        file_put_contents(USER_DB,serialize($model->list));//Перезаписываем файл с данными всех пользователей
        $result = $model->render(USER_ADD_FILE);

        $fc->setBody($result);
    }
}