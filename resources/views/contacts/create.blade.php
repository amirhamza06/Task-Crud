@extends('layouts.app1')
@section('main')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8">
                <div class="card mt-3 p-3">
                    <form action="/contacts/store" method="POST">
                        @csrf
                        <div class="form-group">
                            <label>Name</label>
                            <input type="text" name="name" class="form-control" value="{{ old('name') }}"/>
                            @if ($errors->has('name'))
                                <span class="text-danger">{{ $errors->first('name') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}"/>
                            @if ($errors->has('email'))
                                <span class="text-danger">{{ $errors->first('email') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Phone</label>
                            {{-- <table class="table table-bordered" id="dynamicAddRemove">
                                <tr>
                                    <td><input type="text" name="moreFields[0][phone]" placeholder="Enter Phone" class="form-control" />
                                    </td>
                                    <td><button type="button" name="add" id="dynamic-ar" class="btn btn-outline-primary">Add Phone</button></td>
                                </tr>
                            </table> --}}
                            <input type="text" name="phone" class="form-control" value="{{ old('phone') }}"/>
                            @if ($errors->has('phone'))
                                <span class="text-danger">{{ $errors->first('phone') }}</span>
                            @endif
                        </div>
                        <div class="form-group">
                            <label>Notes</label>
                            <input type="text" name="notes" class="form-control" value="{{ old('notes') }}"/>
                            @if ($errors->has('notes'))
                                <span class="text-danger">{{ $errors->first('notes') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-dark">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection