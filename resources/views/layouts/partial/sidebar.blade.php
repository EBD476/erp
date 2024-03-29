<div class="sidebar" data="purple">
    <!-- Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"-->
    <div class="sidebar-wrapper">
        <div class="logo">
            <a href="javascript:void(0)" class="simple-text logo-mini">

            </a>

            <a href="javascript:void(0)" class="simple-text logo-normal">
                <small>{{__('Hanta Smart Home')}}</small>
            </a>
        </div>
        @role('Admin')
        <!-- Sidebar -->
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36" style="float: right"></i>
                    <p>{{__('Dashboard')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-toggle="collapse" href="#componentsExamples" aria-expanded="false">
                    <i class="tim-icons icon-pencil" style="float: right"></i>
                    <p>
                        {{__('Orders')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples" style="">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('order.index') }}">
                                <i class="tim-icons icon-pencil"></i>
                                <span class="sidebar-normal"> {{__('Order')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{Route('order.invoices_list_product')}}">
                                <i class="tim-icons icon-bullet-list-67"></i> <span
                                        class="sidebar-normal"> {{__('Product Invoices List')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#formsExamples">
                    <i class="tim-icons icon-paper" style="float: right"></i>
                    <p>
                        {{__('Agreement')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="formsExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('agreement.index') }}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal"
                                >{{__('Agreement Management')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#tablesExamples">
                    <i class="tim-icons icon-money-coins" style="float: right"></i>
                    <p>
                        {{__('Finance')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="tablesExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('finance.index') }}">
                                <i class="tim-icons icon-coins"></i>
                                <span class="sidebar-normal">{{__('Finance Product')}}</span>
                            </a>
                        </li>
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="{{ route('finance.index') }}">--}}
                                {{--<i class="tim-icons icon-coins"></i>--}}
                                {{--<span class="sidebar-normal"> {{__('Debit')}}</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('product.product-price-index') }}">
                                <i class="tim-icons icon-coins"></i>
                                <span class="sidebar-normal">{{__('Products Price')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('fund.index') }}">
                                <i class="tim-icons icon-coins"></i>
                                <span class="sidebar-normal">
                                    {{__('Fund')}}
                                </span>
                            </a>
                        </li>
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="{{ route('finance.index') }}">--}}
                                {{--<i class="tim-icons icon-coins"></i>--}}
                                {{--<span class="sidebar-normal"> {{__('Revenue')}}</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="{{ route('finance.index') }}">--}}
                                {{--<i class="tim-icons icon-coins"></i>--}}
                                {{--<span class="sidebar-normal"> {{__('Costs')}}</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ProductExamples">
                    <i class="tim-icons icon-app" style="float: right"></i>
                    <p>
                        {{__('Production')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="ProductExamples" style="">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{Route('product.index')}}">
                                <i class="tim-icons icon-paper" style="size: 8px"></i>
                                <span class="sidebar-normal">{{__('Products Management')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{Route('middle-part.index')}}">
                                <i class="tim-icons icon-paper" style="size: 8px"></i>
                                <span class="sidebar-normal">{{__('Middle Part')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('part.index')}}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal">{{__('Parts')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('product-part.index')}}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <span class="sidebar-normal">{{__('Product Parts')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{Route('product-middle-part.index')}}">
                                <i class="tim-icons icon-bullet-list-67" style="size: 8px"></i>
                                <span class="sidebar-normal">{{__('Product Middle Part')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{Route('middle-section-part.index')}}">
                                <i class="tim-icons icon-bullet-list-67" style="size: 8px"></i>
                                <span class="sidebar-normal">{{__('Middle Section Part')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('product_requirement.index')}}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal"
                                >{{__('Product Requirement')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('middle-part-requirement.index')}}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal"
                                >{{__('Middle part Requirement')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('part-requirement.index')}}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal"
                                >{{__('part Requirement')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('inventory-product.index')}}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal"
                                >{{__('Inventory Product')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('product-task.index')}}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal">{{__('Product Task')}}</span>
                            </a>
                            <a class="nav-link" href="{{ route('product-task.report-list')}}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal">{{__('Product Report List')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('product-zone.index')}}">
                                <i class="tim-icons icon-chart-pie-36"></i>
                                <span class="sidebar-normal">{{__('Product Zone')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('product-status.index')}}">
                                <i class="tim-icons icon-atom"></i>
                                <span class="sidebar-normal">{{__('Product Status')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('provider.index')}}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal">{{__('Provider')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('product-color.index')}}">
                                <i class="tim-icons icon-palette"></i>
                                <span class="sidebar-normal">{{__('Product Color')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('product-property.index')}}">
                                <i class="tim-icons icon-bag-16"></i>
                                <span class="sidebar-normal">{{__('Product Property')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('product-property-items.index')}}">
                                <i class="tim-icons icon-bag-16"></i>
                                <span class="sidebar-normal">{{__('Product Property Items')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#projectExamples">
                    <i class="tim-icons icon-molecule-40" style="float: right"></i>
                    <p>
                        {{__('Project')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="projectExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('projects.index') }}">
                                <i class="tim-icons icon-paper"></i> <span
                                        class="sidebar-normal">{{__('Projects Management')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('map')}}">
                                <i class="tim-icons icon-square-pin"></i>
                                <span class="sidebar-normal"
                                >{{__('Projects Map')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#RepositoryExamples">
                    <i class="tim-icons icon-bank" style="float: right"></i>
                    <p>
                        {{__('Repository')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="RepositoryExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('repository_create.index')}}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal">{{__('Create Repository')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('organizational-department.index')}}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal">{{__('Organizational Departments')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('repository.create')}}"
                               class="nav-link">
                                <i class="tim-icons icon-paper"></i> <span
                                        class="sidebar-normal"> {{__('Increase inventory')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('repository.index')}}">
                                <i class="tim-icons icon-bank"></i>
                                <span class="sidebar-normal">{{__('Repositories List')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#qcExamples">
                    <i class="tim-icons icon-components" style="float: right"></i>
                    <p>
                        {{__('QC')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="qcExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{Route('qc.index')}}">
                                <i class="tim-icons icon-components"></i> <span
                                        class="sidebar-normal"> {{__('QC Management')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#InstallExamples">
                    <i class="tim-icons icon-components" style="float: right"></i>
                    <p>
                        {{__('Install')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="InstallExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{Route('install.index')}}">
                                <i class="tim-icons icon-components"></i> <span
                                        class="sidebar-normal"> {{__('Install Management')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{Route('delivery.index')}}">
                                <i class="tim-icons icon-components"></i>
                                <span class="sidebar-normal">{{__('Delivery Management')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#SupportExamples">
                    <i class="tim-icons icon-support-17" style="float: right"></i>
                    <p>
                        {{__('Support')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="SupportExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{Route('support.index')}}">
                                <i class="tim-icons icon-support-17"></i>
                                <span class="sidebar-normal"> {{__('Support List')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{Route('support_status.index')}}">
                                <i class="tim-icons icon-support-17"></i>
                                <span class="sidebar-normal"> {{__('Support Status')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#HelpDeskExamples">
                    <i class="tim-icons icon-headphones" style="float: right"></i>
                    <p>
                        {{__('Help Desk')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="HelpDeskExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('help_desk.index') }}">
                                <i class="tim-icons icon-email-85"></i>
                                <span class="sidebar-normal"> {{__('Help Desk')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('hd-receiver-user.index') }}">
                                <i class="tim-icons icon-headphones"></i>
                                <span class="sidebar-normal">
                                    {{__('Receiver User')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('hd-type-role.index') }}">
                                <i class="tim-icons icon-headphones"></i>
                                <span class="sidebar-normal">
                                    {{__('Limitations User List')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('priority.index') }}">
                                <i class="tim-icons icon-headphones"></i>
                                <span class="sidebar-normal">
                                    {{__('Ticket Priority')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('type.index') }}">
                                <i class="tim-icons icon-headphones"></i>
                                <span class="sidebar-normal">{{__('Ticket Type')}}</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a class="nav-link" href="{{ route('ticket.index') }}">
                                <i class="tim-icons icon-headphones"></i>
                                <span class="sidebar-normal">{{__('Ticket Status')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#UsersExamples">
                    <i class="tim-icons icon-user-run" style="float: right"></i>
                    <p>
                        {{__('Users')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="UsersExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal">{{__('Manage Users')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('roles.index')}}">
                                <i class="tim-icons icon-user-run"></i>
                                <span class="sidebar-normal">{{__('Manage Roles')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('verifier.index')}}">
                                <i class="tim-icons icon-check-2"></i>
                                <span class="sidebar-normal">{{__('Verifier')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('position.index')}}">
                                <i class="tim-icons icon-check-2"></i>
                                <span class="sidebar-normal">{{__('Positions User')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            {{--<li class="nav-item">--}}
            {{--<li class="nav-item">--}}
                {{--<a class="nav-link" data-toggle="collapse" href="#ConversationExamples">--}}
                    {{--<i class="tim-icons icon-chat-33" style="float: right"></i>--}}
                    {{--<p>--}}
                        {{--{{__('Conversation View')}}--}}
                        {{--<b class="caret"></b>--}}
                    {{--</p>--}}
                {{--</a>--}}
                {{--<div class="collapse " id="ConversationExamples">--}}
                    {{--<ul class="nav">--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="{{ route('conversation_view.index') }}">--}}
                                {{--<i class="tim-icons icon-chat-33"></i>--}}
                                {{--<span class="sidebar-normal"> {{__('Conversation View')}}</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                {{--</div>--}}
            {{--</li>--}}
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ClientExamples">
                    <i class="tim-icons icon-single-02" style="float: right"></i>
                    <p>
                        {{__('Client')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="ClientExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('client.index') }}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal"> {{__('Client')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#MessageExamples">
                    <i class="tim-icons icon-email-85" style="float: right"></i>
                    <p>
                        {{__('Message Managment')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="MessageExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('conversation_view.inbox') }}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal"> {{__('Inbox Message')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('send-receiver-massage-role.index') }}">
                                <i class="tim-icons icon-user-run"></i>
                                <span class="sidebar-normal"> {{__('Limited Massage')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#SettingExamples">
                    <i class="tim-icons icon-settings" style="float: right"></i>
                    <p>
                        {{__('Setting')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="SettingExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('level.index') }}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal"> {{__('HNT Level')}}</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('product-tax.index') }}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal"> {{__('TAX')}}</span>
                            </a>
                        </li>
                    </ul>
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('product.activation-create-serial-number-index') }}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal"> {{__('Create Serial Number Status')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <!-- End of Sidebar -->
        @endrole

        @role('order')
        <!-- Sidebar -->
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36" style="float: right"></i>
                    <p>{{__('Dashboard')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-toggle="collapse" href="#componentsExamples" aria-expanded="false">
                    <i class="tim-icons icon-pencil" style="float: right"></i>
                    <p>
                        {{__('Orders')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples" style="">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('order.index') }}">
                                <i class="tim-icons icon-pencil"></i>
                                <span class="sidebar-normal"> {{__('Order')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#HelpDeskExamples">
                    <i class="tim-icons icon-headphones" style="float: right"></i>
                    <p>
                        {{__('Help Desk')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="HelpDeskExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('help_desk.index') }}">
                                <i class="tim-icons icon-email-85"></i>
                                <span class="sidebar-normal"> {{__('Help Desk')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ClientExamples">
                    <i class="tim-icons icon-single-02" style="float: right"></i>
                    <p>
                        {{__('Client')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="ClientExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('client.index') }}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal"> {{__('Client')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#UsersExamples">
                    <i class="tim-icons icon-user-run" style="float: right"></i>
                    <p>
                        {{__('Users')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="UsersExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal">{{__('Manage Users')}}</span>
                            </a>
                        </li>

                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#MessageExamples">
                    <i class="tim-icons icon-email-85" style="float: right"></i>
                    <p>
                        {{__('Message Managment')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="MessageExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('conversation_view.inbox') }}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal"> {{__('Inbox Message')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            {{--<li class="nav-item">--}}
            {{--<a class="nav-link" data-toggle="collapse" href="#ConversationExamples">--}}
            {{--<i class="tim-icons icon-chat-33" style="float: right"></i>--}}
            {{--<p>--}}
            {{--{{__('Conversation View')}}--}}
            {{--<b class="caret"></b>--}}
            {{--</p>--}}
            {{--</a>--}}
            {{--<div class="collapse " id="ConversationExamples">--}}
            {{--<ul class="nav">--}}
            {{--<li class="nav-item ">--}}
            {{--<a class="nav-link" href="{{ route('conversation_view.index') }}">--}}
            {{--<i class="tim-icons icon-chat-33"></i>--}}
            {{--<span class="sidebar-normal"> {{__('Conversation View')}}</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</li>--}}
        </ul>
        <!-- End of Sidebar -->
        @endrole

        @role('finance')
        <!-- Sidebar -->
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36" style="float: right"></i>
                    <p>{{__('Dashboard')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#formsExamples">
                    <i class="tim-icons icon-paper" style="float: right"></i>
                    <p>
                        {{__('Agreement')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="formsExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('agreement.index') }}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal"
                                >{{__('Agreement Management')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#tablesExamples">
                    <i class="tim-icons icon-money-coins" style="float: right"></i>
                    <p>
                        {{__('Finance')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="tablesExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('finance.index') }}">
                                <i class="tim-icons icon-coins"></i>
                                <span class="sidebar-normal">{{__('Finance Product')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('fund.index') }}">
                                <i class="tim-icons icon-coins"></i>
                                <span class="sidebar-normal">
                                    {{__('Fund')}}
                                </span>
                            </a>
                        </li>
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="{{ route('finance.index') }}">--}}
                                {{--<i class="tim-icons icon-coins"></i>--}}
                                {{--<span class="sidebar-normal"> {{__('Debit')}}</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="{{ route('finance.index') }}">--}}
                                {{--<i class="tim-icons icon-coins"></i>--}}
                                {{--<span class="sidebar-normal"> {{__('Revenue')}}</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                        {{--<li class="nav-item ">--}}
                            {{--<a class="nav-link" href="{{ route('finance.index') }}">--}}
                                {{--<i class="tim-icons icon-coins"></i>--}}
                                {{--<span class="sidebar-normal"> {{__('Costs')}}</span>--}}
                            {{--</a>--}}
                        {{--</li>--}}
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#HelpDeskExamples">
                    <i class="tim-icons icon-headphones" style="float: right"></i>
                    <p>
                        {{__('Help Desk')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="HelpDeskExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('help_desk.index') }}">
                                <i class="tim-icons icon-email-85"></i>
                                <span class="sidebar-normal"> {{__('Help Desk')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#UsersExamples">
                    <i class="tim-icons icon-user-run" style="float: right"></i>
                    <p>
                        {{__('Users')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="UsersExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal">{{__('Manage Users')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#MessageExamples">
                    <i class="tim-icons icon-email-85" style="float: right"></i>
                    <p>
                        {{__('Message Managment')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="MessageExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('conversation_view.inbox') }}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal"> {{__('Inbox Message')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            {{--<li class="nav-item">--}}
            {{--<a class="nav-link" data-toggle="collapse" href="#ConversationExamples">--}}
            {{--<i class="tim-icons icon-chat-33" style="float: right"></i>--}}
            {{--<p>--}}
            {{--{{__('Conversation View')}}--}}
            {{--<b class="caret"></b>--}}
            {{--</p>--}}
            {{--</a>--}}
            {{--<div class="collapse " id="ConversationExamples">--}}
            {{--<ul class="nav">--}}
            {{--<li class="nav-item ">--}}
            {{--<a class="nav-link" href="{{ route('conversation_view.index') }}">--}}
            {{--<i class="tim-icons icon-chat-33"></i>--}}
            {{--<span class="sidebar-normal"> {{__('Conversation View')}}</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</li>--}}
        </ul>
        <!-- End of Sidebar -->
        @endrole

        @role('repository')
        <!-- Sidebar -->
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36" style="float: right"></i>
                    <p>{{__('Dashboard')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#RepositoryExamples">
                    <i class="tim-icons icon-bank" style="float: right"></i>
                    <p>
                        {{__('Repository')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="RepositoryExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{Route('repository.index')}}">
                                <i class="tim-icons icon-paper"></i> <span
                                        class="sidebar-normal"> {{__('Repository')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a href="{{route('repository.create')}}"
                               class="nav-link">
                                <i class="tim-icons icon-paper"></i> <span
                                        class="sidebar-normal"> {{__('Increase inventory')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('repository.index')}}">
                                <i class="tim-icons icon-bank"></i>
                                <span class="sidebar-normal">{{__('Repositories List')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#HelpDeskExamples">
                    <i class="tim-icons icon-headphones" style="float: right"></i>
                    <p>
                        {{__('Help Desk')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="HelpDeskExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('help_desk.index') }}">
                                <i class="tim-icons icon-email-85"></i>
                                <span class="sidebar-normal"> {{__('Help Desk')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#UsersExamples">
                    <i class="tim-icons icon-user-run" style="float: right"></i>
                    <p>
                        {{__('Users')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="UsersExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal">{{__('Manage Users')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#MessageExamples">
                    <i class="tim-icons icon-email-85" style="float: right"></i>
                    <p>
                        {{__('Message Managment')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="MessageExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('conversation_view.inbox') }}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal"> {{__('Inbox Message')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            {{--<li class="nav-item">--}}
            {{--<a class="nav-link" data-toggle="collapse" href="#ConversationExamples">--}}
            {{--<i class="tim-icons icon-chat-33" style="float: right"></i>--}}
            {{--<p>--}}
            {{--{{__('Conversation View')}}--}}
            {{--<b class="caret"></b>--}}
            {{--</p>--}}
            {{--</a>--}}
            {{--<div class="collapse " id="ConversationExamples">--}}
            {{--<ul class="nav">--}}
            {{--<li class="nav-item ">--}}
            {{--<a class="nav-link" href="{{ route('conversation_view.index') }}">--}}
            {{--<i class="tim-icons icon-chat-33"></i>--}}
            {{--<span class="sidebar-normal"> {{__('Conversation View')}}</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</li>--}}
        </ul>
        <!-- End of Sidebar -->
        @endrole

        @role('product')
        <!-- Sidebar -->
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36" style="float: right"></i>
                    <p>{{__('Dashboard')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link collapsed" data-toggle="collapse" href="#componentsExamples" aria-expanded="false">
                    <i class="tim-icons icon-pencil" style="float: right"></i>
                    <p>
                        {{__('Orders')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="componentsExamples" style="">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{Route('order.invoices_list_product')}}">
                                <i class="tim-icons icon-bullet-list-67"></i> <span
                                        class="sidebar-normal"> {{__('Product Invoices List')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ProductExamples">
                    <i class="tim-icons icon-app" style="float: right"></i>
                    <p>
                        {{__('Product')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="ProductExamples" style="">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{Route('product.index')}}">
                                <i class="tim-icons icon-paper" style="size: 8px"></i>
                                <span class="sidebar-normal">{{__('Products Management')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{Route('middle-part.index')}}">
                                <i class="tim-icons icon-paper" style="size: 8px"></i>
                                <span class="sidebar-normal">{{__('Middle Part')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('part.index')}}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal">{{__('Parts')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('product-part.index')}}">
                                <i class="tim-icons icon-bullet-list-67"></i>
                                <span class="sidebar-normal">{{__('Product Parts')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{Route('product-middle-part.index')}}">
                                <i class="tim-icons icon-bullet-list-67" style="size: 8px"></i>
                                <span class="sidebar-normal">{{__('Product Middle Part')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{Route('middle-section-part.index')}}">
                                <i class="tim-icons icon-bullet-list-67" style="size: 8px"></i>
                                <span class="sidebar-normal">{{__('Middle Section Part')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('product_requirement.index')}}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal"
                                >{{__('Product Requirement')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('middle-part-requirement.index')}}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal"
                                >{{__('Middle part Requirement')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('part-requirement.index')}}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal"
                                >{{__('part Requirement')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('inventory-product.index')}}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal"
                                >{{__('Inventory Product')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('product-task.index')}}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal">{{__('Product Task')}}</span>
                            </a>
                            <a class="nav-link" href="{{ route('product-task.report-list')}}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal">{{__('Product Report List')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('product-zone.index')}}">
                                <i class="tim-icons icon-chart-pie-36"></i>
                                <span class="sidebar-normal">{{__('Product Zone')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('product-status.index')}}">
                                <i class="tim-icons icon-atom"></i>
                                <span class="sidebar-normal">{{__('Product Status')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('provider.index')}}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal">{{__('Provider')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('product-color.index')}}">
                                <i class="tim-icons icon-palette"></i>
                                <span class="sidebar-normal">{{__('Product Color')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('product-property.index')}}">
                                <i class="tim-icons icon-bag-16"></i>
                                <span class="sidebar-normal">{{__('Product Property')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('product-property-items.index')}}">
                                <i class="tim-icons icon-bag-16"></i>
                                <span class="sidebar-normal">{{__('Product Property Items')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#HelpDeskExamples">
                    <i class="tim-icons icon-headphones" style="float: right"></i>
                    <p>
                        {{__('Help Desk')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="HelpDeskExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('help_desk.index') }}">
                                <i class="tim-icons icon-email-85"></i>
                                <span class="sidebar-normal"> {{__('Help Desk')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('hd-receiver-user.index') }}">
                                <i class="tim-icons icon-headphones"></i>
                                <span class="sidebar-normal">
                                    {{__('Receiver User')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('priority.index') }}">
                                <i class="tim-icons icon-headphones"></i>
                                <span class="sidebar-normal">
                                    {{__('Ticket Priority')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('type.index') }}">
                                <i class="tim-icons icon-headphones"></i>
                                <span class="sidebar-normal">{{__('Ticket Type')}}</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a class="nav-link" href="{{ route('ticket.index') }}">
                                <i class="tim-icons icon-headphones"></i>
                                <span class="sidebar-normal">{{__('Ticket Status')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#UsersExamples">
                    <i class="tim-icons icon-user-run" style="float: right"></i>
                    <p>
                        {{__('Users')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="UsersExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal">{{__('Manage Users')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#MessageExamples">
                    <i class="tim-icons icon-email-85" style="float: right"></i>
                    <p>
                        {{__('Message Managment')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="MessageExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('conversation_view.inbox') }}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal"> {{__('Inbox Message')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            {{--<li class="nav-item">--}}
            {{--<a class="nav-link" data-toggle="collapse" href="#ConversationExamples">--}}
            {{--<i class="tim-icons icon-chat-33" style="float: right"></i>--}}
            {{--<p>--}}
            {{--{{__('Conversation View')}}--}}
            {{--<b class="caret"></b>--}}
            {{--</p>--}}
            {{--</a>--}}
            {{--<div class="collapse " id="ConversationExamples">--}}
            {{--<ul class="nav">--}}
            {{--<li class="nav-item ">--}}
            {{--<a class="nav-link" href="{{ route('conversation_view.index') }}">--}}
            {{--<i class="tim-icons icon-chat-33"></i>--}}
            {{--<span class="sidebar-normal"> {{__('Conversation View')}}</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</li>--}}
        </ul>
        <!-- End of Sidebar -->
        @endrole

        @role('geust')
        <!-- Sidebar -->
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36" style="float: right"></i>
                    <p>{{__('Dashboard')}}</p>
                </a>
            </li>
            <a class="nav-link" data-toggle="collapse" href="#UsersExamples">
                <i class="tim-icons icon-user-run" style="float: right"></i>
                <p>
                    {{__('Users')}}
                    <b class="caret"></b>
                </p>
            </a>
            <div class="collapse " id="UsersExamples">
                <ul class="nav">
                    <li class="nav-item ">
                        <a class="nav-link" href="{{ route('users.index') }}">
                            <i class="tim-icons icon-paper"></i>
                            <span class="sidebar-normal">{{__('Manage Users')}}</span>
                        </a>
                    </li>
                </ul>
            </div>
            </li>
            {{--<li class="nav-item">--}}
            {{--<a class="nav-link" data-toggle="collapse" href="#ConversationExamples">--}}
            {{--<i class="tim-icons icon-chat-33" style="float: right"></i>--}}
            {{--<p>--}}
            {{--{{__('Conversation View')}}--}}
            {{--<b class="caret"></b>--}}
            {{--</p>--}}
            {{--</a>--}}
            {{--<div class="collapse " id="ConversationExamples">--}}
            {{--<ul class="nav">--}}
            {{--<li class="nav-item ">--}}
            {{--<a class="nav-link" href="{{ route('conversation_view.index') }}">--}}
            {{--<i class="tim-icons icon-chat-33"></i>--}}
            {{--<span class="sidebar-normal"> {{__('Conversation View')}}</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</li>--}}
            <li class="nav-item">
        </ul>
        <!-- End of Sidebar -->
        @endrole

        @role('qc')
        <!-- Sidebar -->
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36" style="float: right"></i>
                    <p>{{__('Dashboard')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#InstallExamples">
                    <i class="tim-icons icon-components" style="float: right"></i>
                    <p>
                        {{__('QC')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="InstallExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{Route('qc.index')}}">
                                <i class="tim-icons icon-components"></i> <span
                                        class="sidebar-normal"> {{__('QC Management')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{route('inventory-product.index')}}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal"
                                >{{__('Inventory Product')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#UsersExamples">
                    <i class="tim-icons icon-user-run" style="float: right"></i>
                    <p>
                        {{__('Users')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="UsersExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal">{{__('Manage Users')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#HelpDeskExamples">
                    <i class="tim-icons icon-headphones" style="float: right"></i>
                    <p>
                        {{__('Help Desk')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="HelpDeskExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('help_desk.index') }}">
                                <i class="tim-icons icon-email-85"></i>
                                <span class="sidebar-normal"> {{__('Help Desk')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('hd-receiver-user.index') }}">
                                <i class="tim-icons icon-headphones"></i>
                                <span class="sidebar-normal">
                                    {{__('Receiver User')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('priority.index') }}">
                                <i class="tim-icons icon-headphones"></i>
                                <span class="sidebar-normal">
                                    {{__('Ticket Priority')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('type.index') }}">
                                <i class="tim-icons icon-headphones"></i>
                                <span class="sidebar-normal">{{__('Ticket Type')}}</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a class="nav-link" href="{{ route('ticket.index') }}">
                                <i class="tim-icons icon-headphones"></i>
                                <span class="sidebar-normal">{{__('Ticket Status')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#MessageExamples">
                    <i class="tim-icons icon-email-85" style="float: right"></i>
                    <p>
                        {{__('Message Managment')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="MessageExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('conversation_view.inbox') }}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal"> {{__('Inbox Message')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            {{--<li class="nav-item">--}}
            {{--<a class="nav-link" data-toggle="collapse" href="#ConversationExamples">--}}
            {{--<i class="tim-icons icon-chat-33" style="float: right"></i>--}}
            {{--<p>--}}
            {{--{{__('Conversation View')}}--}}
            {{--<b class="caret"></b>--}}
            {{--</p>--}}
            {{--</a>--}}
            {{--<div class="collapse " id="ConversationExamples">--}}
            {{--<ul class="nav">--}}
            {{--<li class="nav-item ">--}}
            {{--<a class="nav-link" href="{{ route('conversation_view.index') }}">--}}
            {{--<i class="tim-icons icon-chat-33"></i>--}}
            {{--<span class="sidebar-normal"> {{__('Conversation View')}}</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</li>--}}
            <li class="nav-item">
        </ul>
        <!-- End of Sidebar -->
        @endrole


        @role('support')
        <!-- Sidebar -->
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36" style="float: right"></i>
                    <p>{{__('Dashboard')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#projectExamples">
                    <i class="tim-icons icon-molecule-40" style="float: right"></i>
                    <p>
                        {{__('Project')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="projectExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('projects.index') }}">
                                <i class="tim-icons icon-paper"></i> <span
                                        class="sidebar-normal">{{__('Projects Management')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('map')}}">
                                <i class="tim-icons icon-square-pin"></i>
                                <span class="sidebar-normal"
                                >{{__('Projects Map')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#SupportExamples">
                    <i class="tim-icons icon-support-17" style="float: right"></i>
                    <p>
                        {{__('Support')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="SupportExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{Route('support.index')}}">
                                <i class="tim-icons icon-support-17"></i>
                                <span class="sidebar-normal"> {{__('Support List')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{Route('support_status.index')}}">
                                <i class="tim-icons icon-support-17"></i>
                                <span class="sidebar-normal"> {{__('Support Status')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#UsersExamples">
                    <i class="tim-icons icon-user-run" style="float: right"></i>
                    <p>
                        {{__('Users')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="UsersExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal">{{__('Manage Users')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#HelpDeskExamples">
                    <i class="tim-icons icon-headphones" style="float: right"></i>
                    <p>
                        {{__('Help Desk')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="HelpDeskExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('help_desk.index') }}">
                                <i class="tim-icons icon-email-85"></i>
                                <span class="sidebar-normal"> {{__('Help Desk')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('hd-receiver-user.index') }}">
                                <i class="tim-icons icon-headphones"></i>
                                <span class="sidebar-normal">
                                    {{__('Receiver User')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('priority.index') }}">
                                <i class="tim-icons icon-headphones"></i>
                                <span class="sidebar-normal">
                                    {{__('Ticket Priority')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('type.index') }}">
                                <i class="tim-icons icon-headphones"></i>
                                <span class="sidebar-normal">{{__('Ticket Type')}}</span>
                            </a>
                        </li>
                        <li class="nav-item  ">
                            <a class="nav-link" href="{{ route('ticket.index') }}">
                                <i class="tim-icons icon-headphones"></i>
                                <span class="sidebar-normal">{{__('Ticket Status')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#MessageExamples">
                    <i class="tim-icons icon-email-85" style="float: right"></i>
                    <p>
                        {{__('Message Managment')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="MessageExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('conversation_view.inbox') }}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal"> {{__('Inbox Message')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            {{--<li class="nav-item">--}}
            {{--<a class="nav-link" data-toggle="collapse" href="#ConversationExamples">--}}
            {{--<i class="tim-icons icon-chat-33" style="float: right"></i>--}}
            {{--<p>--}}
            {{--{{__('Conversation View')}}--}}
            {{--<b class="caret"></b>--}}
            {{--</p>--}}
            {{--</a>--}}
            {{--<div class="collapse " id="ConversationExamples">--}}
            {{--<ul class="nav">--}}
            {{--<li class="nav-item ">--}}
            {{--<a class="nav-link" href="{{ route('conversation_view.index') }}">--}}
            {{--<i class="tim-icons icon-chat-33"></i>--}}
            {{--<span class="sidebar-normal"> {{__('Conversation View')}}</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</li>--}}
        </ul>
        <!-- End of Sidebar -->
        @endrole

        {{--sub_product_part--}}
        @role('task')
        <!-- Sidebar -->
        <ul class="nav">
            <li class="nav-item ">
                <a class="nav-link" href="{{ route('home') }}">
                    <i class="tim-icons icon-chart-pie-36" style="float: right"></i>
                    <p>{{__('Dashboard')}}</p>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#ProductExamples">
                    <i class="tim-icons icon-app" style="float: right"></i>
                    <p>
                        {{__('Product')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse" id="ProductExamples" style="">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('product-task.index')}}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal">{{__('Product Task')}}</span>
                            </a>
                            <a class="nav-link" href="{{ route('product-task.report-list')}}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal">{{__('Product Report List')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#HelpDeskExamples">
                    <i class="tim-icons icon-headphones" style="float: right"></i>
                    <p>
                        {{__('Help Desk')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="HelpDeskExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('help_desk.index') }}">
                                <i class="tim-icons icon-email-85"></i>
                                <span class="sidebar-normal"> {{__('Help Desk')}}</span>
                            </a>
                        </li>
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('hd-receiver-user.index') }}">
                                <i class="tim-icons icon-headphones"></i>
                                <span class="sidebar-normal">
                                    {{__('Receiver User')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#UsersExamples">
                    <i class="tim-icons icon-user-run" style="float: right"></i>
                    <p>
                        {{__('Users')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="UsersExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('users.index') }}">
                                <i class="tim-icons icon-paper"></i>
                                <span class="sidebar-normal">{{__('Manage Users')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="collapse" href="#MessageExamples">
                    <i class="tim-icons icon-email-85" style="float: right"></i>
                    <p>
                        {{__('Message Managment')}}
                        <b class="caret"></b>
                    </p>
                </a>
                <div class="collapse " id="MessageExamples">
                    <ul class="nav">
                        <li class="nav-item ">
                            <a class="nav-link" href="{{ route('conversation_view.inbox') }}">
                                <i class="tim-icons icon-single-02"></i>
                                <span class="sidebar-normal"> {{__('Inbox Message')}}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </li>
            {{--<li class="nav-item">--}}
            {{--<a class="nav-link" data-toggle="collapse" href="#ConversationExamples">--}}
            {{--<i class="tim-icons icon-chat-33" style="float: right"></i>--}}
            {{--<p>--}}
            {{--{{__('Conversation View')}}--}}
            {{--<b class="caret"></b>--}}
            {{--</p>--}}
            {{--</a>--}}
            {{--<div class="collapse " id="ConversationExamples">--}}
            {{--<ul class="nav">--}}
            {{--<li class="nav-item ">--}}
            {{--<a class="nav-link" href="{{ route('conversation_view.index') }}">--}}
            {{--<i class="tim-icons icon-chat-33"></i>--}}
            {{--<span class="sidebar-normal"> {{__('Conversation View')}}</span>--}}
            {{--</a>--}}
            {{--</li>--}}
            {{--</ul>--}}
            {{--</div>--}}
            {{--</li>--}}
        </ul>
        <!-- End of Sidebar -->
        @endrole

    </div>
</div>



