<h1>Список всех пользователей:</h1>
<ol>
	<?
    foreach($this->list as $name => $role){
        echo<<<"OUT"
            <li>$name - $role</li>
OUT;

    }
    ?>
</ol>