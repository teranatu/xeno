@if (isset($selectcard_1) && ($user->id == Auth::id()))
  <div class="row col-6 mt-5">
  <div class="col-1 pt-2 pb-2 navbar"></div>
  <button class="btn col-2 btn-success pt-2 pb-2">1枚目：{{ $selectcard_1 }}</button>
  @endif
  @if (isset($selectcard_2) && ($user->id == Auth::id()))
  <div class="col-1 pt-2 pb-2 navbar"></div>
  <button class="btn col-2 btn-success pt-2 pb-2">2枚目：{{ $selectcard_2 }}</button>
  @endif
  @if (isset($selectcard_3) && ($user->id == Auth::id()))
    <div class="col-1 pt-2 pb-2 navbar"></div>
    <button class="btn col-2 btn-success pt-2 pb-2">3枚目：{{ $selectcard_3 }}</button>
  </div>
  @endif