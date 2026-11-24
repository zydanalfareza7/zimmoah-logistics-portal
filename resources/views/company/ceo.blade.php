@extends('layouts.app')

@section('content')
@php $locale = app()->getLocale(); @endphp

<!-- Hero -->
<div class="relative bg-[#FECE00] text-black py-16 px-4 sm:px-8 border-b-2 border-black/15 overflow-hidden">
    <div class="absolute inset-0 z-0">
        <img src="{{ asset('zimmoah-assets/images/banner/banner-ceo.jpg') }}" alt="CEO Message"
             class="w-full h-full object-cover object-center grayscale opacity-20 mix-blend-multiply">
        <div class="absolute inset-0 bg-gradient-to-r from-[#FECE00] via-[#FECE00]/90 to-[#FECE00]/55"></div>
    </div>
    <div class="relative z-10 max-w-7xl mx-auto space-y-4">
        <span class="inline-block text-xs uppercase tracking-widest font-black text-[#FECE00] bg-black px-3.5 py-1 rounded-full">
            PT. Zimmoah Marine Trans &bull; Est. 1989
        </span>
        <h1 class="text-3xl sm:text-5xl font-black tracking-tight text-black">
            @if ($locale === 'ko') CEO 인사말 @elseif ($locale === 'en') CEO Message @else Sambutan CEO @endif
        </h1>
        <p class="text-neutral-900 font-medium max-w-2xl text-sm sm:text-base leading-relaxed">
            @if ($locale === 'ko')
                인도네시아 진출 30여 년의 역사와 글로벌 네트워크로 고객 가치를 창출하는 물류 선도기업 짐모아입니다.
            @elseif ($locale === 'en')
                Over 30 years of logistics excellence in Indonesia — connecting our customers with global supply chain networks since 1989.
            @else
                Lebih dari 30 tahun pengalaman logistik profesional di Indonesia sejak 1989, menghubungkan mitra dan pelanggan ke seluruh dunia.
            @endif
        </p>
    </div>
</div>

@include('company._subnav')

