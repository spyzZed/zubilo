<?php

function valid (array $post) : array {
    $validate=[
        'error'=>false,
        'success' =>false,
        'messages'=>[],
    ];

    if (!empty($post['login']) && !empty($post['password']) && !empty($post['name']) &&  !empty($post['name2'])){

        $login = trim($post ['login']);
        $password = trim($post ['password']);
        $name = trim($post['name']);
        $name2 = trim($post['name2']);
        $constraints= [
            'login' => 6,
            'password'=> 6,
        ];

        $validateForm=validationLoginAndPassword($login, $password, $constraints, $name, $name2);

        if (!$validateForm['login']) {
            $validate['error'] = true;
            array_push( $validate ['messages'],
                "Логин должен содержать больше 6 символов"
            );
        }
        if (!$validateForm['password']) {
            $validate['error'] = true;
            array_push( $validate ['messages'],
                "Пароль должен содержать больше 6 символов"
            );
        }
        if (!$validateForm['name']){
            $validate['error'] = true;
            array_push( $validate ['messages'],
                " Имя {$name} некорректно, имя не должно содержать цифры"
            );
        }

        if (!$validateForm['name2']){
            $validate['error'] = true;
            array_push( $validate ['messages'],
                " Фамилия {$name2} некорректна, фамилия не должна содержать цифры"
            );
        }

        if (!$validate['error']){
            $validate['success'] = true;
            array_push(
                $validate['messages'],
                "Вы успешно прошли  регистрацию на этом замечательном сайте!!!<br>Вот Ваши данные:<br>  Ваш логин: {$login}  <br>  Ваш пароль: {$password}  <br> Ваше Имя : {$name} <br> Ваша Фамилия : {$name2}"
            );
        }
        return $validate;
    }
    return $validate;
}
function validationLoginAndPassword(string $login, string $password, array $constraints, string $name, string $name2):array{
    $validateForm=[
        'login'=>true,
        'password' => true,
        'name' => true,
        'name2' =>true,
    ];
    if (strlen($login)<$constraints['login']){
        $validateForm['login'] = false;
    }
    if (strlen($password)<$constraints['password']){
        $validateForm['password']=false;
    }
    if (preg_match("/[0-9]/", $name))
    {
        $validateForm['name'] = false;
    }
    if (preg_match("/[0-9]/", $name2))
    {
        $validateForm['name2'] = false;
    }
    return $validateForm;
}