<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Заказ № {{ $order->number }}</title>

    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 11px;
            line-height: 1.4;
            margin: 0;
            padding: 20px;
        }

        .title {
            font-size: 18px;
            text-align: center;
            text-transform: uppercase;
            padding: 10px;
            background: #efefef;
            margin-bottom: 15px;
        }

        .block {
            margin-bottom: 15px;
            page-break-inside: avoid;
        }

        .block-title {
            font-size: 13px;
            text-transform: uppercase;
            text-align: right;
            padding: 6px 8px;
            background: #efefef;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table td {
            padding: 5px 4px;
            vertical-align: top;
        }

        .info-table td:first-child {
            width: 40%;
        }

        .info-table td:last-child {
            text-align: right;
        }

        .products-table td {
            padding: 5px 4px;
            border-bottom: 1px solid #ddd;
        }

        .products-table td:last-child {
            width: 25%;
            text-align: right;
        }

        .total-row td {
            background: #efefef;
            font-weight: bold;
            border-bottom: none;
        }

        .grand-total {
            margin-top: 20px;
            padding: 10px;
            background: #efefef;
            font-size: 14px;
            text-transform: uppercase;
        }

        .grand-total span {
            float: right;
        }
    </style>
</head>
<body>

<div class="title">
    Заказ № {{ $order->number }}
</div>

<!-- Заказчик -->
<div class="block">
    <div class="block-title">Заказчик</div>
    <table class="info-table">
        <tr>
            <td>ФИО:</td>
            <td>{{ $order->user->surname }} {{ $order->user->name }} {{ $order->user->patronymic }}</td>
        </tr>
        <tr>
            <td>Фирма:</td>
            <td>{{ $order->user->organization }}</td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>{{ $order->user->email }}</td>
        </tr>
        <tr>
            <td>Телефон:</td>
            <td>{{ $order->user->phone }}</td>
        </tr>
    </table>
</div>

<!-- Пациент -->
<div class="block">
    <div class="block-title">Пациент</div>
    <table class="info-table">
        <tr>
            <td>ФИО:</td>
            <td>{{ $order->patient->surname }} {{ $order->patient->name }} {{ $order->patient->patronymic }}</td>
        </tr>
        <tr>
            <td>Email:</td>
            <td>{{ $order->patient->email }}</td>
        </tr>
        <tr>
            <td>Телефон:</td>
            <td>{{ $order->patient->phone }}</td>
        </tr>
    </table>
</div>

{{-- Протезы --}}
@if ($order->patient->right_type === \App\Enum\ProthesisType::PROTHESIS_HAND && $rightHand)
    @include('pdf.partials.prosthesis-block', [
        'title' => 'Протез правой руки',
        'products' => $rightHand->products,
        'amount' => $rightHand->amount
    ])
@endif

@if ($order->patient->left_type === \App\Enum\ProthesisType::PROTHESIS_HAND && $leftHand)
    @include('pdf.partials.prosthesis-block', [
        'title' => 'Протез левой руки',
        'products' => $leftHand->products,
        'amount' => $leftHand->amount
    ])
@endif

@if ($order->patient->left_type === \App\Enum\ProthesisType::PROTHESIS_WRIST && $leftWrist)
    @include('pdf.partials.prosthesis-block', [
        'title' => 'Протез левой кисти',
        'products' => $leftWrist->products,
        'amount' => $leftWrist->amount
    ])
@endif

@if ($order->patient->right_type === \App\Enum\ProthesisType::PROTHESIS_WRIST && $rightWrist)
    @include('pdf.partials.prosthesis-block', [
        'title' => 'Протез правой кисти',
        'products' => $rightWrist->products,
        'amount' => $rightWrist->amount
    ])
@endif

<!-- Общая сумма -->
<div class="grand-total">
    Стоимость заказа
    <span>{{ $order->amount }} ₽</span>
</div>

</body>
</html>
