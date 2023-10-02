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
        $items = Item::paginate(5);

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
                'quantity' => 'integer',
                'price' => 'integer',
            ]);

            // 商品登録
            Item::create([
                'user_id' => Auth::user()->id,
                'name' => $request->name,
                'type' => $request->type,
                'quantity' => $request->quantity,
                'price' => $request->price,
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
     * 商品編集
     */
    public function edit($id)
    {
        $item = Item::find($id);
        if(!$item) {
            return redirect('/items')->with('error', '指定された商品は存在しません');
        }
        
        return view('item.edit', compact('item'));
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        if(!$item) {
            return redirect('/items')->with('error', '指定された商品は存在しません');
        }

        $inputs = $request->validate([
            'name' => 'required|max:100',
            'type' => 'required',
            'quantity' => 'required',
            'price' => 'required',
            'detail' => 'nullable',
        ]);

        $item->name = $inputs['name'];
        $item->type = $inputs['type'];
        $item->quantity = $inputs['quantity'];
        $item->price = $inputs['price'];
        $item->detail = $inputs['detail'];
        $item->save();

        return redirect('/items')->with('success', '商品が更新されました');
    }
}
