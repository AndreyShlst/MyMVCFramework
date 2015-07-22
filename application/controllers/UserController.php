<?php
class UserController implements IController{
    public function helloAction(){
        $fc = FrontController::getInstance();
        $params = $fc->getParams();//Получаем параметры из адресной строки
        $model = new FileModel();//Вызываем модель,для обработки этих параметров
        $model->name = $params["name"];
        $result = $model->render(USER_DEFAULT_FILE);//Указываем шаблон

        $fc->setBody($result);

    }
}