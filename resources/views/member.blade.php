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
                <div class="card-header warning">Member</div>

                <div class="card-body">
                    <form method="POST" action="/purchase_number">
                        @csrf

                        <div class="form-group">
                            <label for="generate_member" class="form-label">Generate Member</label>
                            <select id="generate_member" name="generate_member" class="form-control" required>
                              <option value="">please select</option>
                              <option value="1">yes</option>
                              <option value="2">no</option>
                            </select>
                        </div>

                        <div id="member_name" class="form-group d-none">
                            <label for="member_name" class="form-label">Member name</label>
                            <input type="text" class="form-control" name="member_name" maxlength="10">
                        </div>

                        <div class="form-group">
                            <label for="lucky_number" class="form-label">Lucky Number</label>
                            <input type="number" class="form-control" name="lucky_number" pattern="\d*" onKeyPress="if(this.value.length==4) return false;">
                        </div>

                        <hr>

                        <input type="submit" class="btn btn-success" value="Purchase">
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

        $('#generate_member').on('change', function() {
            if ((this.value == 1) || (this.value == '')) {
                $('#member_name').addClass('d-none');
            } else if(this.value == 2) {
                $('#member_name').removeClass('d-none');
            }
        });

    });
</script>
@endpush
