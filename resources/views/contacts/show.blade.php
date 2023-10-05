@extends('layouts.app1')
@section('main')
<div class="container">
    <div class="row justify-content-center">
        <div class= "col-sm-8 mt-4">
            <div class= "card p-4">
                <p>Contact ID : <b>{{$contact->id}}</b></p>
                <p>Name : <b>{{$contact->name}}</b></p>
                <p>Email : <b>{{$contact->email}}</b></p>
                <p>Phone : <b>{{$contact->phone}}</b></p>
                <p>Notes : <b>{{$contact->notes}}</b></p>
            </div>
        </div>
    </div>
</div>


@endsection