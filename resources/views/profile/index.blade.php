@extends('layouts.app')



@section('styles')


<style >

     .home-container{
        padding: 0px  !important
    }

    
.header-spacer {
    display: block;
    height: 45px;
}
</style>
@endsection


@section('content')

<profile-index  :user="{{$profile}}"></profile-index>


@endsection
