<?php

namespace App\Http\Controllers;

use App\Agreement;
use App\Client;
use App\ConversationView;
use App\HDpriority;
use App\HDtype;
use App\HelpDesk;
use App\Order;
use App\OrderProduct;
use App\OrderState;
use App\ProcessLevel;
use App\Project;
use App\RepositoryProduct;
use App\Support;
use App\User;
use Hekmatinasser\Verta\Verta;
//use Verta;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use phpDocumentor\Reflection\Types\Null_;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()

    {
        if (Hash::check(12345678, auth()->user()->password)) {
            return view('auth.passwords.change_password');
        } else {
            $current_user = Auth()->user()->id;

            $help_desk = HelpDesk::select('hhd_request_user_id', 'id', 'hhd_type', 'hhd_priority')->where('hhd_ticket_status', '1')->where('hhd_receiver_user_id', $current_user)->get();
            $type = HDtype::select('th_name', 'id')->get();
            $priority = HDpriority::select('id', 'hdp_name')->get();
            $user = User::select('id', 'name')->get();

            $support_response = Support::where('hs_status', '2')->get();
            $client = Client::all()->count();
            $client_order = Client::where('hc_dealership_number', $current_user)->count();
            $agreement = Agreement::all()->count();
            $agreement_order = Agreement::where('ha_dealership_number', $current_user)->count();

            $un_seen_message = HelpDesk::where('hhd_receiver_user_id', $current_user)->where('hhd_ticket_status', '1')->count();

            //order panel
            $order_order = Order::select('id')
                ->whereNotNull('hp_Invoice_number')->where('hp_residential', $current_user)->count();
            $order_req = Order::select('id')
                ->whereNotNull('hp_Invoice_number')->count();
            $order = Order::select('id', 'hp_project_name', 'created_at')
                ->where('hp_Invoice_number', Null)->get();
            $order_agent = Order::select('id', 'hp_project_name', 'created_at')
                ->where('hp_registrant', $current_user)->get();
            $orders = Order::all()->count();
            //end order panel

            //computing qc section widget
            $current_user_role_id = DB::table('users')
                ->join('model_has_roles', 'users.id', 'model_has_roles.model_id')
                ->select('model_has_roles.role_id')
                ->where('users.id', '=', $current_user)
                ->get()
                ->last();

            $qc_role_id = DB::table('hnt_organizational_departments')
                ->select('hnt_organizational_departments.id')
                ->where('hnt_organizational_departments.hod_role_id', '=', $current_user_role_id->role_id)
                ->where('hnt_organizational_departments.deleted_at', '=', Null);

            $inventory_qc = DB::table('hnt_repository_product')
                ->join('hnt_repository','hnt_repository_product.hr_repository_id','hnt_repository.hr_priority_id')
                ->joinSub($qc_role_id, 'latest_posts', function ($join) {
                    $join->on('hnt_repository.hr_department_id', '=', 'latest_posts.id');
                })
                ->selectRaw('SUM(hnt_repository_product.hr_product_stock)as total')
                ->where('hnt_repository_product.deleted_at','=',Null)
                ->get();

            $inventory_qc_returned = DB::table('hnt_repository_product')
                ->join('hnt_repository','hnt_repository_product.hr_repository_id','hnt_repository.hr_priority_id')
                ->joinSub($qc_role_id, 'latest_posts', function ($join) {
                    $join->on('hnt_repository.hr_department_id', '=', 'latest_posts.id');
                })
                ->selectRaw('SUM(hnt_repository_product.hr_return_value)as total')
                ->where('hnt_repository_product.deleted_at','=',Null)
                ->where('hnt_repository_product.hr_return_value','!=',Null)
                ->get();

            $queue_qc = OrderProduct::where('hpo_status','4')->count();

            //end qc panel

            $projects = Project::all();
            $product_requirement = DB::select("SELECT sum(Product_Count) as sum_hpo FROM hnt_product_requirements");
            $process_level = ProcessLevel::select('hp_process_id', 'hp_process_name')->get();
            $progress = OrderState::select('order_id')->get();

            return view('home', ['product_requirement' => $product_requirement], compact('progress', 'un_seen_message', 'process_level', 'order_agent', 'order_order', 'agreement_order', 'client_order', 'user', 'order', 'projects', 'order_req', 'agreement', 'client', 'orders', 'support_response', 'help_desk', 'priority', 'type','inventory_qc','queue_qc','inventory_qc_returned'));
        }
    }

}
