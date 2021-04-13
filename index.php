<?php require_once "form.php" ?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="reg-form"></div>
<div>
    <form action="./" method="post">
        <label>Имя</label><br>
        <input type="text" name="name" placeholder="Введите имя"><br>
        <label>Почта</label><br>
        <input type="text" name="email" placeholder="Введите почту"><br>
        <label>Возраст</label><br>
        <input type="text" name="age" placeholder="Введите возраст"><br>
        <button>Отправить</button><br>
       </form>
     </div>

<?php $validate = valid($_POST) ?>

        <?php if (!empty($validate['error']) && $validate['error']): ?>
        <?php foreach($validate['messages'] as $message): ?>
        <p style="color: red">
            <?= $message ?>
        </p>
        <?php endforeach; ?>
        <?php endif; ?>

        <?php if (!empty($validate['success']) && $validate['success']): ?>
        <?php foreach($validate['messages'] as $message): ?>
        <p style="color: green">
            <?= $message ?>
        </p>
        <?php endforeach; ?>
        <?php foreach (getUsers() as $user):?>
        <p style="color: green">
            <?= $user ['name']?>    <?= $user ['email']?>   <?= $user ['age']?>
        </p>
        <?php endforeach; ?>
        <?php endif; ?>

        <style lang="css">
            .reg-form{
                text-align: center;
                width: 100%;
            }
        </style>

</body>
</html>