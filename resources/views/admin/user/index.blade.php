@extends('admin.layouts.master')
@section('title','Kullanıcı Yönetimi')
@section('content')

    <h3 class="page-header">Kullanıcı Yönetimi</h3>
    <h4 class="sub-header">Kullanıcı Listesi</h4>
    <div class="well">
        <div class="btn-group pull-right">
            <a href="{{ route('admin.user.create') }}" class="btn btn-primary ">Yeni Kullanıcı</a>
        </div>
        <form method="post" action="{{ route('admin.user') }}" class="form-inline">
            @csrf
            <div class="form-group">
                <label for="search_value">Ara</label>
                <input type="text" class="form-control form-control-sm" name="search_value" id="search_value"
                       placeholder="Ad, Soyad, Email..." value="{{ old('search_value') }}">
            </div>
            <button type="submit" class="btn btn-primary">Ara</button>
            <a href="{{ route('admin.user') }}" class="btn btn-warning">Temizle</a>
        </form>
    </div>

    @include('layouts.partials.alert')

    <div class="table-responsive">
        <table class="table table-hover table-bordered">
            <thead class="thead-dark">
            <tr>
                <th>Id</th>
                <th>Ad</th>
                <th>Soyad</th>
                <th>Email</th>
                <th>Aktif mi ?</th>
                <th>Yönetici mi ?</th>
                <th>Kayıt Tarihi</th>
                <th>Düzenle / Sil</th>
            </tr>
            </thead>
            <tbody>
            @if(count($categoriesList)==0)
                <tr>
                    <td colspan="8" class="text-center">Kayıt Bulunamadı</td>
                </tr>
            @endif
            @foreach($usersList as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>
                        {!! $user->is_active == 1 ? '<span class="label label-success"> Aktif </span>' :
                            '<span class="label label-warning"> Pasif </span>' !!}
                    </td>
                    <td>
                        {!! $user->is_admin == 1 ? '<span class="label label-success"> Yönetici </span>' :
                            '<span class="label label-warning"> Kullanıcı </span>' !!}
                    </td>
                    <td>{{ $user->created_at }}</td>
                    <td style="width: 100px">
                        <a href="{{ route('admin.user.edit', $user->id) }}" class="btn btn-xs btn-success"
                           data-toggle="tooltip" data-placement="top"
                           title="Tooltip on top">
                            <span class="fa fa-pencil"></span>
                        </a>
                        <a href="{{ route('admin.user.delete',$user->id) }}" class="btn btn-xs btn-danger"
                           data-toggle="tooltip" data-placement="top"
                           title="Tooltip on top" onclick="return confirm('Emin misiniz?')">
                            <span class="fa fa-trash"></span>
                        </a>
                    </td>
                </tr>
            </tbody>
            @endforeach
        </table>
        {{ $usersList->links() }}
    </div>

@endsection
