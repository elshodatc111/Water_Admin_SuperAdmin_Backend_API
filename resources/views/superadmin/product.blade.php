@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <div class="container-fluid px-5">
        <h4 class="w-100 text-center text-primary">Firmalar</h4>
        <table id="usersTable" class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="bg-primary text-white text-center">#</th>
                    <th class="bg-primary text-white text-center">Buyurtmachi</th>
                    <th class="bg-primary text-white text-center">Muyurtma manzili</th>
                    <th class="bg-primary text-white text-center">Buyurtma vaqti</th>
                    <th class="bg-primary text-white text-center">Firma nomi</th>
                    <th class="bg-primary text-white text-center">Buyurtma soni</th>
                    <th class="bg-primary text-white text-center">Buyurtma xolati</th>
                    <th class="bg-primary text-white text-center">Kurrer</th>
                    <th class="bg-primary text-white text-center">Oxirgi amaliyot</th>
                    <th class="bg-primary text-white text-center">Reyting</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>in</td>
                    <td>in</td>
                    <td>ss</td>
                    <td>in</td>
                    <td>in</td>
                    <td>6095</td>
                    <td>Moircy</td>
                    <td>2000/11/01</td>
                    <td>33%</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>in</td>
                    <td>in</td>
                    <td>in</td>
                    <td>ss</td>
                    <td>in</td>
                    <td>6095</td>
                    <td>Moircy</td>
                    <td>2000/11/01</td>
                    <td>33%</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>in</td>
                    <td>in</td>
                    <td>ss</td>
                    <td>in</td>
                    <td>in</td>
                    <td>6095</td>
                    <td>Moircy</td>
                    <td>2000/11/01</td>
                    <td>33%</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>in</td>
                    <td>in</td>
                    <td>ss</td>
                    <td>ss</td>
                    <td>in</td>
                    <td>6095</td>
                    <td>Moircy</td>
                    <td>2000/11/01</td>
                    <td>33%</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>in</td>
                    <td>in</td>
                    <td>in</td>
                    <td>in</td>
                    <td>ss</td>
                    <td>6095</td>
                    <td>Moircy</td>
                    <td>2000/11/01</td>
                    <td>33%</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>in</td>
                    <td>in</td>
                    <td>in</td>
                    <td>ss</td>
                    <td>in</td>
                    <td>6095</td>
                    <td>Moircy</td>
                    <td>2000/11/01</td>
                    <td>33%</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>in</td>
                    <td>in</td>
                    <td>ss</td>
                    <td>in</td>
                    <td>in</td>
                    <td>6095</td>
                    <td>Moircy</td>
                    <td>2000/11/01</td>
                    <td>33%</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>in</td>
                    <td>in</td>
                    <td>in</td>
                    <td>in</td>
                    <td>ss</td>
                    <td>6095</td>
                    <td>Moircy</td>
                    <td>2000/11/01</td>
                    <td>33%</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>in</td>
                    <td>in</td>
                    <td>in</td>
                    <td>in</td>
                    <td>ss</td>
                    <td>6095</td>
                    <td>Moircy</td>
                    <td>2000/11/01</td>
                    <td>33%</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>in</td>
                    <td>in</td>
                    <td>ss</td>
                    <td>in</td>
                    <td>in</td>
                    <td>6095</td>
                    <td>Moircy</td>
                    <td>2000/11/01</td>
                    <td>33%</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>in</td>
                    <td>in</td>
                    <td>in</td>
                    <td>in</td>
                    <td>6095</td>
                    <td>ss</td>
                    <td>Moircy</td>
                    <td>2000/11/01</td>
                    <td>33%</td>
                </tr>
                <tr>
                    <td>1</td>
                    <td>in</td>
                    <td>ss</td>
                    <td>in</td>
                    <td>in</td>
                    <td>in</td>
                    <td>6095</td>
                    <td>Moircy</td>
                    <td>2000/11/01</td>
                    <td>33%</td>
                </tr>
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