@extends('adminlte::page')

@section('title', '商品編集')

@section('content_header')
    <h1>商品編集</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-10">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card card-primary">
                <form method="POST" action="{{ route('items.update', ['id' => $item->id]) }}">
                    @csrf
                    @method('PUT') {{-- HTTPのPUTメソッドを使用 --}}

                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="名前" value="{{ $item->name }}">
                        </div>

                        <div class="form-group">
                            <label for="type">種別</label>
                            <input type="text" class="form-control" id="type" name="type" placeholder="種別" value="{{ $item->type }}">
                        </div>

                        <div class="form-group">
                            <label for="detail">個数</label>
                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="個数" value="{{ $item->quantity }}">
                        </div>


                        <div class="form-group">
                            <label for="detail">価格</label>
                            <input type="text" class="form-control" id="price" name="price" placeholder="価格" value="{{ $item->price }}">
                        </div>

                        <div class="form-group">
                            <label for="detail">詳細</label>
                            <input type="text" class="form-control" id="detail" name="detail" placeholder="詳細説明" value="{{ $item->detail }}">
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">更新</button>
                        <a href="{{ url('/items') }}" class="btn btn-secondary">戻る</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
@stop

@section('js')
@stop