@extends('dashboard.layouts.main')

@section('title', localize(' - Update Lottery'))
@push('extra-styles')
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/css/select2.min.css" rel="stylesheet"/>
@endpush

@section('content')
<div class="row">
    <div class="col-md-12 col-lg-12 col-sm-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">{{localize('Update New Lottery')}}</h4>
                <br>
                {{-- <p class="card-description"> From here you can create new lottery. </p> --}}
                <form class="forms-sample" action="{{ route('distributor.lottery.update', ['id' => $lottery->id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group has-validation">
                        <label for="title">{{localize('Title')}}</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="eg: Boxing Day Lottery" value={{$lottery->title}}>
                        @error('title')
                        <small id="title" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="Description">{{localize('Description')}}</label>
                        <textarea class="summernote" name="description">@if(isset($lottery)) {!! $lottery->description !!} @endif</textarea>
                        @error('description')
                        <small id="title" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label for="series_id">{{localize('Series')}}</label>
                        <select name="series_id" id="series_id" class="form-control select2 @error('brand') is-invalid @enderror" style="padding: 0.94rem 1.375rem!important;">
                            <option value="">{{localize('Choose Series')}}</option>
                            @foreach($series as $srs)
                                <option value="{{ $srs->id }}" {{($srs->id == $lottery->series_id) ? 'selected' : ''}}>{{ $srs->model?->model_name }}</option>
                            @endforeach
                        </select>
                        @error('series_id')
                        <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        @if(isset($lottery->file))
                            <img src="{{ asset($lottery->file) }}" alt="Previous Image" class="img-thumbnail" style="height: 90px; width: 100px">
                            <br><br>
                        @endif
                        <label for="file">{{localize('Cover Image')}}</label>
                        <input type="file" class="form-control @error('file') is-invalid @enderror" id="file" name="file">
                        @error('file')
                        <small id="title" class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group has-validation">
                        <label>{{localize('Select Lottery Date Range')}}</label>
                        <input type="text" class="form-control @error('date') is-invalid @enderror" name="date" value="{{$lottery->from_date}} - {{ $lottery->to_date }}" />
                        @error('date')
                        <small id="date" class="text-danger">{{ $message }}</small>
                        @enderror
                        <input type="hidden" name="from_date" value="{{ $lottery->from_date }}">
                        <input type="hidden" name="to_date" value="{{ $lottery->to_date }}">
                    </div>
                    <button type="submit" class="btn btn-gradient-primary me-2">{{localize('Update')}}</button>
                    <a href="{{ route('distributor.lottery.lists') }}" class="btn btn-gradient-danger">{{localize('Show List')}}</a>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@push('extra-styles')
<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
@endpush

@push('extra-scripts')
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $('.summernote').summernote();
        });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.10/js/select2.min.js"></script>
    <script>
        $('#series_id').select2({
            width: '100%',
            placeholder: "Select an Option",
            allowClear: true
        });
    </script>
{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script> --}}
<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<script type="text/javascript">
    $(function() {

      $('input[name="date"]').daterangepicker({
          autoUpdateInput: false,
          locale: {
              cancelLabel: 'Clear'
          }
      });

      $('input[name="date"]').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('MM/DD/YYYY') + ' - ' + picker.endDate.format('MM/DD/YYYY'));
          $('input[name="from_date"]').val(picker.startDate.format('MM/DD/YYYY'));
          $('input[name="to_date"]').val(picker.endDate.format('MM/DD/YYYY'));
      });

      $('input[name="date"]').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
          $('input[name="from_date"]').val();
          $('input[name="to_date"]').val();
      });
    });
</script>
@endpush
