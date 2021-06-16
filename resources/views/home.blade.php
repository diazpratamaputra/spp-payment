@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div><br/><br/>
            <div class="card">
                <div class="card-header">{{ __('Rekapan SPP') }}</div>
                <div class="card-body">
                    <h4>Today <?php echo date('d M, Y') ?></h4>
                    <?php
                        $tahun = $paraTahun;
                        $bulan = array("JAN", "FEB", "MAR", "APR", "MAY", "JUN", "JUL", "AUG", "SEP", "OKT", "NOV", "DES");
                    ?>
                    <table class="table">
                        <thead>
                            <tr>
                                <td class="text-center" colspan="3">{{ $tahun }}</td>
                            </tr>
                        </thead>
                        <tbody class="bg-light text-justify">
                            <tr>
                                @for($i = 0; $i < 3; $i++)
                                    <td width="33%" class="{{ $bulanSPP[$i] }}">{{ $bulan[$i] }} = {{ $bulanArray[$i] }}</td>
                                @endfor
                            </tr>
                            <tr>
                                @for($i = 3; $i < 6; $i++)
                                    <td width="33%" class="{{ $bulanSPP[$i] }}">{{ $bulan[$i] }} = {{ $bulanArray[$i] }}</td>
                                @endfor
                            </tr>
                            <tr>
                                @for($i = 6; $i < 9; $i++)
                                    <td width="33%" class="{{ $bulanSPP[$i] }}">{{ $bulan[$i] }} = {{ $bulanArray[$i] }}</td>
                                @endfor
                            </tr>
                            <tr>
                                @for($i = 9; $i < 12; $i++)
                                    <td width="33%" class="{{ $bulanSPP[$i] }}">{{ $bulan[$i] }} = {{ $bulanArray[$i] }}</td>
                                @endfor
                            </tr>
                        </tbody>               
                    </table>
                    <table class="table text-center">
                        <tr>
                            <td>
                                <a href="/spp/years/{{ $tahun-1 }}" class="btn btn-success"><- Back</a>
                            </td>
                            <td>
                                <a href="/spp/payment/{{ $tahun }}" class="btn btn-primary">Payment</a>
                            </td>
                            <td>
                                <a href="/spp/years/{{ $tahun+1 }}" class="btn btn-success">Next -></a>
                            </td>
                        </tr>
                    </table>
                </div>
            </div><br/><br/>
            <div class="card">
                <div class="card-header">{{ __('Rekapan Uang Bangunan') }}</div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <td>Total Uang Bangunan</td>
                            <td class="text-right">:</td>
                            <td>Rp{{ $uangBangunan }}</td>
                        </tr>
                        <tr>
                            <td>Total Sudah Dibayar</td>
                            <td class="text-right">:</td>
                            <td>Rp{{ $totalSudahDibayar }}</td>
                        </tr>
                        <tr>
                            <td>Sisa Pembayaran</td>
                            <td class="text-right">:</td>
                            <td>
                                @if($Output == 0)
                                    Lunas
                                @elseif($Output > 0)
                                    {{ "Rp".$Output }}
                                @endif
                            </td>
                        </tr>
                    </table>
                    <table class="table text-center">
                        <tr>
                            <td width="66%">
                                <a href="/uangBangunan/histori" class="btn btn-success">Histori Pembayaran</a>
                            </td>
                            <td width="33%">
                                @if($Output == 0)
                                    <a href="#" class="btn btn-secondary">Payment</a>
                                @else
                                    <a href="/uangBangunan/payment" class="btn btn-primary">Payment</a>
                                @endif
                                
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
