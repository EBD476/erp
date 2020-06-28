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

    public function index()
    {

        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $users = User::all();
        $role_user = User::where('id', auth()->user()->id)->get()->first();
        return view('users.index', compact('role_user', 'help_desk', 'type', 'priority', 'user'))->with('users', $users);
    }

    public function create()
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        //Get all roles and pass it to the view
        $roles = Role::get();
        return view('users.create', ['roles' => $roles], compact('help_desk', 'priority', 'type', 'user'));
    }

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

    public function show($id)
    {
        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        return redirect('users', 'help_desk', 'priority', 'type');
    }

    public function edit($id)
    {

        $current_user = auth()->user()->id;
        $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
        $type = HDtype::select('th_name', 'id')->get();
        $priority = HDpriority::select('id', 'hdp_name')->get();
        $user = User::select('id', 'name')->get();
        $users = User::findOrFail($id); //Get user with specified id
        $roles = Role::get(); //Get all roles

        return view('users.edit', compact('decrypt', 'user', 'users', 'roles', 'help_desk', 'priority', 'type')); //pass user and roles data to view

    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id); //Get role specified by id
        $user->name = $request->name;
        $user->username = $request->username;
        //Validate name, email and password fields
//        $this->validate($request, [
//            'name' => 'required|max:120',
////            'password'=>'required|min:6|confirmed'
//        ]);
        if ($request->newPassword != "") {
            $result = Hash::check($request->password, $user->password);
            if ($result == true) {
                $input = $request->only(['name', 'newPassword']); //Retreive the name, email and password fields
                $user->password = $request->newPassword;
            }
        }
        if ($request['roles'] != "") {
            $roles = $request['roles']; //Retreive all roles
        }
        $user->save();

        if ($request['roles'] != "") {
            if (isset($roles)) {
                $user->roles()->sync($roles);  //If one or more role is selected associate user to roles
            } else {
//                $user->roles()->detach(); //If no role is selected remove exisiting role associated to a user
            }
        }
        return redirect()->route('users.index')
            ->with('flash_message',
                'User successfully edited.');

    }

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
