@extends('layouts.master')
@section('css')
    @toastr_css
@section('title')
    {{__('Providers') }}
@stop
@endsection
@section('page-header')
<!-- breadcrumb -->
@section('PageTitle')
    {{__('Providers') }}
@stop
<!-- breadcrumb -->
@endsection
@section('content')
<!-- row -->
<div class="row">


@if ($errors->any())
    <div class="error">{{ $errors->first('Name') }}</div>
@endif



<div class="col-xl-12 mb-30">
    <div class="card card-statistics h-100">
        <div class="card-body">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <button type="button" class="button x-small" data-toggle="modal" data-target="#exampleModal">
                {{__('Add New Provider') }}
            </button>
            <br><br>

            <div class="table-responsive">
                <table id="datatable" class="table  table-hover table-sm table-bordered p-0" data-page-length="50"
                    style="text-align: center">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>{{__('Name') }}</th>
                            <th>{{__('User Name') }}</th>
                            <th>{{__('E-Mail') }}</th>
                            <th>{{__('Provider\'s Locations') }}</th>
                            <th>{{__('Added By Admin') }}</th>
                            <th>{{__('Created_at') }}</th>
                            @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                <th>{{__('Processes') }}</th>
                            @endif
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 0; ?>
                        @foreach ($providers as $provider)
                            <tr>
                                <?php $i++; ?>
                                <td>{{ $i }}</td>

                                <td>{{ $provider->name }}</td>
                                <td>{{ $provider->user_name }}</td>
                                <td>{{ $provider->email }}</td>

                                <td><a href="{{ route('user_locations', ['user_name' => $provider->user_name]) }}" target="_blank" style="color: blue">See Locations</a></td>

                                <?php $admin_name = \App\User::where('id', $provider->admin_id)->first(); ?>
                                @if ($admin_name)
                                    <td>{{ $admin_name->name }}</td>
                                @else
                                    <td> - </td>
                                @endif

                                <td>{{ $provider->created_at->diffForHumans() }}</td>

                                @if (auth()->user()->hasRole(['super_admin', 'admin']))
                                    <td class="#">
                                        <button type="button" class="btn btn-info btn-sm given" data-toggle="modal"
                                            data-target="#edit{{ $provider->id }}" style="margin-right: 40px"><i class="fa fa-edit"></i></button>

                                        @if (auth()->user()->hasRole('super_admin'))
                                            <form action="{{ route('providers.destroy', 'test') }}" method="post">
                                                {{ method_field('Delete') }}
                                                @csrf
                                                <input id="id" type="hidden" name="id" class="form-control"
                                                    value="{{ $provider->id }}">
                                                <button type="button" class="btn btn-danger btn-sm given"
                                                    onclick="confirm('{{ __("Are You Sure You Want To Delete This Provider ?") }}') ? this.parentElement.submit() : ''" style="position:absolute; margin-right: 20px; margin-top:-26px;"><i class="fa fa-trash"></i></button>
                                            </form>
                                        @endif
                                    </td>
                                @endif
                            </tr>

                            <!-- edit_modal_user -->
                            <div class="modal fade" id="edit{{ $provider->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title"
                                                id="exampleModalLabel">
                                                {{__('Edit Provider') }}
                                            </h5>
                                            <button type="button" class="close" data-dismiss="modal"
                                                aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- add_form -->
                                            <form action="{{ route('providers.update', 'test') }}" method="post">
                                                {{ method_field('patch') }}
                                                @csrf
                                                <div class="row">
                                                    <div class="col">
                                                        <div class="col-md-12">
                                                            <label for="name" class="mr-sm-2 space_top">{{__('Name') }} :</label>
                                                            <input id="name" type="text" name="name" class="form-control" value="{{ $provider->name }}" required>
                                                            <input id="id" type="hidden" name="id" class="form-control" value="{{ $provider->id }}">
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label for="email" class="mr-sm-2 space_top">{{__('E-Mail') }} :</label>
                                                            <input type="email" class="form-control" name="email" value="{{ $provider->email }}">
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label for="password" class="mr-sm-2 space_top">{{__('Password') }} :</label>
                                                            <input type="password" class="form-control" name="password" value="">
                                                        </div>

                                                        <div class="col-md-12">
                                                            <label class="mr-sm-2 space_top" for="input-password-confirmation">{{__('Confirm Password') }} :</label>
                                                            <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control" value="">
                                                        </div>

                                                        @if (auth()->user()->hasRole('super_admin'))
                                                            <div class="form-group modual_space">
                                                                <div class="col">
                                                                    <label class="mr-sm-2" for="admin_id">{{ __('Added By Admin') }} : <span
                                                                            style="color: red"> * </span> </label>
                                                                    <select name="admin_id" class="form-control custom-select selectpicker">
                                                                        <option value="0"> {{ __('Please Select---') }} </option>

                                                                        @foreach (\App\User::where('admin', '1')->get() as $admin)
                                                                            <option value="{{ $admin->id }}"  <?php if ($provider->admin_id == $admin->id) { echo 'selected'; } ?> > {{ $admin->name }} </option>
                                                                        @endforeach
                                                                    </select>
                                                                    @if ($errors->has('admin_id'))
                                                                        <span class="invalid-feedback" role="alert">
                                                                            <strong>{{ $errors->first('admin_id') }}</strong>
                                                                        </span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endif
                                                <br><br>

                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-dismiss="modal">{{__('Close') }}</button>
                                                    <button type="submit"
                                                        class="btn btn-success">{{__('Submit') }}</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                </table>
            </div>
        </div>
    </div>
</div>


<!-- add_modal_user -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 style="font-family: 'Cairo', sans-serif;" class="modal-title" id="exampleModalLabel">
                    {{__('Add New Provider') }}
                </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- add_form -->
                <form action="{{ route('providers.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <label for="name" class="mr-sm-2 space_top">{{__('Name') }} :</label>
                            <input id="name" type="text" name="name" class="form-control" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        </div>

                        <div class="col-md-12">
                            <label for="email" class="mr-sm-2 space_top">{{__('E-Mail') }} :</label>
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" required autocomplete="email">
                        </div>

                        <div class="col-md-12">
                            <label for="password" class="mr-sm-2 space_top">{{__('Password') }} :</label>
                            <input type="password" class="form-control" name="password" required autocomplete="new-password">
                        </div>

                        <div class="col-md-12  make-space">
                            <label class="mr-sm-2 space_top" for="input-password-confirmation">{{__('Confirm Password') }} :</label>
                            <input type="password" name="password_confirmation" id="input-password-confirmation" class="form-control" required>
                        </div>

                        @if (auth()->user()->hasRole('super_admin'))
                            <div class="col-md-12 form-group modual_space ">
                                <div class="col-md-12">
                                    <label class="mr-sm-2" for="admin_id">{{ __('Added By Admin') }} : <span
                                            style="color: red"> * </span> </label>
                                    <select name="admin_id" class="form-control custom-select selectpicker">
                                        <option value="0"> {{ __('Please Select---') }} </option>

                                        @foreach (\App\User::where('admin', '1')->get() as $admin)
                                            <option value="{{ $admin->id }}"> {{ $admin->name }} </option>
                                        @endforeach
                                    </select>
                                    @if ($errors->has('admin_id'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('admin_id') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @else
                         <input id="admin_id" type="hidden" name="admin_id" class="form-control" value="0">
                        @endif
                    <br><br>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">{{__('Close') }}</button>
                        <button type="submit" class="btn btn-success">{{__('Submit') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- row closed -->
@endsection
@section('js')
@toastr_js
@toastr_render
@endsection
