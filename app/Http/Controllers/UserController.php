<?php /** @noinspection ALL */

namespace App\Http\Controllers;

use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = User::all();
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $users = User::all();
        $role_user = User::where('id', auth()->user()->id)->get()->first();
        return view('users.index', compact('role_user', 'help_desk', 'type', 'priority', 'user'))->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = User::all();
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        //Get all roles and pass it to the view
        $roles = Role::get();
        return view('users.create', ['roles' => $roles], compact('help_desk', 'priority', 'type', 'user'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //Validate name, email and password fields
        $this->validate($request, [
            'name' => 'required|max:120',
//            'email'=>'required|email|unique:users',
            'password' => 'required|min:6|confirmed'
        ]);

        $user = User::create($request->only('name', 'password', 'username', 'device_id')); //Retrieving only the email and password data
        $roles = $request['roles']; //Retrieving the roles field
        //Checking if a role was selected
        if (isset($roles)) {
            foreach ($roles as $role) {
                $role_r = Role::where('id', '=', $role)->firstOrFail();
                $user->assignRole($role_r); //Assigning role to user
            }
        }
        //Redirect to the users.index view and display message
        return redirect()->route('users.index')
            ->with('flash_message',
                'User successfully added.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::all();
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        return redirect('users', 'help_desk', 'priority', 'type');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $user = User::all();
        $type = HDtype::all();
        $priority = HDpriority::ALL();
        $help_desk = HelpDesk::where('hhd_ticket_status', '1')->get();
        $user = User::findOrFail($id); //Get user with specified id
        $roles = Role::get(); //Get all roles

        return view('users.edit', compact('decrypt', 'user', 'roles', 'help_desk', 'priority', 'type')); //pass user and roles data to view

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $user = User::findOrFail($id); //Get role specified by id

        //Validate name, email and password fields
        $this->validate($request, [
//            'name'=>'required|max:120',
//            'password'=>'required|min:6|confirmed'
        ]);
      //  $current_password =
//        dd(Hash::make("1234"));
//        dd($user->password ."  -  " .$current_password) ;

       // if ($current_password == $user->password) {
            $new_password = Hash::make($request->newPassword);
         //   dd($new_password);

            $input = $request->only(['name', 'newPassword']); //Retreive the name, email and password fields
            $roles = $request['roles']; //Retreive all roles
            $user->name = $request->name;
            $user->password = $new_password;
            $user->save();

            if (isset($roles)) {
                $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
            } else {
                $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
            }
            return redirect()->route('users.index')
                ->with('flash_message',
                    'User successfully edited.');
      //  }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')
            ->with('flash_message',
                'User successfully deleted.');
    }

    public function fill(Request $request)
    {
        $start = $request->start;
        $length = $request->length;
        $search = $request->search['value'];
        if ($search == '') {
            $order = Order::skip($start)->take($length)->get();
        } else {
            $order = Order::where('id', 'LIKE', "%$search%")
                ->orwhere('hp_project_name', 'LIKE', "%$search%")
                ->orwhere('hp_employer_name', 'LIKE', "%$search%")
                ->orwhere('hp_connector', 'LIKE', "%$search%")
                ->get();
        }

        $data = '';
        foreach ($order as $orders) {
            $data .= '["' . $orders->id . '",' . '"' . $orders->hp_project_name . '",' . '"' . $orders->hp_employer_name . '",' . '"' . $orders->hp_connector . '",' . '"' . $orders->hp_type_project . '"],';
        }
        $data = substr($data, 0, -1);
        $orders_count = Order::all()->count();
        return response('{ "recordsTotal":' . $orders_count . ',"recordsFiltered":' . $orders_count . ',"data": [' . $data . ']}');
    }
}
