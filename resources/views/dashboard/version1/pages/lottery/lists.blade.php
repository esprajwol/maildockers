@extends('dashboard.layouts.main')

@section('title', localize(' - Lottery Lists'))

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

        .btn {
            display: inline-flex;
            justify-content: center;
            align-items: center;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    @if (Helper::is_super_admin())
                        <div class="card-title-holder">
                            <h4 class="card-title">{{localize('All Lotteries')}}</h4>
                            <a href="{{ route('admin.lottery.create') }}"
                                class="btn btn-gradient-primary btn-icon-text btn-sm">
                                <i class="mdi mdi-plus btn-icon-prepend"></i> {{localize('Create New')}}
                            </a>
                        </div>
                    @endif
                    <hr>
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th> {{localize('ID')}} </th>
                                    <th> {{localize('Title')}} </th>
                                    <th> {{localize('Series')}} </th>
                                    <th> {{localize('Starts On')}} </th>
                                    <th> {{localize('Ends On')}} </th>
                                    <th> {{localize('Applicant')}} </th>
                                    <th> {{localize('Status')}}</th>
                                    <th> {{localize('Action')}}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($lotteries as $lottery)
                                    <tr>
                                        <td> {{ $lottery->id }} </td>
                                        <td> {{ $lottery->title }} </td>
                                        <td>
                                            {{ $lottery->series?->model?->model_name ?: "N/A" }}
                                        </td>
                                        <td> {{ $lottery->from_date }} </td>
                                        <td> {{ $lottery->to_date }} </td>
                                        <td> {{ isset($lottery->applicants) ? count($lottery->applicants) : 0 }} </td>
                                        <td>
                                            <label
                                                class="badge {{ $lottery->is_active ? 'badge-gradient-success' : 'badge-gradient-danger' }}">{{ $lottery->is_active ? 'Open' : 'Close' }}</label>
                                        </td>
                                        <td>
                                            <a href="{{ route('distributor.lottery.applicants', ['id' => $lottery->id]) }}"
                                                class="btn btn-gradient-primary btn-icon btn-sm"
                                                title="View Lottery Applicants"><i
                                                    class="mdi mdi-account-check-outline"></i></a>

                                            <a href="{{ route('distributor.lottery.change.status', ['id' => $lottery->id]) }}"
                                                class="btn {{ !$lottery->is_active ? 'badge-gradient-success' : 'badge-gradient-primary' }} btn-icon btn-sm"
                                                title="{{ !$lottery->is_active ? 'Open' : 'Close' }} Lottery">
                                                <i
                                                    class="mdi {{ !$lottery->is_active ? 'mdi-lock-open-outline' : 'mdi-lock-outline' }}"></i>
                                            </a>
                                            @if (isDistributor())
                                                <a href="{{ route('distributor.lottery.update', ['id' => $lottery->id]) }}"
                                                    class="btn btn-gradient-warning btn-icon btn-sm" title="Edit Lottery"><i
                                                        class="mdi mdi-square-edit-outline"></i></a>

                                                <form method="post"
                                                    action="{{ route('distributor.lottery.delete', $lottery->id) }}"
                                                    style="display: inline-block;">
                                                    @method('delete')
                                                    @csrf
                                                    <button type="submit" class="btn btn-gradient-danger btn-icon btn-sm"
                                                        title="Delete Lottery"
                                                        onclick= "return confirm('Are You Sure Want to Delete?')">
                                                        <i class="mdi mdi-trash-can-outline"></i>
                                                    </button>
                                                </form>
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="card-footer">
                    {{ $lotteries->links() }}
                </div>
            </div>
        </div>
    </div>
@stop
