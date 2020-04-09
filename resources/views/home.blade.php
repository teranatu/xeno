@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">部屋リスト</div>

                <div class="card-body row">
                    <div class="col-3">
                        <form method="POST" action="{{ route('groups.update')}}">
                            @csrf
                            <input type="hidden" name="_method" value="PUT">
                            <button class="btn btn-primary" type="submit">部屋1</button>
                            <input type="hidden" name="group" value="1">
                        <form>
                        <p id="inRoomUsers" class="d-inline">0/4人</p>
                    </div>
                    <div class="col-3">
                        <button class="btn btn-primary">部屋2</button>
                        <p class="d-inline">0/4人</p>
                    </div>
                    <div class="col-3">
                        <button class="btn btn-primary">部屋3</button>
                        <p class="d-inline">0/4人</p>
                    </div>
                    <div class="col-3">
                        <button class="btn btn-primary">部屋4</button>
                        <p class="d-inline">0/4人</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('js/isCount.js') }}"></script>
@endsection
