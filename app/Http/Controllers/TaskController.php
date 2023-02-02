<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Models\Task;
use Symfony\Component\HttpFoundation\Response;
class TaskController extends Controller
{
    protected $user;
 
    public function __construct()
    {
        $this->user = JWTAuth::parseToken()->authenticate();
    }

    public function ListTasks()
    {
        return $this->user
            ->tasks()
            ->get();
    }

    public function CreateTask(Request $request)
    {
        
        //Validate data
        $data = $request->only('name');
        $validator = Validator::make($data, [
            'name' => 'required|string'
        ]);
        if ($validator->fails()) {
            return response()->json(['error' => $validator->messages()], 200);
        }

        $task = $this->user->tasks()->create([
            'user_id' => $request->user_id,
            'name' => $request->name
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Product created successfully',
            'data' => $task
        ], Response::HTTP_OK);
    }

}
