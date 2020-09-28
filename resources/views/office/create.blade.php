@extends('layouts.appAdmin')

@section('content')
    <div class="container   ">
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-secondary py-2 px-1">
                        <h4>Add user</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('office.store') }}" method="post" autocomplete="off">
                        @csrf
                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right"></label>
                                
                                <div class="col-md-6">
                                    @if($message = Session::get('registerError'))
                                                    
                                        <div class="text-danger">
                                            {{ $message }}
                                        </div>
                                    
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="office_id" class="col-md-4 col-form-label text-md-right">{{__('Office')}}</label>
                                
                                <div class="col-md-6">

                                    <select id="" class="form-control" name="office_id" id="name" class="form-control @error('name') is-invalid @enderror">
                                   <option value=""></option>
                                    @foreach($offices as $office)
                                        <option value="{{ $office->id }}">
                                            {{ $office->name }}
                                        </option>`
                                    @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="username" class="col-md-4 col-form-label text-md-right text-no-">{{__('Username')}}</label>

                                <div class="col-md-6">
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" name="username" id="username" value="{{ old('username') }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right text-no-">{{__('Password')}}</label>

                                <div class="col-md-6">
                                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                                </div>
                            </div>

                            <div class="form-group row mb-0 text-right">
                                <div class="col-md-6 offset-md-4">
                                    <button class="btn btn-primary btn-block">
                                        <i class="fa fa-check" aria-hidden="true"></i> {{ __('Save') }}
                                    </button>
                                </div>
                                <div class="col-md-6 offset-md-4 pt-2">
                                    <button type="button" onclick="goBack()" class="btn btn-danger btn-block">
                                        <i class="fa fa-times" aria-hidden="true"></i> {{ __('Cancel') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        function goBack() {
        window.history.back();
        }
    </script>
@endsection