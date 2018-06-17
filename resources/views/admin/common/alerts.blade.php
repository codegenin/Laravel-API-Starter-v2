<div style="margin-top: 20px;"></div>
@if ($errors->any())
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-danger">
                <h4><i class="icon fa fa-ban"></i>Oops! Something went Wrong!</h4>
                <p>Please fix the error(s) below and try again.</p>
                <ul style="margin-top: 5px;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endif
@if (session()->has('success'))
    <div class="row">
        <div class="col-sm-12">
            <div class="alert alert-success">
                <p>Request has been successfully processed!</p>
            </div>
        </div>
    </div>
@endif