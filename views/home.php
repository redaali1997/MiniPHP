<!DOCTYPE html>
<html lang="ar" dir="rtl">

<head>
    <meta charset="UTF-8">
    <title>الصفحة الرئيسية</title>
    <style>
        body {
            font-family: sans-serif;
            text-align: center;
            padding: 50px;
            background-color: #f4f4f4;
        }

        h1 {
            color: #2c3e50;
        }
    </style>
</head>

<body>
    <h1>قائمة المستخدمين من قاعدة البيانات 🗄️</h1>
    
    <div style="background: #eef; padding: 20px; margin-bottom: 20px; border-radius: 5px;">
        <h3>إضافة مستخدم جديد ➕</h3>
        <form action="/store" method="POST">
            <input type="text" name="name" placeholder="الاسم" required style="padding: 10px;">
            <input type="email" name="email" placeholder="البريد الإلكتروني" required style="padding: 10px;">
            <button type="submit" style="padding: 10px; background: #27ae60; color: white; border: none; cursor: pointer;">حفظ البيانات</button>
        </form>
    </div>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>الاسم</th>
                <th>البريد الإلكتروني</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($users_list as $user): ?>
                <tr>
                    <td><?= $user['id'] ?></td>
                    <td><?= $user['name'] ?></td>
                    <td><?= $user['email'] ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>