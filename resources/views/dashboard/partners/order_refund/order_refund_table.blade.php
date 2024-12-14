
@foreach ($refund_request_list as $info)
    <tr>
        <td> {{ $info->id }}</td>
        <td> {{convertToLocalDateTime($info->order->created_at)}}</td>
        <td> {{convertToLocalDateTime($info->created_at)}}</td>
        <td> {{ $info->order->from_email }} </td>
        <td> {{ $info->order->target }} </td>
        <td> {{ $info->order->total_messages }} </td>
        <td> {{ $info->latestStatus->status }} </td>
        <td> #</td>
    </tr>
@endforeach

<tr>
    <td colspan="7">
        {{ $refund_request_list->count() > 0 ? $refund_request_list->withQueryString($_GET)->links("components.common.paginate") : false }}
    </td>
</tr>
