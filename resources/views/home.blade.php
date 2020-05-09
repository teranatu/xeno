@extends('layouts.app')

@section('content')
<div class="bgi_front">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mt-5">
                <div class="card-header text-center">闘技場一覧</div>
                    <div class="card-body row">
                    @for($i=1,$ii=1; $i < 81; $i += 10,$ii++)
                        <div class="col-6 mt-3 text-center ">
                            
                            <button class="btn btn-primary text-center w-80" onclick="style.visibility ='hidden';document.getElementById('colosseum{{ $ii }}').submit()">
                                <p></p>
                                <p class="lead">闘技場{{ $ii }}に入場</p>
                                <div class="pb-3">
                                    <div class="d-inline">現在:</div>
                                    <div class="d-inline" id="inRoomUsers_{{ $ii }}">0/4人</div>
                                </div>
                            </button>
                            <form id ="colosseum{{ $ii }}" method="POST" action="{{ route('groups.store') }}" style="display: none;">
                                @csrf
                                <input type="hidden" name="group" value={{ $i }}>
                            </form>
                            
                        </div>
                    @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
