
@foreach ($orders as $info)
    <tr>
        <td> {{ $info->id }}</td>
        <td> {{\Carbon\Carbon::parse($info->created_at)->format('d-m-y H:m')}}</td>
        @if(user()->username == 'london')
            <td> {{ $info->order_by }} </td>
            <td> {{ $info->target }} </td>
        @else
            <td> {{ $info->from_email }} </td>
            <td> {{ $info->recipient_email }} </td>
        @endif
        <td> {{ $info->total_messages }} </td>
        <td> £ {{ $info->payable_amount }}</td>
    </tr>
@endforeach

<tr>
    <td colspan="7">
        {{ $orders->count() > 0 ? $orders->withQueryString($_GET)->links("components.common.paginate") : false }}
    </td>
</tr>
