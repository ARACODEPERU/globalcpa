<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <head>
        <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
        <title>{{ env('APP_NAME', 'Aracode Peru') }}</title>
        <style type="text/css">
            div,
            p,
            a,
            li,
            td {
                -webkit-text-size-adjust: none;
            }

            .ReadMsgBody {
                width: 100%;
                background-color: #cecece;
            }

            .ExternalClass {
                width: 100%;
                background-color: #cecece;
            }

            body {
                width: 100%;
                height: 100%;
                background-color: #cecece;
                margin: 0;
                padding: 0;
                -webkit-font-smoothing: antialiased;
            }

            html {
                width: 100%;
            }

            img {
                border: none;
            }

            table td[class=show] {
                display: none !important;
            }

            @media only screen and (max-width: 640px) {
                body {
                    width: auto !important;
                }

                table[class=full] {
                    width: 100% !important;
                }

                table[class=devicewidth] {
                    width: 100% !important;
                    padding-left: 20px !important;
                    padding-right: 20px !important;
                }

                table[class=inner] {
                    width: 100% !important;
                    text-align: center !important;
                    clear: both;
                }

                table[class=inner-centerd] {
                    width: 78% !important;
                    text-align: center !important;
                    clear: both;
                    float: none !important;
                    margin: 0 auto !important;
                }

                table td[class=hide],
                .hide {
                    display: none !important;
                }

                table td[class=show],
                .show {
                    display: block !important;
                }

                img[class=responsiveimg] {
                    width: 100% !important;
                    height: atuo !important;
                    display: block !important;
                }

                table[class=btnalign] {
                    float: left !important;
                }

                table[class=btnaligncenter] {
                    float: none !important;
                    margin: 0 auto !important;
                }

                table td[class=textalignleft] {
                    text-align: left !important;
                    padding: 0 !important;
                }

                table td[class=textaligcenter] {
                    text-align: center !important;
                }

                table td[class=heightsmalldevices] {
                    height: 45px !important;
                }

                table td[class=heightSDBottom] {
                    height: 28px !important;
                }

                table[class=adjustblock] {
                    width: 87% !important;
                }

                table[class=resizeblock] {
                    width: 92% !important;
                }

                table td[class=smallfont] {
                    font-size: 8px !important;
                }
            }

            @media only screen and (max-width: 520px) {
                table td[class=heading] {
                    font-size: 24px !important;
                }

                table td[class=heading01] {
                    font-size: 18px !important;
                }

                table td[class=heading02] {
                    font-size: 27px !important;
                }

                table td[class=text01] {
                    font-size: 22px !important;
                }

                table[class="full mhide"],
                table tr[class=mhide] {
                    display: none !important;
                }
            }

            @media only screen and (max-width: 480px) {
                table {
                    border-collapse: collapse;
                }

                table[id=colaps-inhiret01],
                table[id=colaps-inhiret02],
                table[id=colaps-inhiret03],
                table[id=colaps-inhiret04],
                table[id=colaps-inhiret05],
                table[id=colaps-inhiret06],
                table[id=colaps-inhiret07],
                table[id=colaps-inhiret08],
                table[id=colaps-inhiret09] {
                    border-collapse: inherit !important;
                }
            }

            @media only screen and (max-width: 320px) {}
        </style>
    </head>
    @php
        $company = \App\Models\Company::first();
        $contact = $data['contact'];
    @endphp

