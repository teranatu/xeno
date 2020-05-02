@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">部屋リスト</div>
                    <div class="card-body row">
                    @for($i=1,$ii=1; $i < 101; $i += 10,$ii++)
                        <div class="col-3">
                            <form method="POST" action="{{ route('groups.store') }}">
                                @csrf
                                <button class="btn btn-primary" type="submit">部屋{{ $ii }}</button>
                                <input type="hidden" name="group" value={{ $i }}>
                            </form>
                            <p id="inRoomUsers_{{ $ii }}" class="d-inline">0/4人</p>
                        </div>
                    @endfor
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
