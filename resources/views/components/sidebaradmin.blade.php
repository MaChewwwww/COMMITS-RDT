<aside class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-[#7A0019] md:translate-x-0"
    aria-label="Sidenav" id="drawer-navigation">

    <div class="flex items-center px-2 py-2 border-b-2 border-red-900">
        <!-- Logo -->
        <a class="flex-none inline-block text-xl font-semibold rounded-xl focus:outline-hidden focus:opacity-80"
            href="#" aria-label="PRMS">
            <div class="flex items-center justify-start w-full">
                <!--PRMS logo-->
                <img src="{{ asset('images/prms-logo 2.jpg') }}" alt="logo" class="w-10 mr-1">
                <span class="text-2xl font-bold text-white">PRMS</span>
            </div>
        </a>
        <!-- End Logo -->

        <div class="hidden lg:block ms-2">
        </div>
    </div>

    {{-- PROFILE --}}
    <div class="flex items-center justify-start w-full px-6 py-2 mt-1">
        <div class="w-14 mr-2 border bg-white rounded-lg p-1">
            <img src="{{ asset('images/puplogo.png') }}" alt="">
        </div>
        <div class="text-white">
            <p class="font-semibold text-base">{{ auth()->user()->first_name }}</p>
            <p class="font-medium text-gray-300 text-sm">{{ auth()->user()->role }}</p>
            <p class="font-semibold text-green-500 text-xs">• online</p>
        </div>
    </div>

    <div class="overflow-y-auto px-3 pb-4 pt-2 h-full bg-[#7A0019]">
        <p class="text-sm font-semibold text-start text-gray-300 mb-2 mt-4">Menu</p>
        <ul class="flex flex-col space-y-1">
            <li>
                <x-sidebar-link :href="route('Superadmin_dashboard')" :active="request()->is('Superadmin_dashboard*') || request()->is('/')" :icon="'fas fa-chart-pie'">Dashboard</x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link :href="route('User')" :active="request()->is('User*') || request()->is('/')" :icon="'fas fa-user-injured'">User</x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link :href="'Auditlog'" :active="request()->is('Auditlog*')" :icon="'fas fa-history'">Audit log</x-sidebar-link>
            </li>
        </ul>
    </div>
   
</aside>
