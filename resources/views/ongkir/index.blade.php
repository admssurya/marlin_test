<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!doctype html>
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>ONGKIR</title>
</head>
<body>
<div class="container">
    <form action="/ongkir/proses" method="post">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Provinsi</label>
            <select class="form-control" id="exampleFormControlSelect1" onchange="getKota(this.value)" required>
                @foreach($provinsi as $val)
                <option value="{{ $val->province_id }}">{{ $val->province }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Kota</label>
            <select class="form-control" id="kota" name="kota" required>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleFormControlSelect1">Pilih Kurir</label>
            <select class="form-control" id="kurir" name="kurir" required>
                <option value="jne">JNE</option>
                <option value="tiki">TIKI</option>
                <option value="pos">POS</option>
            </select>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Berat (gram)</label>
            <input type="number" name="berat" class="form-control" placeholder="Masukkan berat" required>
        </div>
        <button type="submit" class="btn btn-primary">Proses</button>
    </form>
</div>
<!-- Optional JavaScript -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.1.1.min.js"></script>

<script type="text/javascript">
    function getKota(str)
    {
        $('#kota').html('');

        $.ajax({
            url     : 'http://localhost:8000/ongkir/getKota/'+str,
            type    : 'GET',
            data    : '',
            success:function(i){
                // $('#program').append('<option value="">Pilih Kota</option>');
                var obj = i;
                $.each(obj, function(key, value) {
                    $('#kota').append('<option value="'+ value.city_id +'">'+ value.city_name +'</option>');
                });
            }
        });
    }
</script>

<!-- jQuery first, then Popper.js, then Bootstrap JS -->
</body>
</html>
