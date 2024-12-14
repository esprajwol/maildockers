
@props([
   "colspan" => 5,
]);

<tr>
    <td colspan="{{ $colspan }}">
        <p class="text-center text-danger">
            {{ localize("No data found") }}
        </p>
    </td>
</tr>
