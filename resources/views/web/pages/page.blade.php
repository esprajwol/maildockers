@extends('web.layout')
@section('title', ucfirst($metaTitle))
@push('extra-styles')
<link href="{{ asset('./web/assets/css/pages/page.css') }}" rel="stylesheet">
@endpush
@section('content')
    <section>
        <div class="container">
            <div class="row">
                @isset($data)
                    <h1 class="heading page mb-4">{{ ucfirst($metaTitle) }}</h1>
                    @forelse ($data['content'] as $content)
                    {!! $content !!}
                    @empty
                    <p class="paragraph page">{{ localize('page_not_found') }}</p>
                    @endforelse
                @endisset
            </div>
        </div>
    </section>
@endsection
