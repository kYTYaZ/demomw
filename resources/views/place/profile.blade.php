@extends('layouts.app')



@section('styles')

<style>
    .container-fluid{
        padding: 0px !important
    }
    
    
.header-spacer {
    display: block;
    height: 45px;
}
</style>

@endsection


@section('content')

<places-profile  :place="{{$place}}" :user="{{Auth::user()}}"></places-profile>


@endsection
