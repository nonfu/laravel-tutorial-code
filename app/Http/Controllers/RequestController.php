<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function form(Request $request, $id)
    {
        // 通过 $request 实例获取请求数据
        // dd($request->all());
        // dd($request->except('id'));
        // dd($request->only(['name', 'site', 'domain']));
        // $id = $request->has('id') ? $request->get('id') : 0;
        // dd($id);
        // dd($request->input('books'));
        // dd($request->input('books.0'));
        // dump($request->input('books.0.author'));
        // dump($request->input('books.1'));
        dump($request->json('site'));
        dump($request->input('books.0.author'));
        dump($request->input('books.1'));
        dump($request->segments());
        dump($id == $request->segment(2));
    }

}
