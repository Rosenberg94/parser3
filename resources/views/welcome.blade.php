@extends('bootstrap')
@section('content')

    <div class="row justify-content-center">
        <div class=" card mt-3 col-md-7 bg-grey">

            <h2 class="text-center mt-3 mb-3" >Create article</h2>
            <form action="{{ route("send_url") }}" method="post" enctype="multipart/form-data">
                @csrf

                <div class="form-group row mt-3">
                    <div class="col-md-4">
                        <label for="url" class="form-label">Url</label>
                    </div>
                    <div class="col-md-7">
                        <input type="text" class="form-control" id="url" name="url">
                    </div>
                </div>
                <div class="form-group row mt-3 mb-3">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <button class="btn btn-primary text-center" type="submit">Create</button>
                    </div>
                    <div class="col-md-4"></div>
                </div>
            </form>
        </div>
    </div>







    @endsection
