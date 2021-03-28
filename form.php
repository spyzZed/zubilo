<?php

function valid (array $post) : array {
    $validate=[
        'error'=>false,
        'success' =>false,
        'messages'=>[],
    ];

    if (!empty($post['login']) && !empty($post['password']) && !empty($post['name']) &&  !empty($post['surname'])){

        $login = trim($post ['login']);
        $password = trim($post ['password']);
        $name = trim($post['name']);
        $surname = trim($post['surname']);


        $constraints= [
            'login' => 6,
            'password'=>3,
        ];

        $validateForm=validLoginAndPassword($login, $password, $constraints, $name, $surname);

        if (!$validateForm['login']) {
            $validate['error'] = true;
            array_push( $validate ['messages'],
                "Логин должен содержать больше 6 символов"
            );
        }
        if (!$validateForm['password']) {
            $validate['error'] = true;
            array_push( $validate ['messages'],
                "Пароль должен содержать больше 3 символов"
            );
        }
        if (!$validateForm['name']){
            $validate['error'] = true;
            array_push( $validate ['messages'],
                " Имя {$name} некорректно, имя не должно содержать в себе цифры"
            );
        }

        if (!$validateForm['surname']){
            $validate['error'] = true;
            array_push( $validate ['messages'],
                " Фамилия {$surname} некорректно, фамилия не должна содержать в себе цифры"
            );
        }

        if (!$validate['error']){
            $validate['success'] = true;
            array_push(
                $validate['messages'],
                "Вы успешно прошли валидацию <br>  Ваш логин: {$login}  <br>  Ваш пароль: {$password}  <br> Ваше имя : {$name} <br> Ваша фамилия : {$surname}"
            );
        }
        return $validate;
    }
    return $validate;
}
function validLoginAndPassword(string $login, string $password, array $constraints, string $name, string $surname):array{
    $validateForm=[

        'login'=>true,
        'password' => true,
        'name' => true,
        'surname' =>true,
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
    if (preg_match("/[0-9]/", $surname))
    {
        $validateForm['surname'] = false;
    }
    return $validateForm;
}