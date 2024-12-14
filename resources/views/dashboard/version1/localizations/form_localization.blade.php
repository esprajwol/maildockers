<table class="table table-hover">
    <thead>
    <tr>
        <th>Key</th>
        <th>Value</th>
    </tr>
    </thead>
    <tbody class="add_new_row">
        @foreach ($localizations as $localization)
            <tr>
                <td>
                    <span class="fontsize">
                        {{ $localization->key }}
                    </span>

                    <x-form.input
                        type="hidden"
                        name="key[]"
                        value="{{ $localization->key }}"
                        class="form-control"
                    />
                </td>
                <td>
                    <textarea 
                        class="form-control fontsize"
                        id="localizationTextarea"
                        name="value[]" 
                        rows="1" 
                        oninput="autoExpand(this)"
                        placeholder="Enter Value here"
                        style="direction: {{$direction}};"
                    >{!! html_entity_decode($localization->value) !!}</textarea>
                </td>
                <td width="50px"></td>
            </tr>
        @endforeach
    </tbody>
</table>
