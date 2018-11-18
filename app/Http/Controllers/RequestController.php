<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubmitFormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RequestController extends Controller
{
    public function form(SubmitFormRequest $request)
    {
        return response('表单验证通过');
    }

    public function formPage()
    {
        return view('request.form');
    }

    public function fileUpload(Request $request)
    {
        $this->validate($request, [
            'picture' => 'bail|required|image|mimes:jpg,png,jpeg|max:1024'
        ],[
            'picture.required' => '请选择要上传的图片',
            'picture.image' => '只支持上传图片',
            'picture.mimes' => '只支持上传jpg/png/jpeg格式图片',
            'picture.max' => '上传图片超过最大尺寸限制(1M)'
        ]);

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
