<aside class="h-screen transition-transform -translate-x-full w-80 md:translate-x-0">
    <div class="h-full overflow-y-auto">
        <ul class="space-y-4">
            <li>
                <a class="{{ request()->routeIs('profile.accountSettings') ? 'border-b-4 border-black' : '' }}" 
                    href="{{ route('profile.accountSettings') }}">
                     Account Settings
                 </a>
            </li>
            <li>
                <a class="{{ request()->routeIs('profile.changePassword') ? 'border-b-4 border-black' : '' }}" 
                    href="{{ route('profile.changePassword') }}">
                     Change password
                 </a>
            </li>
        </ul>
    </div>
</aside>