@extends('layouts.app')

@section('content')

@if (Session::has('success'))
    <div class="alert alert-success">
        {{ Session::get('success') }}
    </div>
@elseif(Session::get('fail'))
    <div class="alert alert-danger">
       {{ Session::get('fail') }}
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header warning">Lucky Draw</div>

                <div class="card-body">
                    <form method="POST" action="/draw">
                        @csrf
                        <div class="form-group">
                            <label for="prize_type" class="form-label">Prize Types *</label>
                            <select name="prize_type" class="form-control" required>
                              <option value="">please select</option>
                              <option value="1">third prize - 1st winner</option>
                              <option value="2">third prize - 2nd winner</option>
                              <option value="3">third prize - 3rd winner</option>
                              <option value="4">second prize - 1st winner</option>
                              <option value="5">second prize - 2nd winner</option>
                              <option value="6">first prize</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="generate_type" class="form-label">Generate Randomly</label>
                            <select id="generate_type" name="generate_type" class="form-control" required>
                              <option value="">please select</option>
                              <option value="1">yes</option>
                              <option value="2">no</option>
                            </select>
                        </div>

                        <div id="winner_number" class="form-group d-none">
                            <label for="winning_number" class="form-label">Winning Number</label>
                            <input type="number" class="form-control" name="winning_number" pattern="\d*" onKeyPress="if(this.value.length==4) return false;">
                        </div>

                        <hr>

                        <input type="submit" class="btn btn-success" value="Draw">
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script type="text/javascript">
    $(document).ready(function() {

        $('#generate_type').on('change', function() {
            if ((this.value == 1) || (this.value == '')) {
                $('#winner_number').addClass('d-none');
            } else if(this.value == 2) {
                $('#winner_number').removeClass('d-none');
            }
        });

    });
</script>
@endpush
