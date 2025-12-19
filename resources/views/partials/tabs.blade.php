<div class="flex gap-4 mb-8">

    <a href="{{ route('find.daily') }}"
       class="px-6 py-3 rounded-xl font-medium transition
       {{ request()->routeIs('find.daily') ? 'bg-emerald-600 text-white' : 'bg-gray-100 hover:bg-gray-200' }}">
        Daily
    </a>

    <a href="{{ route('find.event') }}"
       class="px-6 py-3 rounded-xl font-medium transition
       {{ request()->routeIs('find.event') ? 'bg-emerald-600 text-white' : 'bg-gray-100 hover:bg-gray-200' }}">
        Event
    </a>

    <a href="{{ route('find.trend') }}"
       class="px-6 py-3 rounded-xl font-medium transition
       {{ request()->routeIs('find.trend') ? 'bg-emerald-600 text-white' : 'bg-gray-100 hover:bg-gray-200' }}">
        Trend
    </a>

</div>
