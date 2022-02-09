<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Response;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;


class UserController extends Controller
{
    /**
     * @var user
     */
    private $user;

    /**
     * UserController constructor.
     * @param User $college
     */
    public function __construct(User $user)
    {
//            $redis = LaravelRedis::connect();
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Request $request)
    {

        $name = $request->get('name');
        $email = $request->get('email');



//        if ($users = Redis::get('users.all')) {
//            return json_decode($users);
//        }
        $users = $this->user->where('name','like','%'.$name.'%')
            ->where('email','like','%'.$email.'%')
            ->paginate(15);


//        Redis::set('users.all', $users);


        return view('users.index')->with('data', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $user = $this->user->paginate();

        return view('users.create')->with('data',$user);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => "required|unique:users,name",
            'email' => "required|unique:users,email",
        ]);
        $request->merge(['password' => Hash::make(str_random(8))]);

        $this->user->create($request->all());

        return redirect()->route('user.index')->with('message', ['type' => 'success', 'text' => 'saved Successfully']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $user = $this->user->find($id);

        return view('users.edit')->with('data', $user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        $user = $this->user->find($id);
        $request->validate([
            'name' => "required|unique:users,name,$id,id",
            'email' => "required|unique:users,email,$id,id",
        ]);


        if (!empty($user)) {

            $user->update($request->all());

            return redirect()->route('user.index')->with('message', ['type' => 'success', 'text' => 'saved Successfully']);
        }

        return redirect()->route('home')->with('message', ['type' => 'error', 'text' => "user not found"]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return void
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = $this->user->find($id);

        if (!empty($user)) {
            $user->delete();
            return redirect()->route('user.index')->with('message', ['type' => 'success', 'text' =>"removed Successfully"]);
        }

    }
}
