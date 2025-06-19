@if ($histori->isEmpty())
<div class="alert alert-danger p-1 m-1" style="background-color: #f44336; color: white;">
    <strong style="font-size: 18px; font-weight: bold;">Data Belum Ada</strong>
</div>
@endif
@foreach ($histori as $d)

<ul class="listview image-listview">
    <li>
        <div class="item">
            @if ($d->foto_in)
                <img src="{{ url('/absensi-img/' . $d->foto_in) }}" class="image" alt="foto" style="width:80px; height:60px; object-fit:cover; border-radius:6px;">
            @else
                <img src="{{ asset('assets/img/sample/avatar/avatar1.jpg') }}" class="image" alt="foto">
            @endif
            <div class="in">
                <div>
                    <b>{{ date("d-m-Y", strtotime($d->tgl_presensi)) }}</b><br>
                </div>
                <span class="badge {{ $d->jam_in > '07:00' ? 'bg-danger' : 'bg-success' }}">
                    {{ $d->jam_in }}
                </span>
                <span class="badge bg-primary">{{ $d->jam_out }}</span>
            </div>
        </div>
     
        
    </li>
</ul>
@endforeach