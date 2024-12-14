@extends('dashboard.version1.layouts.main')

@section('title', 'Languages')

@section('top-header', 'Languages')

@section('actions')
<div class="my-3 d-flex justify-content-between align-items-center" style="padding-left: 0;">
    <form action="{{ route('admin.languages.store') }}" method="POST" class="d-flex align-items-center" style="width: 100%;">
        @csrf
        <div class="form-group mb-3" style="flex: 1; margin-right: 10px;">
            <label for="name">Language Name</label>
            <input type="text" id="name" class="form-control" name="name" placeholder="Language Name" required style="height: 38px;">
        </div>
        <div class="form-group mb-3" style="flex: 1; margin-right: 10px;">
            <label for="code">Code</label>
            <input type="text" id="code" class="form-control" name="code" placeholder="Code" required style="height: 38px;">
        </div>
        <div class="form-group mb-3" style="flex: 1; margin-right: 10px;">
            <label for="direction">Directions</label>
            <select id="direction" class="form-control" name="direction" required style="height: 38px;">
                <option value="ltr">LTR</option>
                <option value="rtl">RTL</option>
            </select>
        </div>
        <div class="form-group mb-3" style="flex: 1; margin-right: 10px;">
            <label for="is_active">Status</label>
            <select id="is_active" class="form-control" name="is_active" required style="height: 38px;">
                <option value="1">Active</option>
                <option value="0">Inactive</option>
            </select>
        </div>
        <button type="submit" class="btn btn-primary" style="height: 38px; flex-shrink: 0; margin-top: 5px">Add Language</button>
    </form>
</div>

    {{-- Validation Errors --}}
    @if ($errors->any())
        <div class="alert alert-danger mt-3">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
@stop

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table" id="priceTable">
                            <thead>
                                <tr>
                                    <th> {{ localize("ID") }} </th>
                                    <th> {{ localize("Language Name") }} </th>
                                    <th> {{ localize("Code") }} </th>
                                    <th> {{ localize("Direction") }} </th>
                                    <th> {{ localize("Is Active") }}? </th>
                                    <th> {{ localize("Action") }}  </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($languages as $language)
                                    <tr>
                                        <td> {{ $language->id }} </td>
                                        <td> {{ $language->name }} </td>
                                        <td> {{ $language->code }} </td>
                                        <td> {{ $language->direction }} </td>
                                        <td>
                                            <label class="badge {{ $language->is_active ? 'badge-gradient-success' : 'badge-gradient-danger' }}">{{ $language->is_active ? 'Active' : 'Inactive' }}</label>
                                        </td>
                                        <td>
                                            <div class="hstack gap-2 fs-15">
                                                <a href="@if(isAdmin()) {{ route('admin.languages.edit', $language->id) }} @endif"
                                                   class="btn btn-icon btn-sm btn-info-transparent rounded-pill"><i
                                                        class="ri-edit-line"></i>
                                                </a>
                                                <form id="delete-form-{{$language->id}}" method="POST" action="@if(isAdmin()) {{ route('admin.languages.destroy', ['language' => $language->id]) }} @endif">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button 
                                                        type="button" 
                                                        class="btn btn-icon btn-sm btn-danger-transparent rounded-pill" 
                                                        data-bs-toggle="modal" 
                                                        data-bs-target="#deleteModal" 
                                                        data-id="{{ $language->id }}"
                                                        data-name="{{ $language->name }}">
                                                        <i class="ri-delete-bin-line"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="card-footer">
                    {{ $languages->links() }}
                </div>
                
                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete <strong id="deleteItemName"></strong>? This action cannot be undone.
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                                <button type="button" class="btn btn-danger" id="confirmDelete">Delete</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


@stop

