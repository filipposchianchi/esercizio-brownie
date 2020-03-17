<?php

namespace App\Http\Controllers;

use Intervention\Image\ImageManagerStatic as Image;

use Illuminate\Http\Request;
use App\Img;
use App\Form;

class ImgController extends Controller
{
    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [

            'filename' => 'required',
            'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if($request->hasfile('filename'))
        {
                 foreach($request->file('filename') as $image)
            {
        
                $fileName = strtolower($image->getClientOriginalName());
                $destinationPath = public_path().'/images/';
                
                $img = Image::make($image);
                $img -> blur(25);
                                
                $watermark = Image::make('images/logo_brownie.png');
                $img->insert($watermark, 'center');
                $img->save($destinationPath.'/'.$fileName);

                $imgDb= new Img();
                $imgDb->imagePath = $destinationPath.$fileName;

                $imgDb->save();
                
                $data[] = $img;  
            }
        }

        if(count($data)> 1 ) {
            return back()->with('success', 'Immagini salvate');
        }
        else {
            return back()->with('success', 'Immagine salvata'); 
        }
    }
    
}