<body style="background-color: #cecece;">
    <table width="100%">
        <tr>
            <td height="100">&nbsp;</td>
        </tr>
    </table>
    <repeater>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="full">
            <tr>
                <td align="center">
                    <table width="600" border="0" cellspacing="0" cellpadding="0" align="center"
                        class="devicewidth">
                        <tr>
                            <td>
                                <table width="100%" bgcolor="#ffffff" border="0" cellspacing="0" cellpadding="0"
                                    align="center" class="full"
                                    style="background-color:#ffffff; border-radius:5px 5px 0 0;">
                                    <tr>
                                        <td>
                                            <table width="265" align="left" border="0" cellspacing="0"
                                                cellpadding="0" class="inner" style="text-align:center;">
                                                <tr>
                                                    <td width="28" height="52">&nbsp;</td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td width="28">&nbsp;</td>
                                                    <td align="center" valign="middle">
                                                        <a href="#">
                                                            <img src="{{ asset('storage/' . $company->logo) }}"
                                                                width="205" height="54" alt="Wohoo">
                                                        </a>
                                                    </td>
                                                </tr>

                                            </table>
                                            <table width="255" align="right" border="0" cellspacing="0"
                                                cellpadding="0" class="inner" style="text-align:center;">
                                                <tr>
                                                    <td class="hide" height="22">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td height="10">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td align="center" valign="middle">
                                                        {{-- <table width="191" align="center" border="0"
                                                            cellspacing="0" cellpadding="0"
                                                            style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:center;">
                                                            <tr>
                                                                <td align="center" bgcolor="#f27b69" height="57"
                                                                    style="border-radius:28px;">
                                                                    <a href="{{ route('index_main') }}"
                                                                        style="font-family:'Montserrat', Helvetica, Arial, sans-serif; font-weight:700; font-size:16px; line-height:57px; color:#ffffff; text-decoration:none; text-transform:uppercase; display:block; overflow:hidden; ">GO
                                                                        IR AL SITIO
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                        </table> --}}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td height="40">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="full">
            <tr>
                <td align="center">
                    <table width="600" border="0" cellspacing="0" cellpadding="0" align="center"
                        class="devicewidth">
                        <tr>
                            <td>
                                <table width="100%" bgcolor="#f8f8f8" border="0" cellspacing="0" cellpadding="0"
                                    align="center" class="full"
                                    style="text-align:center; border-bottom:1px solid #e5e5e5;">
                                    <tr>
                                        <td class="heightsmalldevices" height="75">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td
                                            style="font:700 30px 'Montserrat', Helvetica, Arial, sans-serif; color:#f27b69; text-transform:uppercase;">
                                            <singleline>
                                                {{ $contact['full_name'] }}
                                            </singleline>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="37">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="100%" align="center" border="0" cellspacing="0"
                                                cellpadding="0"
                                                style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:center;">
                                                <tr>
                                                    <td width="31"></td>
                                                    <td>
                                                        <table width="100%" align="center" border="0"
                                                            cellspacing="0" cellpadding="0"
                                                            style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:center;">
                                                            <tr>
                                                                <td>
                                                                    <table width="100%" align="center"
                                                                        border="0" cellspacing="0"
                                                                        cellpadding="0"
                                                                        style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:center;">
                                                                        <tr>
                                                                            <td height="61">&nbsp;</td>
                                                                        </tr>
                                                                    </table>
                                                                    <table width="100%" align="center"
                                                                        bgcolor="#ffffff" border="0"
                                                                        cellspacing="0" cellpadding="0"
                                                                        style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:center; border-top:2px solid #ededed; border-left:2px solid #ededed; border-radius:5px 5px 0px 0px;">
                                                                        <tr>
                                                                            <td height="62"
                                                                                style="border-radius:5px 5px 0px 0px;">
                                                                                &nbsp;</td>
                                                                        </tr>
                                                                    </table>

                                                                </td>
                                                                <td width="123" bgcolor="#ffffff">
                                                                    @if ($contact['image'])
                                                                        <img editable
                                                                            src="{{ asset('storage/' . $contact['image']) }}"
                                                                            width="123" height="auto"
                                                                            align="estudiante">
                                                                    @else
                                                                        <img editable
                                                                            src="https://ui-avatars.com/api/?name={{ $contact['full_name'] }}&size=123&rounded=false"
                                                                            width="123" height="auto"
                                                                            align="estudiante">
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <table width="100%" align="center"
                                                                        border="0" cellspacing="0"
                                                                        cellpadding="0"
                                                                        style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:center;">
                                                                        <tr>
                                                                            <td height="61">&nbsp;</td>
                                                                        </tr>
                                                                    </table>
                                                                    <table width="100%" align="center"
                                                                        bgcolor="#ffffff" border="0"
                                                                        cellspacing="0" cellpadding="0"
                                                                        style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:center; border-top:2px solid #ededed; border-right:2px solid #ededed; border-radius:5px 5px 0px 0px;">
                                                                        <tr>
                                                                            <td height="62">&nbsp;</td>
                                                                        </tr>
                                                                    </table>

                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="31"></td>
                                                </tr>
                                                <tr>
                                                    <td width="31"></td>
                                                    <td>
                                                        <table width="100%" align="center" bgcolor="#ffffff"
                                                            border="0" cellspacing="0" cellpadding="0"
                                                            style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:center; border-left:2px solid #ededed; border-right:2px solid #ededed;  border-bottom:2px solid #ededed;">
                                                            <tr>
                                                                <td width="30"></td>
                                                                <td>
                                                                    <table width="100%" border="0"
                                                                        cellspacing="0" cellpadding="0"
                                                                        style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:justify;">
                                                                        <tr>
                                                                            <td height="21">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td
                                                                                style="font:20px Arial, Helvetica, sans-serif; color:#404040;">
                                                                                <singleline>
                                                                                    Gracias por aprender con nosotros.
                                                                                    Sus credenciales de acceso a nuestro
                                                                                    sitio web son las siguientes:
                                                                                    <ul>
                                                                                        <li>Correo electrónico:
                                                                                            {{ $contact['email'] }}
                                                                                        </li>
                                                                                        <li>Contraseña:
                                                                                            {{ $contact['number'] }}
                                                                                        </li>
                                                                                    </ul>
                                                                                    Le recomendamos mantener estas
                                                                                    credenciales en un lugar seguro y no
                                                                                    compartirlas con terceros para
                                                                                    proteger la seguridad de su cuenta.

                                                                                    Si tiene alguna duda o necesita
                                                                                    asistencia, no dude en contactarnos.
                                                                                </singleline>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td height="36">&nbsp;</td>
                                                                        </tr>
                                                                    </table>

                                                                </td>
                                                                <td width="30"></td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td width="31"></td>
                                                </tr>
                                            </table>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td height="50">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="290" align="left" border="0" cellspacing="0"
                                                cellpadding="0"
                                                style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
                                                class="inner">
                                                <tr>
                                                    <td class="hide" width="31" height="20"> </td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="hide" width="31"> </td>
                                                    <td style="font:16px Arial, Helvetica, sans-serif; color:#404040;">
                                                        <singleline>Ingresa a nuestro sitio web.</singleline>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td class="hide" width="31"> </td>
                                                    <td height="20">&nbsp;</td>
                                                </tr>
                                            </table>
                                            <table width="220" align="right" border="0" cellspacing="0"
                                                cellpadding="0"
                                                style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"
                                                class="inner">
                                                <tr>
                                                    <td>
                                                        <table width="192" align="center" border="0"
                                                            cellspacing="0" cellpadding="0"
                                                            style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:center;">
                                                            <tr>
                                                                <td align="center" bgcolor="#af5372"
                                                                    style="border-radius:28px;" height="61">
                                                                    <multiline>
                                                                        <a href="{{ route('verification.send') }}"
                                                                            style="font:700 16px/61px 'Montserrat', Helvetica, Arial, sans-serif; color:#ffffff; text-decoration:none; text-transform:uppercase; display:block; overflow:hidden; outline:none;">
                                                                            Iniciar sesión
                                                                        </a>
                                                                    </multiline>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                    </td>
                                                    <td class="hide" width="30">&nbsp;</td>
                                                </tr>
                                                <tr>
                                                    <td class="heightsmalldevices" height="50">&nbsp;</td>
                                                    <td class="hide" width="30">&nbsp;</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
        <table width="100%" border="0" cellspacing="0" cellpadding="0" align="center" class="full">
            <tr>
                <td align="center">
                    <table width="600" border="0" cellspacing="0" cellpadding="0" align="center"
                        class="devicewidth">
                        <tr>
                            <td>
                                <table width="100%" bgcolor="#b5637e" border="0" cellspacing="0"
                                    cellpadding="0" align="center" class="full"
                                    style="border-radius:0 0 5px 5px;">
                                    <tr>
                                        <td height="18">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <table width="340" border="0" cellspacing="0" cellpadding="0"
                                                align="right"
                                                style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:center;"
                                                class="inner">
                                                <tr>
                                                    <td width="21">&nbsp;</td>
                                                    <td>
                                                        <table width="100%" border="0" cellspacing="0"
                                                            cellpadding="0" align="center">
                                                            <tr>
                                                                <td>
                                                                    <table width="100%" border="0"
                                                                        cellspacing="0" cellpadding="0"
                                                                        align="center" class="full">
                                                                        <tr>
                                                                            <td align="center"
                                                                                style="font:11px Helvetica,  Arial, sans-serif; color:#383838;">
                                                                                {{-- <a style="color:#ffffff; text-decoration:none;"
                                                                                    href="#"> Unsubscribe</a> --}}
                                                                            </td>
                                                                            <td style="color:#ffffff;">
                                                                                {{-- | --}}
                                                                            </td>
                                                                            <td align="center"
                                                                                style="font:11px Helvetica,  Arial, sans-serif; color:#383838;">
                                                                                {{-- <a style="color:#ffffff; text-decoration:none;"
                                                                                    href="#"> Unsubscribe</a> --}}
                                                                            </td>
                                                                            <td style="color:#ffffff;">
                                                                                {{-- | --}}
                                                                            </td>
                                                                            <td align="center"
                                                                                style="font:11px Helvetica,  Arial, sans-serif; color:#383838;">
                                                                                <a style="color:#ffffff; text-decoration:none;"
                                                                                    href="{{ route('index_main') }}">
                                                                                    Ver en el navegador
                                                                                </a>
                                                                            </td>
                                                                            <td class="hide" width="40"
                                                                                align="right">&nbsp;</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td height="18">&nbsp;</td>
                                                                        </tr>
                                                                    </table>

                                                                </td>
                                                            </tr>
                                                        </table>

                                                    </td>
                                                </tr>
                                            </table>
                                            <table width="230" border="0" cellspacing="0" cellpadding="0"
                                                align="left"
                                                style="border-collapse:collapse; mso-table-lspace:0pt; mso-table-rspace:0pt; text-align:center;"
                                                class="inner">
                                                <tr>
                                                    <td width="21">&nbsp;</td>
                                                    <td>
                                                        <table width="100%" border="0" cellspacing="0"
                                                            cellpadding="0" align="center">
                                                            <tr>
                                                                <td align="center"
                                                                    style="font:11px Helvetica,  Arial, sans-serif; color:#ffffff;">
                                                                    &copy; {{ date('Y') }}, All rights reserved
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td height="18">&nbsp;</td>
                                                            </tr>
                                                        </table>

                                                    </td>
                                                    <td width="21">&nbsp;</td>
                                                </tr>
                                            </table>

                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="mhide">
                            <td height="100">&nbsp;</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </repeater>
    <table width="100%">
        <tr>
            <td height="60">&nbsp;</td>
        </tr>
    </table>
</body>

</html>
