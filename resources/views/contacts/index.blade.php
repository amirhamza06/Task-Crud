@extends('layouts.app1')
@section('main')
    <div class="container">
        <div class="text-right">
            <a href="/contacts/create" class="btn btn-dark mt-2">New Contact</a>
        </div>
        <h1>Contacts</h1>
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
                @foreach ($contacts as $contact)
                    <tr>
                        <td>{{ $loop->index+1 }}</td>
                        <td><a href="/contacts/{{ $contact->id }}/show" class="text-dark">{{ $contact->name }}</a></td>
                        <td>{{ $contact->email }}</td>
                        <td>{{ $contact->phone }}</td>
                        <td>{{ $contact->notes }}</td>
                        <td>
                            <a href="/contacts/{{ $contact->id }}/edit" class="btn btn-dark btn-sm">Edit</a>
                            <form method = "POST" class="d-inline" action="/contacts/{{ $contact->id }}/delete">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger btn-sm" type="submit">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $contacts->links() }}
    </div>
@endsection