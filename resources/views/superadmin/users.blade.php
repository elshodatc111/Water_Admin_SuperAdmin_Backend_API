@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <div class="container-fluid px-5">
        <h4 class="w-100 text-center text-primary">Buyurtmachilar</h4>
        <table id="usersTable" class="table table-striped table-bordered">
            <thead >
                <tr>
                    <th class="bg-primary text-white text-center">#</th>
                    <th class="bg-primary text-white text-center">FIO</th>
                    <th class="bg-primary text-white text-center">Addres</th>
                    <th class="bg-primary text-white text-center">Phone</th>
                    <th class="bg-primary text-white text-center">Status</th>
                    <th class="bg-primary text-white text-center">Ro'yhatdan o'tdi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($User as $item)
                <tr>
                    <td class="text-center">{{ $loop->index+1 }}</td>
                    <td>{{ $item['name'] }}</td>
                    <td>{{ $item['addres'] }}</td>
                    <td class="text-center">{{ $item['phone'] }}</td>
                    <td class="text-center">{{ $item['status'] }}</td>
                    <td style="text-align:right">{{ $item['created_at'] }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
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