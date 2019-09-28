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

<table style="border: 1px solid #ddd; border-collapse: collapse; width: 100%;">
    <thead>
    <tr style="background: #f9f9f9;">
        <th style="padding: 8px; border: 1px solid #ddd;">Имя</th>
        <th style="padding: 8px; border: 1px solid #ddd;">Email</th>
        <th style="padding: 8px; border: 1px solid #ddd;">Телефон</th>
    </tr>
    </thead>
    <tbody>
        <tr>
            <td style="padding: 8px; border: 1px solid #ddd;"><?=$_SESSION['buy']['name'] ?></td>
            <td style="padding: 8px; border: 1px solid #ddd;"><?=$_SESSION['buy']['email'] ?></td>
            <td style="padding: 8px; border: 1px solid #ddd;"><?=$_SESSION['buy']['number'] ?></td>
        </tr>
    </tbody>
</table>
</body>
</html>