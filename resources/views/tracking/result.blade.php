@extends('layouts.app')

@section('content')
@php
    use App\Enums\ShipmentStage;
    $orderedStages = ShipmentStage::ordered();
@endphp

<!-- Tracking Header & Search Bar (Signature Zimmoah Yellow) -->
<div class="bg-[#FECE00] text-black py-12 px-4 sm:px-8 border-b-2 border-black/15">
    <div class="max-w-5xl mx-auto space-y-5">
        <div class="space-y-2">
            <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
                {{ __('messages.tracking_badge') }}
            </span>
            <h1 class="text-2xl sm:text-4xl font-black tracking-tight text-black">
                {{ __('messages.tracking_heading') }}@if($query): <span class="bg-black text-[#FECE00] px-2.5 py-0.5 rounded-xl font-mono text-xl sm:text-3xl">{{ $query }}</span>@endif
            </h1>
        </div>

        <!-- Inline Re-Search Form -->
        <form action="{{ route('tracking') }}" method="GET" class="flex flex-col sm:flex-row gap-3 max-w-3xl">
            <input type="text" name="tracking_number" value="{{ $query }}"
                placeholder="{{ __('messages.track_input_placeholder') }}"
                class="flex-1 px-4 py-3.5 rounded-2xl bg-white border-2 border-black/20 text-black placeholder-neutral-500 text-sm font-bold focus:outline-none focus:border-black transition shadow-sm">
            <button type="submit" class="bg-black hover:bg-neutral-800 text-[#FECE00] font-black text-sm px-7 py-3.5 rounded-2xl shadow-lg transition whitespace-nowrap">
                {{ __('messages.track_button') }}
            </button>
        </form>

        <!-- Quick Sample Chips -->
        @if (!empty($sampleShipments) && $sampleShipments->count() > 0)
        <div class="flex flex-wrap items-center gap-2 text-xs pt-1">
            <span class="text-neutral-900 font-extrabold">{{ __('messages.try_sample_tracking') }}</span>
            @foreach ($sampleShipments as $sample)
                <a href="{{ route('tracking', ['tracking_number' => $sample->tracking_number]) }}"
                    class="px-3 py-1 rounded-full border-2 transition font-mono font-bold {{ strtoupper($query) === strtoupper($sample->tracking_number) ? 'bg-black text-[#FECE00] border-black' : 'bg-white text-black border-black/20 hover:border-black' }}">
                    {{ $sample->tracking_number }}
                    <span class="font-sans font-semibold opacity-75">({{ $sample->transport_mode }})</span>
                </a>
            @endforeach
        </div>
        @endif
    </div>
</div>

