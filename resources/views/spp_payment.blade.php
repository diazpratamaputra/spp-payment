@extends('layouts.app')

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card">
				<div class="card-header">{{ __('Entri Pembayaran') }}</div>
				<div class="card-body">
					<form method="post" action="/spp/bayar/{{ $paraTahun }}">
	                    {{ csrf_field() }}
	                    <div class="form-group">
	                        <label>ID Siswa</label>
	                        <input type="text" class="form-control" name="id_siswa" placeholder="Masukkan ID Siswa...">
	                        
	                        @if($errors->has('id_siswa'))
	                        	<div class="text-danger">{{ $errors->first('id_siswa') }}</div>
	                        @endif
	                    </div>
	                    <div class="form-group">
	                    	<label for="bulan" class="col-form-label">SPP Bulan</label>
	                    	<select id="bulan" class="form-control" name="bulan">
	                    		<?php
	                           		$bulan = array("Januari", "Febuari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
	                           	?>
	                    		<option value="">Silahkan Pilih</option>
	                    		@for($i = 0; $i < 12; $i++)
                                <option value="{{ $bulan[$i] }}" {{ $dataBulan[$i] }}>{{ $bulan[$i] }}</option>
	                           	@endfor

	                           	@if($errors->has('bulan'))
	                           		<div class="text-danger">
	                           			{{ $errors->first('bulan') }}
	                           		</div>
	                           	@endif
	                    	</select>
	                    </div>
	                   	<div class="form-group">
	                   		<a href="/home" class="btn btn-success">Kembali</a>
	                   		<input type="submit" class="btn btn-success" value="Bayar"></input>
	                   	</div>
	                </form>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection