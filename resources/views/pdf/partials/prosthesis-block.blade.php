<div class="block">
    <div class="block-title">{{ $title }}</div>

    <table class="products-table">
        @foreach($products as $product)
            <tr>
                <td>{{ $product->name }}</td>
                <td>{{ $product->price }} ₽</td>
            </tr>
        @endforeach

        <tr class="total-row">
            <td>Итого за протез:</td>
            <td>{{ $amount }} ₽</td>
        </tr>
    </table>
</div>
