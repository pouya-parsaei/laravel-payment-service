<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title></title>
</head>
<style>
    @font-face {
        font-family: 'Vazir';
        src: url({{ storage_path('Vazir.eot') }});
        src: url({{storage_path('Vazir.eot?#iefix')}}) format('embedded-opentype'),
        url({{ storage_path('Vazir.woff2') }}) format('woff2'),
        url({{ storage_path('Vazir.woff') }}) format('woff'),
        url({{ storage_path('Vazir.eot') }}) format('truetype');
        /*font-weight: 400; // use the matching font-weight here ( 100, 200, 300, 400, etc).*/
    /*font-style: normal; // use the matching font-style here*/
    }

    body {
        font-family: 'Vazir', sans-serif;
    }

    table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
    }

    th, td {
        text-align: right;
        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #f2f2f2
    }
</style>
<body>


<div style="overflow-x:auto;">
    <table>
        <tr>
            <th>نام محصول</th>
            <th>قیمت</th>
            <th>تعداد</th>
            <th>مجموع</th>

        </tr>
        <tr>
            <td>محصول تستی</td>
            <td>10000</td>
            <td>2</td>
            <td>20000</td>
        </tr>
        <tr>
            <td>محصول تستی</td>
            <td>10000</td>
            <td>2</td>
            <td>20000</td>
        </tr>
        <tr>
            <td>محصول تستی</td>
            <td>10000</td>
            <td>2</td>
            <td>20000</td>
        </tr>

    </table>
</div>
</body>
</html>