<div class="max-w-6xl mx-auto px-4 sm:px-8 py-14 space-y-10">
    <div class="bg-white rounded-3xl border-2 border-neutral-200 shadow-sm overflow-hidden">
        <div class="grid grid-cols-1 lg:grid-cols-12">
            <!-- Left Portrait Column -->
            <div class="lg:col-span-4 bg-[#FFFBE6] p-8 sm:p-10 border-b lg:border-b-0 lg:border-r border-[#FECE00]/60 flex flex-col items-center justify-between text-center space-y-6">
                <div class="space-y-4 w-full">
                    <div class="w-48 h-56 mx-auto rounded-2xl overflow-hidden border-4 border-white shadow-lg bg-neutral-100">
                        <img src="{{ asset('zimmoah-assets/images/ceo/ceo.jpg') }}" alt="Jason Lee - CEO Zimmoah Marine Trans"
                             class="w-full h-full object-cover">
                    </div>
                    <div>
                        <span class="inline-block text-[10px] uppercase tracking-widest font-black bg-black text-[#FECE00] px-3 py-1 rounded-full">
                            President Director &amp; CEO
                        </span>
                        <h2 class="text-2xl font-black text-black mt-2">
                            @if ($locale === 'ko') 이 지 현 (Jason Lee) @else Jason Lee @endif
                        </h2>
                        <p class="text-xs font-bold text-neutral-600 mt-0.5">
                            @if ($locale === 'ko') 짐모아 마린 트란스 @else PT. Zimmoah Marine Trans @endif
                        </p>
                    </div>
                </div>

                <!-- 3 Corporate Mottos -->
                <div class="w-full space-y-2.5 text-left pt-4 border-t border-[#FECE00]/60">
                    <p class="text-[10px] font-black uppercase tracking-widest text-neutral-500">
                        @if ($locale === 'ko') 짐모아 사훈 @elseif ($locale === 'en') Zimmoah Mottos @else Semboyan Zimmoah @endif
                    </p>
                    <div class="bg-white rounded-xl p-3 border border-neutral-200 text-xs font-bold text-black">
                        1. @if ($locale === 'ko') 목적이 확고한 물류 기업 @elseif ($locale === 'en') A logistics company with valid objectives @else Perusahaan logistik dengan tujuan yang kokoh @endif
                    </div>
                    <div class="bg-white rounded-xl p-3 border border-neutral-200 text-xs font-bold text-black">
                        2. @if ($locale === 'ko') 열정이 살아있는 역동적인 물류 기업 @elseif ($locale === 'en') A passionate and dynamic logistics company @else Perusahaan logistik yang penuh semangat &amp; dinamis @endif
                    </div>
                    <div class="bg-white rounded-xl p-3 border border-neutral-200 text-xs font-bold text-black">
                        3. @if ($locale === 'ko') 끈기있고 책임지는 물류 기업 @elseif ($locale === 'en') A responsible and tenacious logistics company @else Perusahaan logistik yang gigih &amp; bertanggung jawab @endif
                    </div>
                </div>
            </div>

            <!-- Right Letter Content -->
            <div class="lg:col-span-8 p-8 sm:p-12 space-y-6 text-sm sm:text-base text-neutral-700 leading-relaxed">
                @if ($locale === 'ko')
                    <p class="font-bold text-black text-lg">
                        짐모아 홈페이지를 찾아 주신 고객 및 전 세계 파트너 여러분께 먼저 진심으로 감사 인사를 올립니다.
                    </p>
                    <p>
                        저희는 인도네시아 진출 30년을 바라보고 있는 물류 전문기업입니다. 30여년의 기간동안 짐모아는 전 세계 글로벌 물류 파트너사와의 협력으로 강력한 Network을 갖추고 다양한 산업별 고객에게 맞춤형 서비스를 제공하는 물류 선도 기업으로 성장 하였습니다.
                    </p>
                    <p>
                        안정된 해상 운송과 특화된 항공 서비스, 축적된 경험의 TPL 서비스, 신뢰성 있는 항공/해상 소량화물 Consolidation, Project 화물 그리고 최적화 된 자체 운송사와 선진화된 시스템의 보세장치 / 일반 전문 창고 보유 등, 짐모아는 고객의 니즈에 가장 필요한 물류 운영시스템을 구축, 운영하고 있습니다.
                    </p>
                    <p>
                        이에 저희는 고객의 신뢰와 사랑에 보답하고자 보다 나은 고객가치를 창출해 내고 그 가치를 함께 공유하고 지속될 수 있도록 하겠으며, 또한 고객과 함께 만들어 온 최고의 물류 선도기업이라는 그 명성을 지키고자 임직원 모두 최선의 노력을 다하도록 하겠습니다.
                    </p>
                    <p>
                        '목적이 확고한 물류 기업', '열정이 살아있는 역동적인 물류기업', '끈기있고 책임지는 물류 기업' 이라는 짐모아 사훈과 새롭게 리뉴얼된 CI로 고객 여러분과 함께 힘차게 뛰어나가도록 하겠습니다.
                    </p>
                    <p class="font-bold text-black">감사합니다.</p>
                @elseif ($locale === 'en')
                    <p class="font-bold text-black text-lg">
                        Dear valued customers and partners around the world,
                    </p>
                    <p>
                        Welcome, and thank you for visiting our Zimmoah webpage. We are a professional logistics company based in Indonesia since 1989. Over the course of 30 years, we have grown as a leading logistics company, providing diverse and specialized services to our customers through our strong global networks and logistics partnerships.
                    </p>
                    <p>
                        Zimmoah operates logistics management systems that strive to meet our clients' needs through stable marine transportation, specialized air freight services, well-established TPL service, reliable air/marine small cargo consolidation, project cargo, optimized self-transportation, advanced bonded installations, and possession of secure warehouses.
                    </p>
                    <p>
                        In return for our customers' love and trust, we aspire to increase customer value and ensure the continuation and distribution of value production. Our executives and employees will continue to give their best efforts to uphold our reputation as the leading logistics company — the company we have built together with our customers and partners.
                    </p>
                    <p>
                        'A logistics company with valid objectives', 'a passionate and dynamic logistics company', and 'a responsible and tenacious logistics company' are Zimmoah's mottos. With this vision and our renewed CI, we wish to move forward once again with our customers and partners.
                    </p>
                    <p>
                        Thank you for taking your time to learn more about Zimmoah's work.
                    </p>
                    <p class="font-bold text-black">Sincerely,</p>
                @else
                    <p class="font-bold text-black text-lg">
                        Kepada seluruh pelanggan dan mitra bisnis yang terhormat di seluruh dunia,
                    </p>
                    <p>
                        Selamat datang dan terima kasih telah mengunjungi portal resmi Zimmoah. Kami adalah perusahaan logistik profesional yang berdiri dan berbasis di Indonesia sejak tahun 1989. Selama lebih dari 30 tahun, Zimmoah telah berkembang menjadi perusahaan logistik terkemuka yang menghadirkan layanan beragam dan terspesialisasi melalui jaringan global serta kemitraan logistik yang kuat.
                    </p>
                    <p>
                        Zimmoah mengoperasikan sistem manajemen logistik menyeluruh untuk memenuhi kebutuhan klien melalui transportasi laut yang stabil, layanan kargo udara khusus, layanan TPL (Third-Party Logistics) berpengalaman, konsolidasi kargo kecil (LCL) udara &amp; laut yang andal, penanganan kargo proyek, armada transportasi mandiri yang optimal, fasilitas gudang berikat (bonded warehouse) modern, serta pergudangan profesional yang aman.
                    </p>
                    <p>
                        Sebagai wujud apresiasi atas kepercayaan pelanggan, kami senantiasa berupaya meningkatkan nilai layanan secara berkelanjutan. Seluruh jajaran manajemen dan karyawan berkomitmen memberikan usaha terbaik untuk menjaga reputasi sebagai mitra logistik pilihan utama yang telah kita bangun bersama.
                    </p>
                    <p>
                        Dengan semboyan <strong>"Perusahaan logistik dengan tujuan yang kokoh"</strong>, <strong>"Perusahaan logistik yang penuh semangat &amp; dinamis"</strong>, dan <strong>"Perusahaan logistik yang gigih &amp; bertanggung jawab"</strong> serta identitas perusahaan (CI) kami, Zimmoah siap terus melangkah maju bersama seluruh pelanggan dan mitra.
                    </p>
                    <p class="font-bold text-black">Hormat kami,</p>
                @endif

                <!-- Signature -->
                <div class="pt-6 border-t border-neutral-200 flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4">
                    <div>
                        <img src="{{ asset('zimmoah-assets/images/ceo/boss-sign.jpg') }}" alt="CEO Signature"
                             class="h-14 w-auto object-contain mix-blend-multiply">
                        <p class="text-base font-black text-black mt-2">
                            @if ($locale === 'ko') CEO 이 지 현 @else Jason Lee @endif
                        </p>
                        <p class="text-xs font-semibold text-neutral-500">
                            @if ($locale === 'ko') 짐모아 마린 트란스 @else CEO, PT. Zimmoah Marine Trans @endif
                        </p>
                    </div>
                    <a href="{{ route('company.history') }}" class="bg-black hover:bg-[#FECE00] text-[#FECE00] hover:text-black font-black text-xs px-5 py-3 rounded-full transition shadow-sm">
                        @if ($locale === 'ko') 회사 연혁 보기 &rarr; @elseif ($locale === 'en') Explore Company History &rarr; @else Lihat Sejarah Perusahaan &rarr; @endif
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
