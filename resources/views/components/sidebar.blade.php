<aside
    class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full bg-[#7A0019] md:translate-x-0"
    aria-label="Sidenav" id="drawer-navigation">

    <div class="flex items-center px-6 pt-4">
        <!-- Logo -->
        <a class="flex-none inline-block text-xl font-semibold rounded-xl focus:outline-hidden focus:opacity-80"
            href="#" aria-label="PRMS">
            <div class="flex items-center justify-start w-full">
                <!--PRMS logo-->
                <img src="{{asset('images/puplogo.png')}}" alt="logo" class="w-8 h-8 mr-2">
                <span class="text-2xl font-bold text-white">PRMS</span>
            </div>
        </a>
        <!-- End Logo -->

        <div class="hidden lg:block ms-2">
        </div>
    </div>

    {{-- PROFILE
    <div class="flex items-center justify-start w-full px-6 py-4">
        <div class="w-10 h-10 mr-2 border border-white rounded">

        </div>
        <div class="text-white">
            <p>name</p>
            <p>email</p>
        </div>
    </div> --}}

    <div class="overflow-y-auto px-3 py-4 h-full bg-[#7A0019]">
        <form action="#" method="GET" class="mb-2 md:hidden">
            <label for="sidebar-search" class="sr-only">Search</label>
            <div class="relative">
                <!-- Icon container -->
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z">
                        </path>
                    </svg>
                </div>
                <input type="text" name="search" id="sidebar-search"
                    class="block w-full p-2 pl-10 pr-3 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500"
                    placeholder="Search" />
            </div>
        </form>

        <ul class="flex flex-col space-y-1">
            <li>
                <x-sidebar-link :href="route('dashboard')" :active="request()->is('dashboard*') || request()->is('/')" :icon="'fas fa-chart-pie'">Dashboard</x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link :href="route('patients')" :active="request()->is('patients*') || request()->is('/')" :icon="'fas fa-user-injured'">Patients</x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link :href="'history'" :active="request()->is('history*')" :icon="'fas fa-history'">History</x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link :href="route('inventory')" :active="request()->is('inventory*')" :icon="'fas fa-boxes'">Inventory</x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link :href="route('report.index')" :active="request()->is('report*')" :icon="'fas fa-file-alt'">Reports</x-sidebar-link>
            </li>
            <li>
                <x-sidebar-link :href="route('documents.index')" :active="request()->is('documents*')" :icon="'fas fa-folder-open'">Documents</x-sidebar-link>
            </li>
        </ul>
</aside>
