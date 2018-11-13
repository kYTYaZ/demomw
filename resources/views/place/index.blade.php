@extends('layouts.app')



@section('styles')

<style>
    
.header{
    height: 125px !important;
}

.header-spacer{
        height: 105px !important;
}


.container-head {
    height: 65px !important;
}

.page-title{
    min-width: 100px;
   
}
</style>


@endsection


@section('content')

<places-index  :places="{{$places}}"></places-index>


@endsection
