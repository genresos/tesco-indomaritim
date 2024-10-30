<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>1f32d378-43b6-4ce9-a4af-291c7b8b7e0a</title>
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            text-indent: 0;
        }

        .s1 {
            color: #F44336;
            font-family: "Gill Sans MT", sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10.5pt;
        }

        .s2 {
            color: #040404;
            font-family: "Gill Sans MT", sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 12pt;
        }

        .s3 {
            color: #040404;
            font-family: "Gill Sans MT", sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10.5pt;
        }

        .s4 {
            color: #040404;
            font-family: "Gill Sans MT", sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10.5pt;
        }

        .s5 {
            color: black;
            font-family: "Gill Sans MT", sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 10.5pt;
        }

        .s6 {
            color: #040404;
            font-family: "Gill Sans MT", sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 15pt;
        }

        p {
            color: black;
            font-family: "Gill Sans MT", sans-serif;
            font-style: normal;
            font-weight: normal;
            text-decoration: none;
            font-size: 7pt;
            margin: 0pt;
        }

        table,
        tbody {
            vertical-align: top;
            overflow: visible;
        }
    </style>
</head>
<?php
$item = $data[0];
?>

<body>
    <p style="text-indent: 0pt;text-align: left;"><span><img width="150" height="100" alt="image" src="http://192.168.99.230/assets/images/TESCO-01.png" /></span></p>
    <p class="s1" style="padding-top: 4pt;text-indent: 0pt;text-align: right;">*CONFIDENTIAL</p>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <p class="s2" style="text-indent: 0pt;text-align: right;">PT. TESCO INDOMARITIM </p>
    <p style="padding-top: 1pt;text-indent: 0pt;text-align: left;"><br /></p>
    <p class="s3" style="padding-top: 5pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">Payroll cut off : {{ $item->periode }}</p>
    <p class="s3" style="padding-top: 2pt;padding-left: 6pt;text-indent: 0pt;text-align: left;">Name : {{ $item->name }}</p>
    <p class="s3" style="padding-top: 2pt;padding-left: 6pt;text-indent: 0pt;line-height: 123%;text-align: left;">Site : {{ $item->site }}</p>
    <p class="s3" style="padding-top: 2pt;padding-left: 6pt;text-indent: 0pt;line-height: 123%;text-align: left;">Job position : {{ $item->department }}</p>
    <!-- <p class="s3" style="padding-left: 6pt;text-indent: 0pt;text-align: left;">NPWP :</p> -->
    <p style="padding-top: 6pt;text-indent: 0pt;text-align: left;"><br /></p>
    <table style="border-collapse:collapse;margin-left:6.375pt" cellspacing="0">
        <tr style="height:27pt">
            <td style="width:149pt" bgcolor="#E1E1E1">
                <p class="s4" style="padding-top: 7pt;padding-left: 7pt;text-indent: 0pt;text-align: left;">Earnings</p>
            </td>
            <td style="width:133pt" bgcolor="#E1E1E1">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
            <td style="width:283pt" colspan="2" bgcolor="#E1E1E1">
                <p class="s4" style="padding-top: 7pt;padding-left: 7pt;text-indent: 0pt;text-align: left;">Deductions</p>
            </td>
        </tr>
        <tr style="height:31pt">
            <td style="width:149pt;border-left-style:solid;border-left-width:1pt;border-left-color:#E1E1E1;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#E1E1E1">
                <p class="s5" style="padding-top: 8pt;padding-left: 7pt;text-indent: 0pt;text-align: left;">Basic Salary</p>
            </td>
            <td style="width:133pt;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#E1E1E1;border-right-style:solid;border-right-width:1pt;border-right-color:#E1E1E1">
                <p class="s4" style="padding-top: 8pt;padding-right: 7pt;text-indent: 0pt;text-align: right;">Rp {{ number_format(($item->working_days * $item->rate), 0, ',', '.') }}</p>
            </td>
            <td style="width:283pt;border-left-style:solid;border-left-width:1pt;border-left-color:#E1E1E1;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#E1E1E1;border-right-style:solid;border-right-width:1pt;border-right-color:#E1E1E1" colspan="2">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
        </tr>
        <tr style="height:27pt">
            <td style="width:149pt;border-top-style:solid;border-top-width:1pt;border-top-color:#E1E1E1;border-left-style:solid;border-left-width:1pt;border-left-color:#E1E1E1;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#E1E1E1">
                <p class="s4" style="padding-top: 6pt;padding-left: 7pt;text-indent: 0pt;text-align: left;">Total earnings</p>
            </td>
            <td style="width:133pt;border-top-style:solid;border-top-width:1pt;border-top-color:#E1E1E1;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#E1E1E1">
                <p class="s4" style="padding-top: 6pt;padding-right: 7pt;text-indent: 0pt;text-align: right;">Rp {{ number_format($item->net_income, 0, ',', '.') }}</p>
            </td>
            <td style="width:178pt;border-top-style:solid;border-top-width:1pt;border-top-color:#E1E1E1;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#E1E1E1">
                <p class="s4" style="padding-top: 6pt;padding-left: 7pt;text-indent: 0pt;text-align: left;">Total deductions</p>
            </td>
            <td style="width:105pt;border-top-style:solid;border-top-width:1pt;border-top-color:#E1E1E1;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#E1E1E1;border-right-style:solid;border-right-width:1pt;border-right-color:#E1E1E1">
                <p class="s4" style="padding-top: 6pt;padding-right: 7pt;text-indent: 0pt;text-align: right;">Rp {{ number_format($item->loan+$item->tax, 0, ',', '.') }}</p>
            </td>
        </tr>
    </table>
    <p class="s6" style="padding-top: 6pt;padding-left: 296pt;text-indent: 0pt;text-align: left;">Take Home Pay Rp {{ number_format($item->net_income, 0, ',', '.') }}</p>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <table style="border-collapse:collapse;margin-left:6pt" cellspacing="0">
        <tr style="height:21pt">
            <td style="width:147pt;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#E1E1E1">
                <p class="s4" style="text-indent: 0pt;line-height: 12pt;text-align: left;">Benefits*</p>
            </td>
            <td style="width:130pt;border-bottom-style:solid;border-bottom-width:1pt;border-bottom-color:#E1E1E1">
                <p style="text-indent: 0pt;text-align: left;"><br /></p>
            </td>
        </tr>
        <tr style="height:23pt">
            <td style="width:147pt;border-top-style:solid;border-top-width:1pt;border-top-color:#E1E1E1">
                <p class="s5" style="padding-top: 8pt;text-indent: 0pt;text-align: left;">Uang Makan</p>
            </td>
            <td style="width:130pt;border-top-style:solid;border-top-width:1pt;border-top-color:#E1E1E1">
                <p class="s4" style="padding-top: 8pt;text-indent: 0pt;text-align: right;">Rp {{ number_format($item->meal_allowance, 0, ',', '.') }}</p>
            </td>
        </tr>
        <tr style="height:14pt">
            <td style="width:147pt">
                <p class="s4" style="padding-top: 1pt;text-indent: 0pt;line-height: 11pt;text-align: left;">Total benefits</p>
            </td>
            <td style="width:130pt">
                <p class="s4" style="padding-top: 1pt;text-indent: 0pt;line-height: 11pt;text-align: right;">Rp {{ number_format($item->net_income, 0, ',', '.') }}</p>
            </td>
        </tr>
    </table>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <p style="padding-left: 5pt;text-indent: 0pt;text-align: left;">*These are the benefits you&#39;ll get from the company, but not included in your take-home pay (THP).</p>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <p style="padding-left: 5pt;text-indent: 0pt;text-align: left;">THIS IS COMPUTER GENERATED PRINTOUT AND NO SIGNATURE IS REQUIRED</p>
    <p style="padding-top: 5pt;text-indent: 0pt;text-align: left;"><br /></p>
    <p style="padding-left: 5pt;text-indent: 0pt;line-height: 109%;text-align: left;">PLEASE NOTE THAT THE CONTENTS OF THIS STATEMENT SHOULD BE TREATED WITH ABSOLUTE CONFIDENTIALITY EXCEPT TO THE EXTENT YOU ARE REQUIRED TO MAKE DISCLOSURE FOR ANY TAX, LEGAL, OR REGULATORY PURPOSES. ANY BREACH OF THIS CONFIDENTIALITY OBLIGATION WILL BE DEALT WITH SERIOUSLY, WHICH MAY INVOLVE DISCPLINARY ACTION BEING TAKEN.</p>
    <p style="text-indent: 0pt;text-align: left;"><br /></p>
    <p style="padding-left: 5pt;text-indent: 0pt;line-height: 109%;text-align: left;">HARAP DIPERHATIKAN, ISI PERNYATAAN INI ADALAH RAHASIA KECUALI ANDA DIMINTA UNTUK MENGUNGKAPKANNYA UNTUK KEPERLUAN PAJAK, HUKUM, ATAU KEPENTINGAN PEMERINTAH. SETIAP PELANGGARAN ATAS KEWAJIBAN MENJAGA KERAHASIAAN INI AKAN DIKENAKAN SANKSI, YANG MUNGKIN BERUPA TINDAKAN KEDISIPLINAN.</p>
</body>

</html>