@extends('layouts.app')

@section('content')
@php $locale = app()->getLocale(); @endphp

<div class="relative bg-[#FECE00] text-black py-16 px-4 sm:px-8 border-b-2 border-black/15 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('zimmoah-assets/images/banner/banner-organization.jpg') }}" alt="Contact Zimmoah"
             class="w-full h-full object-cover object-center grayscale opacity-20 mix-blend-multiply">
        <div class="absolute inset-0 bg-gradient-to-r from-[#FECE00] via-[#FECE00]/90 to-[#FECE00]/55"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto space-y-4">
        <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
            Hubungi Kami &bull; Contact Us
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-black">
            @if ($locale === 'ko') 지점 연락처 및 담당부서 안내 @elseif ($locale === 'en') Office Locations &amp; Staff Contact Directory @else Kontak Kantor &amp; Direktori Departemen @endif
        </h1>
        <p class="text-neutral-900 font-medium max-w-2xl text-sm sm:text-base leading-relaxed">
            Tim representatif dan PIC departemen Zimmoah siap melayani pengiriman Sea/Air Export-Import, Customer Service, Accounting, Cabang, hingga Afiliasi.
        </p>
    </div>
</div>

@include('company._subnav')

<div class="max-w-7xl mx-auto px-4 sm:px-8 py-14 space-y-14">
    <!-- 3 Primary Office Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        @foreach ($offices as $office)
        <div class="bg-white rounded-3xl border-2 border-neutral-200 hover:border-[#FECE00] p-8 shadow-sm hover:shadow-xl transition flex flex-col justify-between space-y-6">
            <div class="space-y-4">
                <span class="inline-block text-xs font-black px-3 py-1 rounded-full {{ $office->is_headquarters ? 'bg-[#FECE00] text-black' : 'bg-neutral-100 text-neutral-800' }}">
                    {{ $office->code }} {{ $office->is_headquarters ? '(Pusat)' : '' }}
                </span>
                <h2 class="text-xl font-black text-black">{{ $office->name }}</h2>
                <p class="text-xs text-neutral-600 leading-relaxed">{{ $office->address }}</p>

                <div class="pt-4 border-t border-neutral-100 text-xs space-y-2 text-neutral-800">
                    <p><strong>Telepon:</strong> {{ $office->phone }}</p>
                    @if ($office->fax)
                        <p><strong>Fax:</strong> {{ $office->fax }}</p>
                    @endif
                    <p><strong>Email:</strong> <a href="mailto:{{ $office->email }}" class="text-black font-black underline decoration-[#FECE00] decoration-2">{{ $office->email }}</a></p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <a href="{{ route('tickets.create') }}" class="flex-1 text-center block bg-black hover:bg-[#FECE00] text-[#FECE00] hover:text-black font-black text-xs py-3 rounded-xl transition shadow-md">
                    Buka Tiket Bantuan &rarr;
                </a>
                <a href="{{ route('company.branches') }}" class="px-3.5 py-3 rounded-xl border border-neutral-200 hover:border-black text-xs font-black text-black transition" title="Lihat Peta">
                    Map
                </a>
            </div>
        </div>
        @endforeach
    </div>

    <!-- Complete Official Staff & Department Directory from zimmoah.com/contactus.php -->
    <div class="bg-white rounded-3xl border-2 border-neutral-200 shadow-sm overflow-hidden">
        <div class="p-6 sm:p-8 bg-[#FFFBE6] border-b border-neutral-200 flex flex-col lg:flex-row lg:items-center justify-between gap-4">
            <div>
                <span class="inline-block text-[10px] font-black uppercase bg-black text-[#FECE00] px-3 py-1 rounded-full mb-2">
                    Official Zimmoah Directory
                </span>
                <h2 class="text-2xl font-black text-black">
                    @if ($locale === 'ko') 담당부서 및 직원 직통 연락처 @elseif ($locale === 'en') Department &amp; PIC Direct Contact Directory @else Direktori Kontak PIC &amp; Departemen Resmi @endif
                </h2>
                <p class="text-xs text-neutral-600 mt-1">Head Office (Jakarta), Branch Offices (Airport, Semarang, Surabaya, Ho Chi Minh), &amp; Affiliates (SKL, LNL, RLC, Cargobus).</p>
            </div>

            <div class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                <input type="text" id="directorySearch" oninput="filterDirectory()"
                       placeholder="Cari nama, departemen, email..."
                       class="px-4 py-2.5 bg-white border-2 border-neutral-300 rounded-xl text-xs font-semibold text-black focus:outline-none focus:border-black w-full sm:w-64">
                <div class="flex items-center gap-1.5 bg-white p-1 rounded-xl border border-neutral-200">
                    <button type="button" onclick="filterDirGroup('all')" data-group="all" class="dir-tab px-3 py-1.5 rounded-lg text-xs font-black bg-black text-[#FECE00]">All</button>
                    <button type="button" onclick="filterDirGroup('head_office')" data-group="head_office" class="dir-tab px-3 py-1.5 rounded-lg text-xs font-bold text-neutral-600 hover:text-black">Head Office</button>
                    <button type="button" onclick="filterDirGroup('branches')" data-group="branches" class="dir-tab px-3 py-1.5 rounded-lg text-xs font-bold text-neutral-600 hover:text-black">Branches</button>
                    <button type="button" onclick="filterDirGroup('affiliates')" data-group="affiliates" class="dir-tab px-3 py-1.5 rounded-lg text-xs font-bold text-neutral-600 hover:text-black">Affiliates</button>
                </div>
            </div>
        </div>

        <div class="p-6 sm:p-8 space-y-10">
            @foreach ($directory as $groupKey => $group)
                <div class="dir-section space-y-4" data-section="{{ $groupKey }}">
                    <div class="flex items-center gap-3">
                        <span class="w-2.5 h-6 rounded-full bg-[#FECE00] border border-black/20"></span>
                        <h3 class="text-lg font-black text-black">{{ $group['title'] }}</h3>
                    </div>

                    <div class="overflow-x-auto rounded-2xl border border-neutral-200">
                        <table class="w-full text-left text-xs">
                            <thead class="bg-black text-[#FECE00] uppercase tracking-wider font-black">
                                <tr>
                                    <th class="px-5 py-3.5">Department / Unit</th>
                                    <th class="px-5 py-3.5">Name</th>
                                    <th class="px-5 py-3.5">Position</th>
                                    <th class="px-5 py-3.5">Email</th>
                                    <th class="px-5 py-3.5">Tel (Direct)</th>
                                    <th class="px-5 py-3.5">Mobile</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-neutral-100 text-neutral-800">
                                @foreach ($group['departments'] as $deptName => $members)
                                    @foreach ($members as $member)
                                        <tr class="dir-row hover:bg-[#FFFBE6] transition"
                                            data-search="{{ strtolower($group['title'] . ' ' . $deptName . ' ' . $member['name'] . ' ' . $member['position'] . ' ' . $member['email'] . ' ' . $member['tel']) }}">
                                            <td class="px-5 py-3.5 font-black text-black">
                                                <span class="inline-block bg-neutral-100 border border-neutral-200 px-2.5 py-0.5 rounded-md">{{ $deptName }}</span>
                                            </td>
                                            <td class="px-5 py-3.5 font-bold text-black">{{ $member['name'] }}</td>
                                            <td class="px-5 py-3.5 text-neutral-600">{{ $member['position'] }}</td>
                                            <td class="px-5 py-3.5">
                                                <a href="mailto:{{ $member['email'] }}" class="font-bold text-black underline decoration-[#FECE00] decoration-2 hover:opacity-75">
                                                    {{ $member['email'] }}
                                                </a>
                                            </td>
                                            <td class="px-5 py-3.5 font-mono text-[11px]">{{ $member['tel'] }}</td>
                                            <td class="px-5 py-3.5 font-mono text-[11px]">{{ $member['mobile'] }}</td>
                                        </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<script>
    let currentDirGroup = 'all';

    function filterDirGroup(group) {
        currentDirGroup = group;
        document.querySelectorAll('.dir-tab').forEach(btn => {
            if (btn.dataset.group === group) {
                btn.className = 'dir-tab px-3 py-1.5 rounded-lg text-xs font-black bg-black text-[#FECE00]';
            } else {
                btn.className = 'dir-tab px-3 py-1.5 rounded-lg text-xs font-bold text-neutral-600 hover:text-black';
            }
        });
        filterDirectory();
    }

    function filterDirectory() {
        const q = (document.getElementById('directorySearch')?.value || '').trim().toLowerCase();
        document.querySelectorAll('.dir-section').forEach(section => {
            const matchesGroup = (currentDirGroup === 'all' || section.dataset.section === currentDirGroup);
            let visibleCount = 0;
            section.querySelectorAll('.dir-row').forEach(row => {
                const matchText = !q || row.dataset.search.includes(q);
                if (matchesGroup && matchText) {
                    row.classList.remove('hidden');
                    visibleCount++;
                } else {
                    row.classList.add('hidden');
                }
            });
            section.classList.toggle('hidden', visibleCount === 0);
        });
    }
</script>
@endsection
