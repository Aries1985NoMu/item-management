@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>ユーザー一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">ユーザー一覧</h3>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>Email</th>
                                @can('admin')
                                    <th>詳細</th>
                                @endcan
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{ $user->id }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    @can('admin')
                                        <td></td>
                                    @endcan
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- ページネーション --}}
        @if ($users->hasPages())
            <div class="card-footer clearfix">
                {{ $users->links() }}
            </div>
        @endif
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
