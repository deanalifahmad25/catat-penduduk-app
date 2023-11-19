<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Catat Penduduk App</title>

    <!-- Scripts -->
    <link rel="stylesheet" href="{{ asset('main.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.css" rel="stylesheet" />
</head>

<body class="antialiased">
    <section class="h-100 w-100 bg-white" style="box-sizing: border-box;">
        <div class="empty-2-2 container mx-auto d-flex align-items-center justify-content-center flex-column">
            <div class="wrapper w-100">
                <div class="row">
                    <h3 class="mb-4 text-center">Form Tambah Data</h3>

                    <form method="post" action="{{ route('update.penduduk', $penduduk->id) }}">
                    @csrf
                    @method('put')

                        <div class="form-outline mb-4">
                            <input type="text" name="name" class="form-control" required value="{{ isset($penduduk) ? $penduduk->name : '' }}" />
                            <label class="form-label" for="name">Nama</label>
                        </div>

                        <div class="form-outline mb-4">
                            <input type="text" name="nik" class="form-control" required value="{{ isset($penduduk) ? $penduduk->nik : '' }}" />
                            <label class="form-label" for="nik">NIK</label>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-2">
                                <label class="form-label" for="gender">Jenis Kelamin</label>
                            </div>
                            <div class="col-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="Laki-Laki" />
                                    <label class="form-check-label" for="Laki-Laki">Laki-Laki</label>
                                </div>

                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="gender" value="Perempuan" />
                                    <label class="form-check-label" for="Perempuan">Perempuan</label>
                                </div>
                            </div>
                        </div>

                        <div class="row mb-4">
                            <div class="col-sm-2">
                                <label class="form-label" for="date_birth">Tanggal Lahir</label>
                            </div>
                            <div class="col-10">
                                <input type="date" name="date_birth" class="form-control" required />
                            </div>
                        </div>

                        <div class="form-outline mb-4">
                            <textarea class="form-control" name="address" rows="4" required></textarea>
                            <label class="form-label" for="address">Alamat</label>
                        </div>

                        <div class="row mb-4">
                            <div class="col-6">
                                <label class="form-label" for="province">Provinsi</label>
                                <select name="province" id="province" class="form-control" required>
                                    <option value="">Pilih Provinsi</option>
                                    @foreach ($provinces as $province)
                                        <option value="{{ $province->id }}">{{ $province->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label class="form-label" for="district">Kabupaten</label>
                                <select name="district" id="district" class="form-control" required>
                                    <option value="">Pilih Kabupaten</option>
                                </select>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary btn-block mb-4">Simpan</button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $('#province').change(function() {
            var provinceId = $(this).val();
            $.ajax({
                url: '/get-district',
                type: 'GET',
                data: {
                    province_id: provinceId
                },
                success: function(data) {
                    var options = '<option value="">Pilih Kabupaten</option>';
                    for (var i = 0; i < data.length; i++) {
                        options += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                    }
                    $('#district').html(options);
                }
            });
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
    </script>
    <!-- MDB -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.4.2/mdb.min.js"></script>
</body>

</html>
