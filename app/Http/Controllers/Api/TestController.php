<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Api\Traits\ApiResponseTrait;
use App\Http\Controllers\Controller;
use App\Http\Resources\TestResource;
use App\Models\Test;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestController extends Controller
{
    use ApiResponseTrait;

    public function index()
    {
        $tests = Test::first();
        return new TestResource($tests);
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(),
                        [
                            'name_ar' => 'required',
                            'name_en' => 'required',
                        ]
        );

        if ($validator->fails()){
            return $this->apiResponse($validator->errors() , 'bad request' , 400);
        }

        $test = Test::create(['name' => ['ar'=>$request->name_ar , 'en'=>$request->name_en ]]);
        return $this->apiResponse($test , 'created' , '201');
    }



    public function update(Request $request , $id)
    {

        $test = Test::find($id);
        if (!$test){
            return $this->apiResponse('no user has this id' , 'Not Found' , 404);
        }

        $validator = Validator::make($request->all(),
                        [
                            'name_ar' => 'required',
                            'name_en' => 'required',
                        ]
        );

        if ($validator->fails()){
            return $this->apiResponse($validator->errors() , 'bad request' , 400);
        }

        $test->update(['name' => ['ar'=>$request->name_ar , 'en'=>$request->name_en ]]);
        return $this->apiResponse($test , 'updated' , '200');
    }

    public function destroy($id)
    {
        $test = Test::find($id);
        if(!$test){
            return $this->apiResponse('no user has this id' , 'Not Found' , 404);
        }else{
            $deleted= $test->delete();
            return $deleted ? $this->apiResponse('the delete process completed' , 'deleted' , 202) : $this->apiResponse('no user has this id' , 'Not delete' , 304);
        }


    }
}