@push('extra-scripts')
    <script type='text/javascript'>
        $(document).ready(function() {

            $('#priceTable').on('click', '.viewdetails', function() {
                var priceId = $(this).attr('data-id');
                // alert(priceId);
                if (priceId > 0) {
                    // AJAX request
                    var url = "{{ route('admin.languages.show', [':priceId']) }}";
                    url = url.replace(':priceId', priceId);

                    // Empty modal data
                    $('#showData').empty();

                    $.ajax({
                        url: url,
                        dataType: 'json',
                        success: function(response) {

                            // Add employee details
                            $('#showData').html(response.html);

                            // Display Modal
                            $('#showModal').modal('show');
                        }
                    });
                }
            });

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const deleteModal           = document.getElementById('deleteModal');
            const deleteItemId          = document.getElementById('deleteItemId');
            const deleteItemName        = document.getElementById('deleteItemName');
            const confirmDeleteButton   = document.getElementById('confirmDelete');

            let languageId;

            deleteModal.addEventListener('show.bs.modal', function (event) {
                const button                = event.relatedTarget;
                const languageName          = button.getAttribute('data-name');
                deleteItemName.textContent  = languageName;
                languageId                  = button.getAttribute('data-id');
                deleteItemId.textContent    = languageId;
            });

            confirmDeleteButton.addEventListener('click', function () {

                const deleteForm = document.getElementById('delete-form-' + languageId);
                if (deleteForm) {
                  deleteForm.submit();
                } else {
                  console.error('Delete form not found for language ID:', languageId);
                }
            });
        });
    </script>
@endpush



@push('extra-styles')
    <style>
        .card-title-holder {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 30px;
        }

        .card-title-holder .card-title {
            margin-bottom: 0px;
        }

        .table img.img-holder {
            border-radius: unset;
            width: 8mm;
            height: 8mm;
            box-sizing: border-box;
        }

        .update-section {
            border-radius: 3px;
            background: #f3f3f3;
            padding: 10px;
        }

        .update-section>p {
            font-size: 12px;
            line-height: 18px;
            font-weight: 600;
            color: #555;
            padding: 10px;
            background: #fff;
            border-radius: 3px;
        }

        .update-section span {
            font-weight: 700;
            color: #333;
        }

        .top-infos {
            display: flex;
            justify-content: flex-start;
            align-content: center;
        }

        .info-data {
            flex: 3;
        }

        .qr-holder {
            flex: 1;
            overflow: hidden;
            padding: 5px;
            background: #fff;
            border-radius: 3px;
            margin-right: 10px;
        }

        .qr-holder>img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .informations>h4 {
            margin-top: 20px;
            text-indent: 20px;
        }
    </style>

    <style>
        .show-card {
            background: #fff;
            box-shadow: 0px 14px 80px rgba(34, 35, 58, 0.5);
            max-width: 100%;
            display: flex;
            flex-direction: row;
            border-radius: 6px;
            position: relative;
            overflow: hidden;
        }

        .show-card h2 {
            margin: 0;
            padding: 0 1rem;
        }

        .show-card .title {
            padding: 1rem;
            text-align: right;
            font-weight: bold;
            font-size: 12px;
        }

        .show-card .desc {
            padding: 0.5rem 1rem;
            font-size: 12px;
        }

        .show-card .actions {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            align-items: center;
            padding: 0.5rem 1rem;
        }

        .show-card svg {
            width: 85px;
            height: 85px;
            margin: 0 auto;
        }

        .img-avatar {
            width: 60px;
            height: 60px;
            position: absolute;
            border-radius: 50%;
            border: 2px solid rgb(255, 255, 255);
            background-image: linear-gradient(-60deg, #16a085 0%, #f4d03f 100%);
            top: 15px;
            left: 129px;
            overflow: hidden;
        }

        .img-avatar>img {
            width: 100%;
            height: auto;
            object-fit: contain;
        }

        .show-card-text {
            display: grid;
            grid-template-columns: 1fr 2fr;
        }

        .title-total {
            padding: 2.5em 1.5em 1.5em 1.5em;
        }

        path {
            fill: white;
        }

        .img-portada {
            width: 100%;
        }

        .portada {
            width: 100%;
            height: 100%;
            background-position: bottom center;
            background-size: cover;
        }

        button {
            border: none;
            background: none;
            font-size: 24px;
            color: #8bc34a;
            cursor: pointer;
            transition: 0.5s;
        }

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endpush
