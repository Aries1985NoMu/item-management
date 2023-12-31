@extends('adminlte::page')

@section('title', '商品一覧')

@section('content_header')
    <h1>商品一覧</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">商品一覧</h3>
                    <div class="card-tools">
                        <div class="input-group input-group-sm">
                            <div class="input-group-append">
                                <a href="{{ url('items/add') }}" class="btn btn-default">商品登録</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>名前</th>
                                <th>種別</th>
                                <th>個数</th>
                                <th>価格</th>
                                <th>詳細</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($items as $item)
                                <tr>
                                    <td>{{ $item->id }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->type }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ $item->price }} 円</td>
                                    <td>{{ Str::limit($item->detail, 50, '...') }}</td>
                                    <td>
                                        <a href="{{ route('items.edit', ['id'=>$item->id]) }}" class="btn btn-primary">編集</a>
                                    </td>
                                    <td>
                                        <form action="{{ url('items/delete') }}" method="POST" onsubmit="return confirm('削除します。よろしいですか？');">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $item->id }}">
                                        <input type="submit" value="削除" class="btn btn-danger">
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- ページネーション --}}
        @if ($items->hasPages())
            <div class="card-footer clearfix">
                {{ $items->links() }}
            </div>
        @endif
    </div>
@stop

@section('css')
@stop

@section('js')
@stop
