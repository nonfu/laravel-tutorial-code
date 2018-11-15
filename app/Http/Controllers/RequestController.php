<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function formPage()
    {
        return view('request.form');
    }

    public function fileUpload(Request $request)
    {
        if ($request->hasFile('picture')) {
            $picture = $request->file('picture');
            if (!$picture->isValid()) {
                abort(400, '无效的上传文件');
            }
            // 文件扩展名
            $extension = $picture->getClientOriginalExtension();
            // 文件名
            $fileName = $picture->getClientOriginalName();
            // 生成新的统一格式的文件名
            $newFileName = md5($fileName . time() . mt_rand(1, 10000)) . '.' . $extension;
            // 图片保存路径
            $savePath = 'images/' . $newFileName;
            // Web 访问路径
            $webPath = '/storage/' . $savePath;
            // 将文件保存到 storage/app/public/images 目录下，先判断同名文件是否已经存在
            if (Storage::disk('public')->has($savePath)) {
                return response()->json(['path' => $webPath]);
            }
            if ($picture->storePubliclyAs('images', $newFileName, ['disk' => 'public'])) {
                return response()->json(['path' => $webPath]);
            }
            abort(500, '文件上传失败');
        } else {
            abort(400, '请选择要上传的文件');
        }
    }
}
