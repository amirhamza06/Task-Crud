@extends('layouts.app1')
@section('main')
    <div class="container">
        <div class="text-right">
            <a href="/contacts/create" class="btn btn-dark mt-2">New Contact</a>
        </div>
        <h1>Contacts</h1>
        <center>
            <form action="/search_data" method="GET">
                <input type="text" class="border-dark" name="search" >
                <button type="submit" class="btn btn-dark">Search Record</button>
            </form>
        </center>
        <table class="table table-hover mt-2">
            <thead>
                <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Notes</th>
                <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($contacts as $contacts)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td><a href="/contacts/{{ $contacts->id }}/show" class="text-dark">{{ $contacts->name }}</a></td>
                        <td>{{ $contacts->email }}</td>
                        <td>    
                           {{-- @foreach ($contacts->phone as $item)
                               <li>
                                    {{ $item->phone }}
                               </li>
                           @endforeach --}}
                           
                                    {{ $contacts->phone->number }}
                              
                        </td>
                        
                        <td>{{ $contacts->notes }}</td>
                        <td>
                            <a href="/contacts/{{ $contacts->id }}/edit" class="btn btn-dark btn-sm">Edit</a>
                            <form method = "POST" class="d-inline" action="/contacts/{{ $contacts->id }}/delete">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection