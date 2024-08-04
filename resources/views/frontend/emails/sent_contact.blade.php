<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Jawatchvn Shopping Cart</title>
</head>
<body>
<div style="margin:0;padding:0; font-size: 16px">
    <div style="margin-top: 50px">
        <span style="font-size: 36px; font-weight: 700; color: #204D6C">Contact on Jawatchvn website</span>
    </div>
    <div style="margin-top: 20px">
        <p>Shop information</p>
        <ul>
            <li>Full name : Link Bonsai</li>
            <li>Email : linkbonsai8@gmail.com</li>
            <li>Phone number : 0911.934.888</li>
            <li><a href="https://www.facebook.com/jawatch2013?_rdr">Facebook</a></li>
            <li><a href="https://www.instagram.com/jawatch.vietnam/?igsh=MXNpNW16bTdqcms2dQ%3D%3D&utm_source=qr">Instagram</a></li>
            <li><a href="https://jawatchvn.com/">Website</a></li>
        </ul>
    </div>

    <div style="margin-top: 30px;">
        <div style="padding: 20px 0">
            <div style="width: 1000px">
                <div style="margin-top: 10px ;text-align: center">
                    <span style="font-size: 28px; font-weight: 700">Contact</span>
                </div>
                <div style="margin-top: 20px; text-align: center">
                    <table style="width:1000px; text-align: center; border: 1px solid #CCCCCC; border-collapse: collapse;">
                        <tr style="border: 1px solid #CCCCCC;">
                            <td style="border: 1px solid #CCCCCC; padding: 10px">
                                Name
                            </td>
                            <td style="border: 1px solid #CCCCCC; padding: 10px">
                                Email
                            </td>
                            <td style="border: 1px solid #CCCCCC; padding: 10px">
                                Phone
                            </td>
                            <td style="border: 1px solid #CCCCCC; padding: 10px">
                                Content
                            </td>
                        </tr>
                        <tr style="border: 1px solid #CCCCCC;">
                            <td style="border: 1px solid #CCCCCC; padding: 10px">
                                {{ $params['full_name'] ?? '' }}
                            </td>
                            <td style="border: 1px solid #CCCCCC; padding: 10px">
                                {{ $params['email'] ?? '' }}
                            </td>
                            <td style="border: 1px solid #CCCCCC; padding: 10px">
                                {{ $params['phone_number'] ?? '' }}
                            </td>
                            <td style="border: 1px solid #CCCCCC; padding: 10px">
                                {{ $params['note'] ?? '' }}
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div style="margin-top: 20px; display: flex; align-items: center; justify-content: center">
        <span style="font-size: 16px"><i>This is an automated email, do not respond to this email</i></span>
    </div>
</div>
</body>
</html>
