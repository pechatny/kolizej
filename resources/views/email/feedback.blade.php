<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
<head>
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
</head>
<body>
    <h1 style="font-size:150%; margin-bottom:20px;">Обращение из формы обратной связи</h1>
    <table width="100%" align="center" cellpadding="2" cellspacing="0" border="1" style="border-collapse:collapse; border:#eeeeee 1px solid;">
        <tr>
            <td style="width:150px; border-collapse:collapse; border:#eeeeee 1px solid;">Имя</td>
            <td style="border-collapse:collapse; border:#eeeeee 1px solid;">{{ $name }}</td>
        </tr>
        <tr>
            <td style="width:150px; border-collapse:collapse; border:#eeeeee 1px solid;">Телефон:</td>
            <td style="border-collapse:collapse; border:#eeeeee 1px solid;">{{ $phone }}</td>
        </tr>
        <tr>
            <td style="width:150px; border-collapse:collapse; border:#eeeeee 1px solid;">Email:</td>
            <td style="border-collapse:collapse; border:#eeeeee 1px solid;">
                <a href="mailto:{{ $mail }}">{{ $mail }}</a>
            </td>
        </tr>
        <tr>
            <td style="width:150px; border-collapse:collapse; border:#eeeeee 1px solid;">Сообщение:</td>
            <td style="border-collapse:collapse; border:#eeeeee 1px solid;">{{ $text }}</td>
        </tr>
    </table>
</body>
</html>