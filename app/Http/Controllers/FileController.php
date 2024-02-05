<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Image;
class FileController extends Controller
{
    public function index()
    {
    	return view('welcome');
    }
    public function imgToGreyscale(Request $request)
    {
        $input = $request->all();
        $this->validate($request, [
              'file' => 'required|image|mimes:jpg,jpeg,png,gif,svg|max:2048',
          ]);

          $image = $input['file'];
          $input['file'] = time().'.'.$image->getClientOriginalExtension();
          $img = Image::make($image->getRealPath());
          $img->greyscale()->save(public_path('/uploads').'/'.$input['file']);

          return redirect()->back()->with('success','Grayscale file uploaded.')->with('image', $input['file']);
    }
}
