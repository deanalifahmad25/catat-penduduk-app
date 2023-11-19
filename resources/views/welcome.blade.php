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
    <!-- DataTables -->
    <link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet" />
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css" rel="stylesheet" />
</head>
<body class="antialiased">
    <section class="h-100 w-100 bg-white" style="box-sizing: border-box;">
        @include('navbar')

        <div class="empty-2-2 container mx-auto d-flex align-items-center justify-content-center flex-column">
            <div class="wrapper w-100">
                <div class="row">
                    <div class="col-sm-6 p-3">
                        <a href="{{ route('create.penduduk') }}" class="btn btn-primary">Tambah Data</a>
                    </div>
                    <div class="col-6 p-3 mb-2 d-flex align-items-center justify-content-end">
                        <select name="province" id="province" class="form-control" required style="width: 200px;">
                            <option value="">Pilih Provinsi</option>
                            @foreach ($provinces as $province)
                                <option value="{{ $province->id }}">{{ $province->name }}</option>
                            @endforeach
                        </select>
                        <select name="district" id="district" class="form-control mx-2" required style="width: 200px;">
                            <option value="">Pilih Kabupaten</option>
                        </select>
                        <button type="button" id="filterBtn" class="btn btn-primary btn-sm">Filter</button>
                    </div>
                </div>

                <div class="row mt-4">
                    <table class="table align-middle mb-0 bg-white" id="pendudukTable">
                        <thead class="bg-light">
                            <tr>
                                <th>No</th>
                                <th>Aksi</th>
                                <th>Nama</th>
                                <th>NIK</th>
                                <th>Tanggal Lahir</th>
                                <th>Alamat</th>
                                <th>Jenis Kelamin</th>
                                <th>Ditambahkan Pada</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($data as $penduduk)
                                <tr>
                                    <td>
                                        <p class="fw-bold">{{ $loop->iteration }}</p>
                                    </td>
                                    <td class="d-flex justify-content-center align-items-center flex-column mt-2">
                                        <a href="{{ route('edit.penduduk', $penduduk->id) }}"
                                            class="btn btn-link btn-sm">
                                            Edit
                                        </a>
                                        <form method="post" action="{{ route('delete.penduduk', $penduduk->id) }}">
                                            @csrf
                                            @method('delete')
                                            <button type="submit" class="btn btn-link btn-sm text-danger">
                                                Hapus
                                            </button>
                                        </form>
                                    </td>
                                    <td>
                                        <p class="fw-normal">{{ $penduduk->name }}</p>
                                    </td>
                                    <td>
                                        <p class="fw-normal">{{ $penduduk->nik }}</p>
                                    </td>
                                    <td>
                                        <p class="fw-normal">{{ date('d F Y', strtotime($penduduk->date_birth)) }}</p>
                                    </td>
                                    <td>
                                        <p class="fw-normal">
                                            {{ $penduduk->address . ', ' . $penduduk->district->name . ', ' . $penduduk->province->name }}
                                        </p>
                                    </td>
                                    <td>
                                        <p class="fw-normal">{{ $penduduk->gender }}</p>
                                    </td>
                                    <td>
                                        <p class="text-muted">
                                            @if (!$penduduk->updated_at)
                                                {{ $penduduk->created_at }}
                                            @else
                                                {{ $penduduk->updated_at }}
                                            @endif
                                        </p>
                                    </td>
                                </tr>
                            @empty
                                <td colspan='8' style="text-align: center; font-weight: bold;">
                                    Tidak Ada Data Penduduk
                                </td>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>

    <script src="https://code.jquery.com/jquery-3.7.0.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $('#pendudukTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'csv', 'excel', 'print'
                ]
            });
        });

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

        $(document).ready(function() {
            $('#filterBtn').on('click', function() {
                var provinceId = $('#province').val();
                var districtId = $('#district').val();

                $.ajax({
                    url: '/get-filtered-data',
                    type: 'GET',
                    data: {
                        province_id: provinceId,
                        district_id: districtId,
                    },
                    success: function(response) {
                        $('#pendudukTable').DataTable().clear().rows.add(response.data).draw();
                    }
                });
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
