<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * 商品一覧
     */
    public function index()
    {
        // 商品一覧取得
        $items = Item::all();

        return view('item.index', compact('items'));
    }

    /**
     * 商品登録
     */
    public function add(Request $request)
    {
        // POSTリクエストのとき
        if ($request->isMethod('post')) {
            // バリデーション
            $this->validate($request, [
                'name' => 'required|max:100',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'detail' => $request->detail,
            ]);

            return redirect('/items');
        }

        return view('item.add');
    }

    /**
     * 商品削除
     */
    public function delete(Request $requset)
    {
        $item = Item::find($requset->id);
        $item->delete();

        return redirect('/items');
    }

    /**
     * 編集画面
     */
    public function edit($id)
    {
        $item = Item::find($id);

        return view('item.edit', compact('item'));
    }

    /**
     * 更新処理
     */
    public function update(Request $request, $id)
    {
        // バリデーション
        $this->validate($request, [
            'name' => 'required|max:100',
            // 他のフィールドに対するバリデーションルールを追加
        ]);

        // 更新対象の商品を取得
        $item = Item::find($id);

        if (!$item) {
            // 商品が見つからない場合のエラーハンドリングを行う
            return redirect()->route('item.index')->with('error', '指定された商品が見つかりません');
        }

        // フォームから送信されたデータで商品情報を更新
        $item->name = $request->input('name');
        $item->type = $request->input('type');
        $item->detail = $request->input('detail');

        // 商品情報を保存
        $item->save();

        return redirect()->route('item.index')->with('success', '商品が更新されました');
    }
}
