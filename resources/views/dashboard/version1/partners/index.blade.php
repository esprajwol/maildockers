@extends('dashboard.version1.layouts.main')

@section('title', ' - Partner Lists')

@section('content')
    <!-- Start:: row-7 -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="top-left"></div>
                <div class="top-right"></div>
                <div class="bottom-left"></div>
                <div class="bottom-right"></div>
                <div class="card-header justify-content-between">
                    <div class="card-title">
                        {{ localize("All Partners") }}
                    </div>
                    <div class="prism-toggle">
                        <a href="{{ route('admin.partners.create') }}" class="btn btn-sm btn-primary-light"><i
                                class="ri-plus ms-2 d-inline-block align-middle"></i>{{ localize("Add New Partner") }}
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-nowrap">
                            <thead class="table-primary">
                            <tr>
                                <th scope="col"> {{ localize(" ID ") }}</th>
                                <th scope="col"> {{ localize(" Name") }} </th>
                                <th scope="col"> {{ localize("Username")}} </th>
                                <th scope="col"> {{ localize("Email")}} </th>
                                <th scope="col"> {{ localize("Photo")}} </th>
                                <th scope="col"> {{ localize("Status")}} </th>
                                <th scope="col"> {{ localize("Action")}} </th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($partners as $partner)
                            <tr>
                                <th scope="row">{{ $partner->id }}</th>
                                <td> {{ $partner->fullName }} </td>
                                <td> {{ $partner->username }} </td>
                                <td> {{ $partner->email }} </td>
                                <td>
                                        <img src="{{ urlVersion($partner->photo) }}" loading="lazy" class="cmnImg" style="heigth:30px;width:30px; alt="Partner Photo" />
                                </td>
                                <td>
                                    <label class="badge {{ $partner->is_active ? 'badge-gradient-success' : 'badge-gradient-danger' }}">{{ $partner->is_active ? 'Active' : 'Inactive' }}</label>
                                </td>
                                <td>
                                    <div class="hstack gap-2 fs-15">

                                        <a href="{{ route('admin.partners.edit', $partner->id) }}"
                                           class="btn btn-icon btn-sm btn-info-transparent rounded-pill"><i
                                                class="ri-edit-line"></i></a>
                                        <!-- <form id="delete-form" method="POST" action="{{ route("admin.partners.destroy",["partner"=>$partner->id])}}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-icon btn-sm btn-danger-transparent rounded-pill">
                                                <i class="ri-delete-bin-line"></i>
                                            </button>
                                        </form> -->

                                    </div>
                                </td>
                            </tr>
                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End:: row-7 -->

@stop
