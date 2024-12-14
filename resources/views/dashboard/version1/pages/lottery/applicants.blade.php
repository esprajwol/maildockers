@extends('dashboard.layouts.main')

@section('title', localize(' - Applicants Lists'))

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
                <div class="card-title-holder">
                    <h4 class="card-title">{{localize('All Applicants')}}</h4>
                    @if(count($applicants) > 0)
                        @if($lotteryEnds == false)
                            @if($lottery->has_winner)
                                <span class="alert alert-success"><strong>{{localize('Complete:')}}</strong> {{localize('The Lottery is completed, the winner is')}} {{ $lottery->winner }}.</span>
                            @else
                                <span class="alert alert-success"><strong>{{localize('Complete:')}}</strong> {{localize('The Lottery is completed, admin can select winner randomly.')}}</span>
                                <form method="post" action="{{ route('admin.lottery.applicant.random.winner', ['lotteryId' => $lottery->id]) }}" style="display: inline-block;">
                                    @method('post')
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-gradient-danger"
                                        title="Random Winner"
                                        onclick="return confirm('Are you sure you want to select random winner?')">
                                        {{localize('Random Winner')}}
                                    </button>
                                </form>
                            @endif
                        @endif
                        @if($lotteryEnds == true)
                        <span class="alert alert-warning"><strong>{{localize('Uncomplete:')}}</strong> {{localize('The Lottery is un-complete, winner cannot be selected.')}}</span>
                        @endif
                    @endif
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th> {{localize('ID')}} </th>
                                <th> {{localize('Full Name')}} </th>
                                <th> {{localize('Email')}} </th>
                                <th> {{localize('Lottery Title')}} </th>
                                <th> {{localize('Applied Date')}} </th>
                                <th> {{localize('Action')}} </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($applicants as $applicant)
                            <tr class="applicantRow">
                                <td> {{$applicant->id}} </td>
                                <td> {{$applicant->fullname}} </td>
                                <td> {{$applicant->email}} </td>
                                <td> {{$applicant->lottery->title}} </td>
                                <td> {{$applicant->created_at->diffForHumans()}} </td>
                                <td>
                                    @if($lotteryEnds == false)
                                        @if(!$lottery->has_winner)
                                        <form method="post" action="{{ route('admin.lottery.applicant.winner', ['id' => $applicant->id]) }}" style="display: inline-block;">
                                            @method('post')
                                            @csrf
                                            <button type="submit"
                                                class="btn btn-gradient-primary btn-icon"
                                                title="Select Winner"
                                                onclick="return confirm('Are you sure? You are about to select a winner.')">
                                                <i class="mdi mdi-target-account"></i>
                                            </button>
                                        </form>
                                        @else
                                            @if($applicant->is_winner)
                                            <span class="badge badge-success">{{localize('Winner Selected')}}</span>
                                            @endif
                                        @endif
                                    @endif
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer">
                {{ $applicants->links() }}
            </div>
        </div>
    </div>
</div>
@stop

@push('extra-styles')
    <style>
        .applicantRow {
            cursor: pointer;
        }

        .applicantRow button {
            display: none;
        }

        .applicantRow:hover button {
            display: block;
        }
    </style>
@endpush
