<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!--Подключаем библиотеку-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>

    <title>Hello, world!</title>
</head>
<body>
    <div class="text-center">

        <div id="spin" class="spinner-border" role="status" hidden>
            <span class="visually-hidden">Loading...</span>
        </div>

        <h2 class="text-center mt-3 mb-3" >Parse jobs</h2>
            <div class="form-group row mt-3">
                <div class="col-md-4">
                    <label for="loc" class="form-label">Location(for ex. Bucuresti)</label>
                </div>
                <div class="col-md-7">
                    <input type="text" class="form-control" id="loc" name="loc">
                </div>
            </div>
            <div class="form-group row mt-3">
                <div class="col-md-4">
                    <label for="url" class="form-label">Position(for ex. Symfony)</label>
                </div>
                <div class="col-md-7">
                    <input id="url" type="text" class="form-control"  name="url">
                </div>
            </div>
        <button id="but" class="btn btn-primary mt-3 mb-3">adfasdfasdfasdasdf</button>

        <div id="jobs"></div>

        <script>

             function showJobs(jobs){
                jobs.forEach(function(job){
                     $('#jobs').append(
                         '<h5 class="card-title text-center">' + job.title + '</h5>',
                         '<h5 class="card-title text-center">' + job.company + '</h5>',
                         '<h5 class="card-title text-center">' + job.location + '</h5>',
                         '<h5 class="card-title text-center">' + job.description + '</h5><br>'
                     )
                 })
             }

            $("#but").click(function(){

                $("#spin").removeAttr('hidden');
                $.ajax({
                    type: "GET",
                    data: {
                        loc: $('#loc').val(),
                        url: $('#url').val()
                    },
                    url: "http://parser3/sendjs/",

                    success: function(result){
                        $("#spin").hide();
                        showJobs(result.jobs);
                    }});
            });

        </script>
        <!-- Optional JavaScript; choose one of the two! -->

        <!-- Option 1: Bootstrap Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

        <!-- Option 2: Separate Popper and Bootstrap JS -->
        <!--
        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>
        -->
    </div>
</body>
</html>
