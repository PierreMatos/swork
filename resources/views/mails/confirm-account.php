
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta name="x-apple-disable-message-reformatting">
    <title></title>
    <style>
        table,
        td,
        div,
        h1,
        p {
            font-weight: 500;
            font-family: Arial, sans-serif;
            font-size: 25px;
        }
        .btn {margin: 10px 0px;
            border-radius: 4px;
            text-decoration: none;
            color: #fff !important;
            height: 46px;
            padding: 10px 20px;
            font-size: 16px;
            font-weight: 600;
            background-color:#48aa37;
            border: 1px solid #48aa37!important;
        }
        .btn:hover {
            text-decoration: none;
            opacity: .8;
        }
    </style>
</head>
<tr>
    <td class="header" style="width: 100%; height: 100%; background-color: #000; padding: 50px;">
        <a href="https://swork.pt/" style="display: inline-block;">
            <img src="https://myswork.herokuapp.com/logo.svg" alt="SW Logo" style="width: 187px; height: 100px;">
        </a>
    </td>
</tr>

<body style="margin:0;padding:0;">
    <table role="presentation"
        style="width:100%;border-collapse:collapse;border:0;border-spacing:0;background:#ffffff;">
        <tr>
            <td align="center" style="padding:0;">
                <table role="presentation"
                    style="width:600px;border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;text-align:left;">
                    <tr style="border-collapse:collapse;border:1px solid #cccccc;border-spacing:0;">
                        <td align="left" style="padding:10px 25px;background:#fff; display: flex; align-items: center;">
                             <span style="font-weight: bold; padding-top: 10px;"> Confirmar E-mail </span>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding:36px 30px 42px 30px;">
                            <table role="presentation"
                                style="width:100%;border-collapse:collapse;border:0;border-spacing:0;">
                                <tr>
                                    <td style="padding:0 0 36px 0;color:#153643;">
                                        <p style="font-weight:bold;margin:0 0 20px 0;font-family:Arial,sans-serif;">
                                        <h1>Olá <?php  echo $user['email'] ?> </h1>
                                        <p
                                            style="margin:0 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                            Recebemos uma solicitação para ativar a sua conta.
                                            </p>
                                        <p
                                            style="margin:10px 0 12px 0;font-size:14px;line-height:24px;font-family:Arial,sans-serif;">
                                            Por favor confirme o seu e-mail
                                        </p>

                                        <p style="text-align: center;">
                                            <a href="<?php echo env('APP_URL').'/'.$user['email'] ?>" class="btn">Confirmar e-mail</a>
                                        </p>


                                        <p style="margin:100px 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                            Obrigado, </p>
                                        <p style="margin:0 0 12px 0;font-size:14px;font-family:Arial,sans-serif;">
                                            Success Work</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>