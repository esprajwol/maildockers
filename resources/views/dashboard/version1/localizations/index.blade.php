@extends('dashboard.version1.layouts.main')

@section('title', localize('Localizations'))

@push('extra-styles')
    <style>
        .input-as-textarea {
            width: 100%; /* Full width */
            height: 150px; /* Height ko increase kare */
            display: block; /* Block element banaye */
            overflow-y: auto; /* Vertical scrolling enable kare */
            white-space: pre-wrap; /* Line breaks ko support kare */
        }

        .fontsize {
            font-size: 0.9rem;
        }
    </style>
@endpush

@section('top-header', localize('Localizations'))

@section('content')
    <div class="row g-3 mb-3">

        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <form method="GET" action="{{ route('admin.localizations.index') }}">
                        <label for="" style="color: white;">{{ localize("Select a Language") }}:</label>
                        <select name="locale" onchange="this.form.submit()" class="select2">
                            @foreach (App\Models\Language::all() as $language)
                                <option value="{{ $language->code }}" {{ request('locale') == $language->code ? 'selected' : '' }}>
                                    {{ $language->name }}
                                </option>
                            @endforeach
                        </select>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.localizations.update', ['language_id' => $languageId]) }}" method="POST">

                        <div class="col-lg-12">
                            <div class="table-responsive">
                                @csrf
                                @include('dashboard.version1.localizations.form_localization')
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-lg-12 d-flex justify-content-end">
                                <button type="button" class="btn btn-primary add_row" style="margin-right:10px">
                                    {{ localize("Add Localization") }}
                                </button>
                                <button type="submit" class="btn btn-success">
                                    {{ localize("Save Localization") }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{ $localizations->appends(['locale' => $locale])->links() }}
@endsection

@section("js")
    <script>
        $(".add_row").on("click", function(){
            var html = '<tr><td><input type="text" name="key[]" value="" class="form-control fontsize" placeholder="Enter Key here"/></td><td><textarea name="value[]" value="" class="form-control fontsize" id="localizationTextarea" rows="1" oninput="autoExpand(this)" placeholder="Enter Value here"></textarea></td><td><button type="button" class="btn btn-danger delete_new text-black">X</button></td></tr>';
            $(".add_new_row").append(html);
        });
        $("body").on("click", ".delete_new", function(){
            $(this).parent().parent().remove();
        });

        $('.select2').select2({
            width: '100%',
            placeholder: "Select an Option",
            allowClear: true
        });
    </script>

    <script>
        function autoExpand(textarea) 
        {
            textarea.style.height = 'auto'; 
            textarea.style.height = textarea.scrollHeight + 'px';
        }

        document.addEventListener('DOMContentLoaded', function () {
            const textarea = document.getElementById('localizationTextarea');
            autoExpand(textarea);
        });

        $(document).ready(function () {
            $('textarea').each(function () {
              autoExpand(this);
            });
        });
    </script>
@endsection
