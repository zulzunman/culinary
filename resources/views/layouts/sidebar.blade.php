<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a class="app-brand-link">
            <span class="app-brand-logo demo">
                <svg height="40" width="40" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg" class="me-2">
                    <style>
                        .st0 {
                            fill: #000000;
                        }
                    </style>
                    <g>
                        <path class="st0" d="M256,0C114.613,0,0,114.615,0,256s114.613,256,256,256c141.383,0,256-114.615,256-256S397.383,0,256,0z
                            M379.652,402.722v-98.774v-8.938v-3.573v-7.201V161.333c0-5.3-2.656-10.245-7.066-13.177c-4.039-2.694-9.059-3.346-13.629-1.862
                            c-0.422,0.131-0.84,0.263-1.254,0.432l-41.98,17.577c-5.051,2.11-8.648,6.681-9.524,12.083l-10.84,127.164
                            c-0.728,4.531,0.539,9.165,3.488,12.681c2.945,3.524,36.008,32.46,36.008,32.46v82.297C310.779,441.882,284.098,448,256,448
                            c-16.172,0-31.871-2.032-46.885-5.814V299.032c4.186-1.114,8.139-2.521,11.822-4.191c7.184-3.25,13.348-7.422,18.488-11.992
                            c7.727-6.875,13.176-14.562,16.832-21.803c1.828-3.634,3.211-7.164,4.191-10.584c0.496-1.707,0.883-3.396,1.16-5.104
                            c0.278-1.708,0.453-3.43,0.453-5.294c0-11.474,0-78.701,0-78.701c0-8.754-7.098-15.846-15.848-15.846s-15.84,7.092-15.84,15.846
                            c0,0,0,1.051,0,2.916c0,9.157,0,37.98,0,57.756c0,7.539-6.117,13.657-13.664,13.657c-7.543,0-13.656-6.118-13.656-13.657
                            c0-23.81,0-59.578,0-59.578c0-8.748-7.098-15.846-15.852-15.846c-8.752,0-15.848,7.098-15.848,15.846c0,0,0,1.056,0,2.912
                            c0,8.995,0,36.938,0,56.666c0,7.539-6.114,13.657-13.66,13.657c-7.543,0-13.656-6.118-13.656-13.657c0-23.791,0-60.672,0-60.672
                            c0-8.754-7.094-15.846-15.846-15.846c-8.752,0-15.85,7.092-15.85,15.846c0,0,0,1.051,0,2.916c0,13.02,0,65.742,0,75.785
                            c0.008,1.66,0.141,3.201,0.365,4.723c0.428,2.846,1.154,5.646,2.16,8.558c1.764,5.057,4.396,10.408,8.068,15.813
                            c2.758,4.043,6.105,8.092,10.121,11.926c6.014,5.736,13.563,10.974,22.664,14.732c3.023,1.251,6.226,2.312,9.574,3.201v126.154
                            C105.051,392.741,64,329.081,64,256c0-105.869,86.129-192,192-192c105.867,0,192,86.131,192,192
                            C448,314.796,421.408,367.474,379.652,402.722z" />
                    </g>
                </svg>
            </span>
            <div class="centered-text">
                <span>Lengkong</span>
                <span>Culinary</span>
                <span>Night</span>
            </div>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        @auth
            @if (auth()->user()->username == 'Admin' || auth()->user()->username == 'Super Admin')
                <!-- Dashboard Menu -->
                <li class="menu-item">
                    <ul class="">
                        <li class="menu-item">
                            <a href="{{ route('dashboard') }}" class="menu-link">
                                <i class="fa fa-home me-2"></i>
                                <div class="text-truncate">Dashboard</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('users.index') }}" class="menu-link">
                                <i class="fa fa-credit-card me-2"></i>
                                <div class="text-truncate">Approval Pembayaran</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('store-master.index') }}" class="menu-link">
                                <i class="fa fa-store me-2"></i>
                                <div class="text-truncate">Data Toko</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('payment.indexAdmin') }}" class="menu-link">
                                <i class="fa fa-store me-2"></i>
                                <div class="text-truncate">Data Pembayaran</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('event.index') }}" class="menu-link">
                                <i class="fa fa-calendar me-2"></i>
                                <div class="text-truncate">List Event</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @else
                <li class="menu-item">
                    <ul class="">
                        <li class="menu-item ">
                            <a href="{{ route('dashboard') }}" class="menu-link">
                                <i class="fa fa-home me-2"></i>
                                <div class="text-truncate">Dashboard</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('merchant.index') }}" class="menu-link">
                                <i class="fa fa-user me-2"></i>
                                <div class="text-truncate">Biodata</div>
                            </a>
                        </li>
                        <li class="menu-item">
                            <a href="{{ route('store.index') }}" class="menu-link">
                                <i class="fa fa-store me-2"></i>
                                <div class="text-truncate">Data Toko</div>
                            </a>
                        </li>
                        @if ($condition)
                            <li class="menu-item">
                                <a href="{{ route('payment.index') }}" class="menu-link">
                                    <i class="fa fa-credit-card me-2"></i>
                                    <div class="text-truncate">Pembayaran</div>
                                </a>
                            </li>
                        @endif
                        <li class="menu-item">
                            <a href="{{ route('event.index') }}" class="menu-link">
                                <i class="fa fa-calendar me-2"></i>
                                <div class="text-truncate">List Event</div>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
        @endauth
    </ul>
    <style>
        .menu-link {
            display: flex;
            align-items: center;
            padding-left: 0 !important;
            /* Remove any existing padding */
        }

        .menu-link i {
            margin-right: 10px;
            width: 20px;
            /* Ensure consistent icon positioning */
            text-align: left;
        }
    </style>
</aside>
