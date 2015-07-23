<h1>Права пользователя:</h1>
<?php
foreach($this->list as $name => $role){
    if($name == $this->role){
        echo <<<"OUT"
        Пользователь $name обладает правами $role.
OUT;
        exit;//Прибиваем скрипт,т.к. нужная информация получена.
    }
}
echo "Unknown user $this->role";
