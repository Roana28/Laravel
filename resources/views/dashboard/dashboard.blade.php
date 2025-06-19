@extends('layouts.presensi')
@section('content')

    <div class="section" id="user-section">
        <div id="user-detail">
            <div class="avatar">
                @if(Auth::guard('karyawan')->user()->foto)
                    <img src="{{ url('/foto-karyawan/' . Auth::guard('karyawan')->user()->foto) }}" class="imaged w64" style="height:60px">
                @else
                    <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" class="imaged w64 rounded">
                @endif
            </div>
            <div id="user-info">
                <h2 id="user-name">{{ Auth::guard('karyawan')->user()->nama_lengkap }}</h2>
                <span id="user-role">{{ Auth::guard('karyawan')->user()->jabatan }}</span>
            </div>
        </div>
    </div>



            <div class="row text-center">
            <div class="col-6">
                <h3>Rekap Presensi Bulan {{ $namabulan[$bulanini ?? 0] ?? 'Bulan tidak valid' }} Tahun {{$tahunini}}</h3>
                <div class="p-2 bg-success text-white rounded">
                    <p>Masuk</p>
                    <img src="{{ asset('path/foto_masuk.jpg') }}" class="img-fluid rounded mb-2">
                    <p>02:27:14</p>
                </div>
            </div>
            <div class="col-6">
                <div class="p-2 bg-danger text-white rounded">
                    <p>Pulang</p>
                    <img src="{{ asset('path/foto_pulang.jpg') }}" class="img-fluid rounded mb-2">
                    <p>02:36:27</p>
                </div>
            </div>
        </div>

    <div class="section" id="menu-section">
        <div class="card">
            <div class="card-body text-center">
                <div class="list-menu">
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="green" style="font-size: 40px;">
                                <ion-icon name="person-sharp"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Profil</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="danger" style="font-size: 40px;">
                                <ion-icon name="calendar-number"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Cuti</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="warning" style="font-size: 40px;">
                                <ion-icon name="document-text"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            <span class="text-center">Histori</span>
                        </div>
                    </div>
                    <div class="item-menu text-center">
                        <div class="menu-icon">
                            <a href="" class="orange" style="font-size: 40px;">
                                <ion-icon name="location"></ion-icon>
                            </a>
                        </div>
                        <div class="menu-name">
                            Lokasi
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="section mt-2" id="presence-section">
        <div class="todaypresence">
            <div class="row">
                <div class="col-6">
                        <div class="card gradasigreen">
                            <div class="card-body p-1 text-center" style="padding: 6px !important;">
                                <!-- Judul di tengah -->
                                <h4 class="presencetitle text-white mb-2" style="font-size: 14px; text-align: center;">Masuk</h4>
                                
                                @if($presensihariini && $presensihariini->foto_in)
                                    <img src="{{ url('/absensi-img/' . $presensihariini->foto_in) }}" 
                                        style="width: 80px; height: 60px; object-fit: cover; border-radius: 6px;">
                                @endif

                                <!-- Jam di bawah gambar -->
                                <div class="text-white mt-1" style="font-size: 14px; font-weight: bold;">
                                    {{ $presensihariini != null ? $presensihariini->jam_in : 'Belum Absen' }}
                                </div>
                            </div>
                        </div>      
                    </div>
                 <div class="col-6">
                    <div class="card gradasired">
                            <div class="card-body p-1 text-center" style="padding: 6px !important;">
                                <!-- Judul Pulang di tengah -->
                                <h4 class="presencetitle text-white mb-2" style="font-size: 14px; text-align: center;">Pulang</h4>
                                
                                @if($presensihariini && $presensihariini->foto_out)
                                    <img src="{{ url('/absensi-img/' . $presensihariini->foto_out) }}" 
                                        style="width: 80px; height: 60px; object-fit: cover; border-radius: 6px;">
                                @endif

                                <!-- Jam pulang -->
                                <div class="text-white mt-1" style="font-size: 14px; font-weight: bold;">
                                    {{ $presensihariini != null ? $presensihariini->jam_out : 'Belum Absen' }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div id="rekappresensi">
                <h3>Rekap Presensi Bulan {{ $namabulan[$bulanini ?? 0] ?? 'Bulan tidak valid' }} Tahun {{$tahunini}}</h3>
                <div class="row">
                
                
                    <div class="col-3 mt-3">
                        <div class="card shadow-sm" style="border-radius: 8px;">
                            <div class="card-body text-center p-2" style="padding: 12px 8px !important; line-height:0.8rem;">
                                <span class="badge bg-danger" style="position: absolute;top:3px; right:7px; font-size:0.6rem;
                                z-index:999">{{ $rekappresensi->jmlhadir }}</span>

                                <ion-icon name="people-circle-outline" style="font-size: 25px; color: #007bff;"class="text-primary mb-1"></ion-icon>
                                <br>
                                <span style="font-size: 0.8 rem; font-weight:500">Hadir</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mt-3">
                        <div class="card shadow-sm" style="border-radius: 8px;">
                            <div class="card-body text-center p-2" style="padding: 12px 8px !important;">
                                <span class="badge bg-danger" style="position: absolute;top:3px; right:7px; font-size:0.6rem;
                                z-index:999">1</span>
                                <ion-icon name="newspaper-outline"style="font-size: 25px; color: #0FD712FF;"></ion-icon>
                                <br>
                                <span style="font-size: 0.8 rem; font-weight:500">Izin</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mt-3">
                        <div class="card shadow-sm" style="border-radius: 8px;">
                            <div class="card-body text-center p-2" style="padding: 12px 8px !important;">
                                <span class="badge bg-danger" style="position: absolute;top:3px; right:7px; font-size:0.6rem;
                                z-index:999">0</span>
                                <ion-icon name="add-circle-outline"style="font-size: 25px;" class="text-warning"></ion-icon>
                                <br>
                                <span style="font-size: 0.8 rem; font-weight:500">Sakit</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-3 mt-3">
                        <div class="card shadow-sm" style="border-radius: 8px;">
                            <div class="card-body text-center p-2" style="padding: 12px 8px !important;">
                                <span class="badge bg-danger" style="position: absolute;top:3px; right:7px; font-size:0.6rem;
                                z-index:999">{{ $rekappresensi->jmlterlambat }}</span>
                                <ion-icon name="time-outline" style="font-size: 25px; color: #FF0000FF;"></ion-icon>
                                <br>
                                <span style="font-size: 0.8 rem; font-weight:500">Telat</span>
                            </div>
                        </div>
                    </div>
                </div>

             </div>


            <div class="presencetab mt-2">
            <div class="tab-pane fade show active" id="pilled" role="tabpanel">
                <ul class="nav nav-tabs style1" id="presenceTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link active"
                        id="bulanini-tab"
                -          data-bs-toggle="tab"
                +          data-toggle="tab"
                        data-bs-target="#bulanini"
                        href="#bulanini"
                        role="tab">
                        Bulan Ini
                        </a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link"
                        id="leaderboard-tab"
                -          data-bs-toggle="tab"
                +          data-toggle="tab"
                        data-bs-target="#leaderboard"
                        href="#leaderboard"
                        role="tab">
                        Leaderboard
                        </a>
                    </li>
                </ul>
            </div>

           {{-- TAB CONTENT --}}
    <div class="tab-content mt-2" id="presenceTabContent" style="margin-bottom:100px;">

        {{-- ---------- TAB ”BULAN INI” (ISI HISTORI ABSEN) ---------- --}}
        <div class="tab-pane fade show active"
             id="bulanini" role="tabpanel" aria-labelledby="bulanini-tab">

            <h3>
                Rekap Presensi Bulan
                {{ $namabulan[$bulanini ?? 0] ?? 'Bulan tidak valid' }}
                Tahun {{ $tahunini }}
            </h3>

            <ul class="listview image-listview">
                @php $today = \Carbon\Carbon::today()->format('d-m-Y'); @endphp

                @foreach ($historibulanini as $d)
                    @if (date('d-m-Y', strtotime($d->tgl_presensi)) == $today)
                        <div class="alert alert-success alert-absen">
                            {{ session('sukses') }}
                        </div>
                    @endif
                    <li>
                        <div class="item">
                            <div class="icon-box bg-primary">
                                <ion-icon name="finger-print"></ion-icon>
                            </div>

                            <div class="in"
                                 style="display:flex;justify-content:space-between;align-items:center;width:100%;">
                                {{-- Tanggal --}}
                                <div style="font-weight:500;">
                                    {{ date('d-m-Y', strtotime($d->tgl_presensi)) }}
                                </div>

                                {{-- Jam Masuk & Pulang --}}
                                <div style="display:flex;flex-direction:column;align-items:flex-end;">
                                    <span style="
                                        background-color:#28a745;color:white;font-weight:bold;
                                        padding:4px 10px;border-radius:20px;display:inline-block;
                                        font-size:14px;min-width:80px;text-align:center;">
                                        {{ $d->jam_in }}
                                    </span>
                                    <br>
                                    <span style="
                                        background-color:#dc3545;color:white;font-weight:bold;
                                        padding:4px 10px;border-radius:20px;display:inline-block;
                                        font-size:14px;min-width:80px;text-align:center;">
                                        {{ $presensihariini && $d->jam_out ? $d->jam_out : 'Belum Absen' }}
                                    </span>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
            
                {{-- TAB LEADERBOARD --}}
                <div class="tab-pane fade" id="leaderboard" role="tabpanel" aria-labelledby="leaderboard-tab">
                    <ul class="listview image-listview">
                        @forelse ($leaderboard as $d)
                            <li>
                                <div class="item">
                                    {{-- avatar contoh statis – ganti dgn foto karyawan jika ada --}}
                                    <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" class="image" alt="foto">
                                    <div class="in">
                                        <div>
                                            <b>{{ $d->nama_lengkap }}</b><br>
                                            <small class="text-muted">{{ $d->jabatan }}</small>
                                        </div>
                                        <span class="badge {{ $d->jam_in < '07:00' ? 'bg-danger' : 'bg-success' }}">
                                            {{ $d->jam_in }}
                                        </span>
                                    </div>
                                </div>
                            </li>
                        @empty
                            <li><div class="item text-center">Belum ada presensi hari ini.</div></li>
                        @endforelse
                    </ul>
                </div>
            </div>
        </div>
    </div>

@section('header')


    <!-- CSS Anti-Goyang -->
    <style>
        .tab-content {
            position: relative;
            min-height: 350px; /* Atur tinggi minimum agar tidak goyang */
            transition: all 0.3s ease-in-out;
            margin-bottom: 100px;
        }

        .tab-pane {
            transition: opacity 0.3s ease-in-out;
        }

        .tab-pane:not(.show.active) {
            display: none !important;
        }

        .alert-absen {
            margin-bottom: 15px;
        }
    </style>
@endsection

@section('footer')
    <!-- JS untuk Hapus Alert Saat Buka Tab Leaderboard -->
    <script>
        document.addEventListener('shown.bs.tab', function (e) {
            if (e.target.id === 'leaderboard-tab') { // Tab Leaderboard aktif
                document.querySelectorAll('.alert-absen').forEach(el => el.remove());
            }
        });
    </script>
@endsection



@endsection