<?php


$host = 'localhost';
$dbname = 'postgres';
$port = '5432';
$user = 'postgres';
$password = ' ';

$conn = new PDO("pgsql:host={$host};port={$port};dbname={$dbname};user={$user};password={$password} ");

function getUsers(): array
{
    global $conn;
    return $conn->query('select * from users')->fetchAll(PDO::FETCH_ASSOC);
}

function q($post)
{

    global $conn;
    $st = $conn->prepare("insert into users (name, email, age, work_id) values (?, ?, ?, ?)");

    $st->execute([
        $post['name'],
        $post['email'],
        $post['age'],
        0,
    ]);

}

function valid(array $post): array
{
    $validate = [
        'error' => false,
        'success' => false,
        'messages' => [],
    ];

    if (!empty($post['name']) && !empty($post['email']) && !empty($post['age'])) {
        $name = trim($post['name']);
        $email = trim($post['email']);
        $age = trim($post['age']);

        $constrains = [
            'name' => preg_match("/^[а-яА-Яa-zA-Z]+$/u", $name),
            'age' => preg_match("/^([0-9])+$/", $age),
        ];

        $validateForm = validData($name, $email, $age, $constrains);

        if (!$validateForm['name']) {
            array_push($validate['messages'],
                "Имя не должно содержать цифр");
        }

        if (!$validateForm['email']) {
            array_push($validate['messages'],
                "Почта введена неправильно");
        }

        if (!$validateForm['age']) {
            array_push($validate['messages'],
                "Возраст может содержать только цифры");
        }

        if (!$validate['error']) {
            $validate['success'] = true;
            q($post);
            array_push($validate['messages'],
                "Ваше имя: $name",
                "Ваша почта: $email",
                "Ваш возраст: $age"
            );
        }
    }
    return $validate;

}

function validData(string $name, string $email, string $age, array $constrains): array
{

    $validateForm = [
        'name' => true,
        'email' => true,
        'age' => true,
    ];

    if (!preg_match("/^[а-яА-Яa-zA-Z]+$/u", $name)) {
        $validateForm['name'] = false;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $validateForm['email'] = false;
    }

    if (!preg_match("/^([0-9])+$/", $age)) {
        $validateForm['age'] = false;
    }

    return $validateForm;

}