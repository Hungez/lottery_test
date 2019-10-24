@extends('layouts.app')

@section('content')
<!--Body-->
<div id="bodywrap">
  <div id="body-left"></div>
  <div id="body-right">
    <div id="text-wrap">
      <p class="heading">Welcome to LOTTERY SYSTEM</p>
      <p>&nbsp;</p>
      <p>All winner result</p>

      <p><img src="{{ asset('images/doted.jpg') }}" alt="Lottery" title="Lottery" width="504" height="3" />
      </p>
      <div id="lowerbody">
        <div id="lower-bodyleft">
          <div id="inner-left">
            <div id="games-wrap" class="yellow-bigheading">Most Lucky<br /><strong
                class="yellow-heading">Players</strong>
              <div id="games">
                @if (!empty($winnerList) || count($winnerList)>0)
                    @foreach($winnerList as $value)
                    <p class="mt10"><img src="{{ asset('images/stars.gif') }}" alt="Lottery" title="Lottery" width="10"
                        height="10" />
                       <img src="{{ asset('images/stars.gif') }}" alt="Lottery" title="Lottery"
                        width="10" height="10" />
                       <img src="{{ asset('images/stars.gif') }}" alt="Lottery"
                        title="Lottery" width="10" height="10" />
                       <img src="{{ asset('images/stars.gif') }}"
                        alt="Lottery" title="Lottery" width="10" height="10" />
                       <img src="{{ asset('images/stars.gif') }}" alt="Lottery" title="Lottery" width="10"
                        height="10" />&nbsp;&nbsp;&nbsp;

                        @if($value->prize_type == 6)
                            <span class="text-uppercase">first prize - {{ $value->winning_number }}</span>
                        @elseif($value->prize_type == 5)
                            <span class="text-uppercase">second prize - 1st winner - {{ $value->winning_number }}</span>
                        @elseif($value->prize_type == 4)
                            <span class="text-uppercase">second prize - 2nd - {{ $value->winning_number }}</span>
                        @elseif($value->prize_type == 3)
                            <span class="text-uppercase">third prize - 1st - {{ $value->winning_number }}</span>
                        @elseif($value->prize_type == 2)
                            <span class="text-uppercase">third prize - 2nd winner - {{ $value->winning_number }}</span>
                        @elseif($value->prize_type == 1)
                            <span class="text-uppercase">third prize - 3rd winner - {{ $value->winning_number }}</span>
                        @endif
                        <br>
                       <span class="body-link text-uppercase"><b>{{ $value->name }}</b></span></p>
                    @endforeach
                @else
                    <h2>No winners yet</h2>
                @endif
              </div>
            </div>
          </div>
          <div id="inner-right"></div>
        </div>
        <div id="lower-bodyright"></div>
      </div>
    </div>
  </div>

</div>
@endsection

@push('css')
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
@endpush
