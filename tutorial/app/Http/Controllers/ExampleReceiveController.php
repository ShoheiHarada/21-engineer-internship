<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\ExampleRequest;
use App\Services\ExampleReceiveService;

class ExampleReceiveController extends Controller{

    public function index(ExampleRequest $request){
        $data['comment']=$request->input('comment');
        return view('examplereceive')->with($data);

    }
    public function getcomment(ExampleReceiveService $service){
        $data["comment"]=$service->getComment();
        return $data["commnet"];

    }

}


?>