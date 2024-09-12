@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <div class="container-fluid px-5">
        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif
        <div class="card">
            <div class="card-body">
                <h4 class="w-100 text-center text-primary">Firmalar</h4>
                <table id="usersTable" class="table table-striped table-bordered text-center">
                    <thead>
                        <tr>
                            <th class="bg-primary text-white text-center">#</th>
                            <th class="bg-primary text-white text-center">Firma</th>
                            <th class="bg-primary text-white text-center">Jami buyurtmalar</th>
                            <th class="bg-primary text-white text-center">Aktiv</th>
                            <th class="bg-primary text-white text-center">Yakunlangan</th>
                            <th class="bg-primary text-white text-center">Bekor qilindi</th>
                            <th class="bg-primary text-white text-center">Kurrerlar soni</th>
                            <th class="bg-primary text-white text-center">Reyting</th>
                            <th class="bg-primary text-white text-center">Oxirgi yangilanish</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($Company as $item)
                        <tr>
                            <td class="text-center">{{ $loop->index+1 }}</td>
                            <td style="text-align:left"><a href="{{ route('superadmin_product_show', $item['id'] ) }}"><b>{{ $item['name'] }}</b> <i>({{ $item['status'] }})</i></a></td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>0</td>
                            <td>{{ $item['reyting'] }} ({{ $item['reyting_count'] }})</td>
                            <td style="text-align:right">{{ $item['updated_at'] }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-body">
            <form action="{{ route('superadmin_create') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <h3 class="w-100 text-center">Yangi ferma qo'shish</h3>
                <div class="row text-center">
                    <div class="col-lg-6">
                        <label for="name">Firma nomi</label>
                        <input type="text" name="name" class="form-control" required>
                        <label for="phone" class="mt-2">Telefon raqami</label>
                        <input type="text" name="phone" class="form-control" required>
                        <label for="addres" class="mt-2">Joylashgan manzili</label>
                        <input type="text" name="addres" class="form-control" required>
                    </div>
                    <div class="col-lg-6">
                        <label for="image">Firma logotipi</label>
                        <input type="file" name="image" class="form-control" required>
                        <label for="price" class="mt-2">Firma ish vaqti (08:00-20:00)</label>
                        <input type="text" name="price" class="form-control" required>
                        <label for="work_time" class="mt-2">Maxsulot narxi</label>
                        <input type="number" name="work_time" class="form-control" required>
                    </div>
                    <div class="col-12">
                        <label for="discriotion" class="mt-2">Firma mashuloti haqida</label>
                        <textarea name="discriotion" require class="form-control"></textarea>
                        <button class="btn btn-primary w-50 mt-2">Firmani saqlash</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#usersTable').DataTable({
                "paging": true,      // Pagination yoqish
                "searching": true,   // Qidiruv yoqish
                "ordering": true,    // Saralash yoqish
                "info": true,        // Sahifa ma'lumotlarini ko'rsatish
                "lengthMenu": [20, 50, 100, 500],  // Har bir sahifada nechta yozuv ko'rinishini tanlash
                "pageLength": 20     // Default bo'lib sahifada 10ta yozuvni ko'rsatish
            });
        });
    </script>
@endsection