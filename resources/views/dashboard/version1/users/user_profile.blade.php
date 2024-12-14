@extends('dashboard.version1.layouts.main')

@section('title', localize(' - Profile Update'))
@section('top-header', localize('Profile Information'))

@section('content')
    <form class="forms-sample" action="
                                        @if($user->user_type == 'admin')
                                        {{ route('admin.user.profileUpdate', $user->id) }}
                                        @elseif($user->user_type == 'partner')
                                        {{ route('partner.user.profileUpdate', ['id' => $user->id]) }} 
                                        @elseif($user->user_type == 'distributor')
                                        {{ route('distributor.user.profileUpdate', $user->id) }} 
                                        @endif
                                    " method="POST" enctype="multipart/form-data">
        @csrf
        @include("dashboard.version1.users.form_user")
    </form>
@stop
