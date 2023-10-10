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
                        {{-- <div class="form-group">
                           <table class="table table-bordered" id="table">
                            <tr>
                                <legend>Phone numbers</legend>
                                <td><input type="text" name="inputs[0][phonelist]" placeholder="Enter Your Phone" class="form-control" value="{{ old('phonelist')}}"/> </td>
                                <td><button type="button" name="add" id="add" class="btn btn-success ">Add More</button></td>
                            </tr>
                           </table>
                        </div> --}}
                        <div class="form-group">
                            <fieldset>
                                <legend>Phone Numbers</legend>
                                <div class="input_fields_wrap">
                                    @foreach(old('number', isset($phone) ? $phone->number : []) as $key => $item)
                                        <div class="form-group row-sm-2">
                                            <input class="text-bordered " name="number[]" type="text" value="{{$item}}">
                                        </div>
                                    @endforeach
                                </div>
                                <div class="col-sm-12">
                                    <button class="btn btn-link btn-sm add_field_button" type="button">+ Add</button>
                                </div>
                            </fieldset>
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
    {{-- <script>
        var i=0;
        $('#add').click(function(){
            ++i;
            $('#table').append(
                `<tr>
                    <td>
                        <input type="text" name="inputs[`+i+`][phonelist]" placeholder="Enter Your Phone" class="form-control"/>
                    </td>
                    <td>
                        <button type="button" class="btn btn-danger remove-table-row">Remove</button>
                    </td>
                </tr>`);
        });
        $(document).on('click','.remove-table-row',function(){
            $(this).parents('tr').remove();
        })
    </script> --}}
    <script type="text/javascript">
        
        $(document).ready(function() {
            var wrapper         = $(".input_fields_wrap"); //Fields wrapper
            var add_button      = $(".add_field_button"); //Add button ID

            $(add_button).click(function(e){ //on add input button click
                e.preventDefault();
                //add input box
                var template = `<div class="form-group text-border col-sm-2"> <input class="form-control" name="number[]" type="text"></div>`;
                $(wrapper).append(template);
            });
        });
    </script>
@endsection