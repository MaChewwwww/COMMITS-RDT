<aside
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-14 transition-transform -translate-x-full bg-[#7A0019] border-r md:translate-x-0"
    aria-label="Sidenav" id="drawer-navigation">
    <div class="overflow-y-auto py-5 px-3 h-full bg-[#7A0019]">
        <form action="#" method="GET" class="mb-2 md:hidden">
            <label for="sidebar-search" class="sr-only">Search</label>
            <div class="relative">
                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                    <svg class="w-5 h-5 text-gray-500 " fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd"
                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z">
                        </path>
                    </svg>
                </div>
                <input type="text" name="search" id="sidebar-search"
                    class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-primary-500 focus:border-primary-500 "
                    placeholder="Search" />
            </div>
        </form>
        <ul class="space-y-2">
            <li>
                <a href="#"
                    class="flex items-center p-2 text-base font-medium text-gray-300 transition duration-75 rounded-lg hover:bg-gray-100 hover:text-red-900 group">
                    <i
                        class="w-6 h-6 text-gray-300 transition duration-75 fas fa-chart-pie group-hover:text-red-800"></i>
                    <span class="ml-3">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('patients') }}"
                    class="flex items-center p-2 text-base font-medium text-gray-300 transition duration-75 rounded-lg hover:bg-gray-100 hover:text-red-900 group">
                        <i class="w-6 h-6 text-white transition duration-75 fas fa-user-injured group-hover:text-red-800"></i>
                    <span class="ml-3">Patients</span>
                </a>
            </li>
            <li>
                <a href="history"
                    class="flex items-center p-2 text-base font-medium text-gray-300 transition duration-75 rounded-lg hover:bg-gray-100 hover:text-red-900 group">
                    <i class="w-6 h-6 text-white transition duration-75 fas fa-history group-hover:text-red-800"></i>
                    <span class="ml-3">History</span>
                </a>
            </li>
            <li>
                <a href="{{ route('medicine_dashboard') }}"
                    class="flex items-center p-2 text-base font-medium text-gray-300 transition duration-75 rounded-lg hover:bg-gray-100 hover:text-red-900 group">
                    <i class="w-6 h-6 text-white transition duration-75 fas fa-boxes group-hover:text-red-800"></i>
                    <span class="ml-3">Inventory</span>
                </a>
            </li>
            <li>
                <a href="{{ route('report.index') }}"
                    class="flex items-center p-2 text-base font-medium text-gray-300 transition duration-75 rounded-lg hover:bg-gray-100 hover:text-red-900 group">
                    <i class="w-6 h-6 text-white transition duration-75 fas fa-file-alt group-hover:text-red-800"></i>
                    <span class="ml-3">Reports</span>
                </a>
            </li>
            <li>
                <a href="{{ route('documents.index') }}"
                    class="flex items-center p-2 text-base font-medium text-gray-300 transition duration-75 rounded-lg hover:bg-gray-100 hover:text-red-900 group">
                    <i
                        class="w-6 h-6 text-white transition duration-75 fas fa-folder-open group-hover:text-red-800"></i>
                    <span class="ml-3">Documents</span>
                </a>
            </li>
        </ul>
</aside>
