




@if (isset($selectcard_1) && ($user->select_user == Auth::id()))
  <div class="col-4">
    <button class="btn btn-success pt-4 pb-4" onclick="style.visibility ='hidden';document.getElementById('selectcard_1').submit()">1枚目:{{ $selectcard_1 }}</button>
  </div>

  <form id="selectcard_1" class="navbar-expand" method="POST" action="{{ route('selectedCard')}}" >
    @csrf
    <input type="hidden" name="selectedCard" value="{{ $selectcard_1 }}">
  </form>
@endif

@if (isset($selectcard_2) && ($user->select_user == Auth::id()))
  <div class="col-4">
    <button class="btn btn-success pt-4 pb-4" onclick="style.visibility ='hidden';document.getElementById('selectcard_2').submit()">2枚目:{{ $selectcard_2 }}</button>
  </div>
  
  <form id="selectcard_2" class="navbar-expand" method="POST" action="{{ route('selectedCard')}}">
    @csrf
    <input type="hidden" name="selectedCard" value="{{ $selectcard_2 }}">
  </form>
@endif

@if (isset($selectcard_3) && ($user->select_user == Auth::id()))
  <div class="col-4">
  <button class="btn btn-success pt-4 pb-4" onclick="style.visibility ='hidden';document.getElementById('selectcard_3').submit()">3枚目:{{ $selectcard_3 }}</button>
  </div>
  
  <form id="selectcard_3" method="POST" class="navbar-expand" action="{{ route('selectedCard')}}">
    @csrf
    <input type="hidden" name="selectedCard" value="{{ $selectcard_3 }}">
  </form>
@endif