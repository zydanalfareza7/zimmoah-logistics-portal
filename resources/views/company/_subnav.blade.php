@php
    $companyTabs = [
        ['route' => 'company.profile',      'label' => __('messages.cmp_profile')],
        ['route' => 'company.ceo',          'label' => __('messages.cmp_ceo')],
        ['route' => 'company.history',      'label' => __('messages.cmp_history')],
        ['route' => 'company.cip',          'label' => __('messages.cmp_cip')],
        ['route' => 'company.license',      'label' => __('messages.cmp_license')],
        ['route' => 'company.organization', 'label' => __('messages.cmp_organization')],
        ['route' => 'company.branches',     'label' => __('messages.cmp_branches')],
        ['route' => 'contact',              'label' => __('messages.cmp_directory')],
    ];
@endphp

<div class="bg-white border-b border-neutral-200 sticky top-[104px] z-30 shadow-xs">
    <div class="max-w-7xl mx-auto px-4 sm:px-8">
        <div class="flex items-center gap-2 overflow-x-auto py-3 no-scrollbar">
            @foreach ($companyTabs as $tab)
                @php $active = request()->routeIs($tab['route']); @endphp
                <a href="{{ route($tab['route']) }}"
                   class="whitespace-nowrap px-4 py-2 rounded-full text-xs font-black transition {{ $active ? 'bg-black text-[#FECE00] shadow-sm' : 'bg-neutral-100 text-neutral-700 hover:bg-[#FECE00] hover:text-black' }}">
                    {{ $tab['label'] }}
                </a>
            @endforeach
        </div>
    </div>
</div>