<div class="max-w-5xl mx-auto px-4 sm:px-8 py-12 space-y-8">
    @if ($shipment)
    <!-- 1. SHIPMENT OVERVIEW CARD + MAERSK-STYLE 5-STEP MILESTONE PROGRESS BAR -->
    <div class="bg-white rounded-3xl border border-slate-200 shadow-xl overflow-hidden">
        <!-- Top Bar -->
        <div class="p-6 sm:p-8 border-b border-slate-100 flex flex-col sm:flex-row sm:items-center justify-between gap-4 bg-slate-50/70">
            <div>
                <div class="flex items-center gap-2.5 flex-wrap">
                    <span class="px-2.5 py-1 rounded-lg bg-black text-[#FECE00] text-[11px] font-black tracking-wider uppercase">
                        {{ $shipment->transport_mode }} FREIGHT
                    </span>
                    <span class="text-xs font-mono font-bold text-slate-500">
                        {{ $shipment->container_or_awb }}
                    </span>
                    @if ($shipment->container_size)
                        <span class="text-xs font-semibold text-slate-500">&bull; {{ $shipment->container_size }}</span>
                    @endif
                </div>
                <h2 class="text-2xl font-black text-slate-950 mt-2 font-mono">{{ $shipment->tracking_number }}</h2>
                <p class="text-xs text-slate-600 mt-0.5 font-semibold">{{ $shipment->vessel_or_flight }}</p>
            </div>
            <div class="flex flex-col sm:items-end gap-1.5">
                <span class="inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-black border {{ $shipment->current_stage->badgeClass() }}">
                    <span class="w-2 h-2 rounded-full bg-current"></span>
                    {{ $shipment->current_stage->label() }}
                </span>
                <span class="text-xs text-slate-500 font-semibold">
                    Step {{ $shipment->current_stage->stepNumber() }} / 5 ({{ $shipment->progressPercent() }}%)
                </span>
            </div>
        </div>

        <!-- 5-Step Maersk-Style Milestone Progress Bar -->
        <div class="p-6 sm:p-8 border-b border-slate-100">
            <div class="flex items-center justify-between mb-6">
                <span class="text-xs font-black text-slate-500 uppercase tracking-wider">
                    {{ __('messages.shipment_progress') }}
                </span>
                <span class="text-xs font-black text-amber-700">{{ $shipment->progressPercent() }}%</span>
            </div>

            <!-- Horizontal Track (Desktop) / Stacked (Mobile) -->
            <div class="relative">
                <!-- Background Rail (Desktop) -->
                <div class="hidden md:block absolute top-5 left-6 right-6 h-1.5 bg-slate-200 rounded-full overflow-hidden">
                    <div class="h-full bg-[#FECE00] transition-all duration-700 rounded-full" style="width: {{ $shipment->progressPercent() }}%;"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-5 gap-4 relative z-10">
                    @foreach ($orderedStages as $stage)
                        @php
                            $currentStep = $shipment->current_stage->stepNumber();
                            $stepNum = $stage->stepNumber();
                            $isCompleted = $stepNum < $currentStep || ($stepNum === 5 && $currentStep === 5);
                            $isCurrent = $stepNum === $currentStep && $stepNum < 5;
                        @endphp
                        <div class="flex md:flex-col items-center md:text-center gap-3.5 md:gap-2.5 p-3 md:p-0 rounded-2xl {{ $isCurrent ? 'bg-amber-50/70 md:bg-transparent border border-[#FECE00]/60 md:border-0' : '' }}">
                            <!-- Step Circle -->
                            @if ($isCompleted)
                                <div class="w-10 h-10 rounded-full bg-emerald-500 text-white flex items-center justify-center shadow-md flex-shrink-0 ring-4 ring-white">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                                </div>
                            @elseif ($isCurrent)
                                <div class="w-10 h-10 rounded-full bg-[#FECE00] text-slate-950 font-black text-sm flex items-center justify-center shadow-lg flex-shrink-0 ring-4 ring-amber-200 animate-pulse">
                                    {{ $stepNum }}
                                </div>
                            @else
                                <div class="w-10 h-10 rounded-full bg-slate-100 text-slate-400 border-2 border-slate-200 font-bold text-sm flex items-center justify-center flex-shrink-0 ring-4 ring-white">
                                    {{ $stepNum }}
                                </div>
                            @endif

                            <!-- Step Label -->
                            <div>
                                <span class="block text-xs font-black {{ $isCompleted ? 'text-emerald-700' : ($isCurrent ? 'text-slate-950' : 'text-slate-400') }}">
                                    {{ $stage->label() }}
                                </span>
                                @if ($isCurrent)
                                    <span class="inline-block text-[10px] font-extrabold uppercase tracking-wider text-amber-800 bg-[#FECE00]/40 px-2 py-0.5 rounded-full mt-1">
                                        Current
                                    </span>
                                @elseif ($isCompleted)
                                    <span class="block text-[10px] font-bold text-emerald-600 mt-0.5">Completed</span>
                                @else
                                    <span class="block text-[10px] font-medium text-slate-400 mt-0.5">Pending</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Shipment Details Grid -->
        <div class="p-6 sm:p-8 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 text-xs">
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                <span class="text-slate-400 font-bold uppercase tracking-wider text-[10px] block mb-1">{{ __('messages.origin_port') }}</span>
                <strong class="text-slate-900 text-sm block">{{ $shipment->origin_port }}</strong>
                @if ($shipment->departed_at)
                    <span class="text-slate-500 block mt-1">{{ __('messages.departed_at') }}: {{ $shipment->departed_at->format('d M Y, H:i') }}</span>
                @endif
            </div>
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                <span class="text-slate-400 font-bold uppercase tracking-wider text-[10px] block mb-1">{{ __('messages.destination_port') }}</span>
                <strong class="text-slate-900 text-sm block">{{ $shipment->destination_port }}</strong>
                @if ($shipment->estimated_arrival)
                    <span class="text-amber-700 font-bold block mt-1">{{ __('messages.estimated_arrival') }}: {{ $shipment->estimated_arrival->format('d M Y, H:i') }}</span>
                @endif
            </div>
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                <span class="text-slate-400 font-bold uppercase tracking-wider text-[10px] block mb-1">{{ __('messages.cargo_weight') }}</span>
                <strong class="text-slate-900 text-sm block">{{ $shipment->cargo_description }}</strong>
                <span class="text-slate-500 block mt-1">{{ number_format((float) $shipment->weight_kg, 1) }} kg</span>
            </div>
            <div class="p-4 rounded-2xl bg-slate-50 border border-slate-100">
                <span class="text-slate-400 font-bold uppercase tracking-wider text-[10px] block mb-1">{{ __('messages.shipper_consignee') }}</span>
                <strong class="text-slate-900 text-xs block">{{ $shipment->shipper_name }}</strong>
                <span class="text-amber-700 font-bold block mt-1">&rarr; {{ $shipment->consignee_name }}</span>
            </div>
        </div>
    </div>

    <!-- 2. CHRONOLOGICAL MILESTONE LOG -->
    @if (!empty($shipment->milestones))
    <div class="bg-white rounded-3xl p-6 sm:p-8 border border-slate-200 shadow-lg">
        <h3 class="text-base font-black text-slate-950 mb-6 flex items-center gap-2">
            <span class="w-2.5 h-2.5 rounded-full bg-[#FECE00]"></span>
            {{ __('messages.milestone_history') }}
        </h3>

        <div class="relative border-l-2 border-slate-200 ml-3 space-y-6">
            @foreach (array_reverse($shipment->milestones) as $index => $event)
                <div class="relative pl-7">
                    <span class="absolute -left-[9px] top-1 w-4 h-4 rounded-full border-2 border-white shadow {{ $index === 0 ? 'bg-[#FECE00] ring-4 ring-amber-100' : 'bg-emerald-500' }}"></span>
                    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-1">
                        <h4 class="text-sm font-black text-slate-900">{{ $event['title'] ?? '-' }}</h4>
                        <span class="text-xs font-mono font-bold text-slate-500 bg-slate-100 px-2.5 py-0.5 rounded-full w-fit">
                            {{ $event['timestamp'] ?? '' }}
                        </span>
                    </div>
                    <p class="text-xs font-bold text-amber-700 mt-0.5">{{ $event['location'] ?? '' }}</p>
                    @if (!empty($event['notes']))
                        <p class="text-xs text-slate-600 mt-1.5 leading-relaxed">{{ $event['notes'] }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    @endif

    @elseif ($schedule)
    <!-- Schedule / Vessel match fallback -->
    <div class="bg-white rounded-3xl p-8 border border-slate-200 shadow-lg space-y-6">
        <div class="flex items-center justify-between border-b border-slate-100 pb-4">
            <div>
                <span class="text-xs uppercase tracking-wider font-black text-amber-700">Voyage Terjadwal</span>
                <h2 class="text-xl font-bold text-slate-900 mt-0.5">{{ $schedule->carrier_vessel_name }} ({{ $schedule->voyage_number }})</h2>
            </div>
            <span class="px-3 py-1 rounded-full text-xs font-black bg-emerald-100 text-emerald-800 border border-emerald-300">
                {{ $schedule->status }}
            </span>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-3 gap-6 text-xs">
            <div>
                <span class="text-slate-400 font-bold block mb-1">Rute:</span>
                <strong class="text-slate-900 text-sm block">{{ $schedule->origin_port }}</strong>
                <span class="text-amber-600 font-bold">&darr; {{ $schedule->destination_port }}</span>
            </div>
            <div>
                <span class="text-slate-400 font-bold block mb-1">{{ __('messages.departed_at') }}:</span>
                <strong class="text-slate-900 text-sm block">{{ $schedule->departure_time->format('d M Y, H:i') }} WIB</strong>
            </div>
            <div>
                <span class="text-slate-400 font-bold block mb-1">{{ __('messages.estimated_arrival') }}:</span>
                <strong class="text-slate-900 text-sm block">{{ $schedule->arrival_time->format('d M Y, H:i') }}</strong>
                <span class="text-slate-500 block text-[11px] mt-0.5">{{ $schedule->duration }}</span>
            </div>
        </div>
    </div>

    @else
    <!-- Empty / Not Found State -->
    <div class="bg-white rounded-3xl p-10 text-center border border-slate-200 shadow-md space-y-4">
        <div class="w-16 h-16 bg-amber-50 text-amber-600 rounded-full flex items-center justify-center mx-auto border border-[#FECE00]/50">
            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
        </div>
        <h2 class="text-xl font-black text-slate-900">
            {{ $query ? __('messages.tracking_not_found_title') : __('messages.tracking_badge') }}
        </h2>
        <p class="text-xs text-slate-500 max-w-md mx-auto">
            @if ($query)
                <strong class="text-slate-800 font-mono">{{ $query }}</strong> &mdash; {{ __('messages.tracking_not_found_desc') }}
            @else
                {{ __('messages.track_helper') }}
            @endif
        </p>
        <div class="pt-2 flex flex-wrap justify-center gap-3">
            <a href="{{ route('home') }}" class="bg-[#FECE00] hover:bg-[#E5B800] text-slate-950 font-black text-xs px-6 py-2.5 rounded-full transition shadow-sm">
                {{ __('messages.search_back_home') }}
            </a>
            <a href="{{ route('tickets.create') }}" class="bg-slate-100 hover:bg-slate-200 text-slate-800 font-bold text-xs px-6 py-2.5 rounded-full transition">
                {{ __('messages.ask_support_team') }} &rarr;
            </a>
        </div>
    </div>
    @endif
</div>
@endsection
