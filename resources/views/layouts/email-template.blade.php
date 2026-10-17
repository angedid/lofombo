<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
</head>
<body style="margin:0; padding:0; background-color:#f4f4f4; color:#49616c; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:1.5;">
    <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%; background-color:#f4f4f4;">
        <tr>
            <td align="center" style="padding:8px;">
                <!--[if mso]><table role="presentation" width="600" cellpadding="0" cellspacing="0" border="0"><tr><td><![endif]-->
                <table role="presentation" width="100%" cellpadding="0" cellspacing="0" border="0" style="width:100%; max-width:600px; table-layout:fixed; background-color:#ffffff;">
                    <tr>
                        <td height="76" bgcolor="#5b4897" aria-hidden="true" style="height:76px; background-color:#5b4897; font-size:0; line-height:0;">&nbsp;</td>
                    </tr>
                    <tr>
                        <td style="padding:28px; color:#49616c; font-family:Arial, Helvetica, sans-serif; font-size:14px; line-height:1.5; overflow-wrap:anywhere; word-wrap:break-word;">
                            @yield('content')
                        </td>
                    </tr>
                </table>
                <!--[if mso]></td></tr></table><![endif]-->
            </td>
        </tr>
    </table>
</body>
</html>
