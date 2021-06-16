@extends('layouts.app')

@section('content')

<div class="container">
   <div class="justify-content-center row">
      <div class="col-md-8">
         <div class="card">
            <div class="card-header">{{ __('Histori Pembayaran') }}</div>
            <div class="card-body">
               <table class="table text-success">
                  @foreach($uangbangunan as $u)
                  <tr>
                     <td>
                        <br>
                        <div class="text-uppercase">
                           {{ $siswa->nama.' - '.$kelas->nama_kelas }}
                        </div>
                        Total Uang Bangunan Rp.{{ $totaluangbangunan }} <br>
                        Nominal Bayar Rp.{{ $bayar = $u->nominal }} <br>
                        Sisa Tunggakan Rp.{{ $u->sisa }} <br>
                     </td>
                     <td>
                        <div class="text-right">{{ $u->created_at }}</div>
                     </td>
                  </tr>
                  @endforeach
               </table>
               <table class="table text-center">
                  <tr>
                      <td>
                         <a href="/home" class="btn btn-success">Kembali</a>
                      </td>
                  </tr>
               </table>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection