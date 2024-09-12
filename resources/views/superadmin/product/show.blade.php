@extends('layouts.app')

@section('content')
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <div class="container-fluid px-5">
        @if(session('success'))
            <p>{{ session('success') }}</p>
        @endif
        <div class="row">
            <div class="col-lg-12 mt-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title w-100 text-center">Firma haqida malumot</h5>
                        <div class="w-100 text-center row">
                            <div class="col-lg-6">
                                <img src="./../../images/{{ $Company['logo'] }}" class="w-50" style='border:3px solid red'>
                            </div>
                            <div class="col-lg-6">
                                <h2 class="text-center"><i class="bi bi-star"></i> {{ $Company['reyting'] }} ({{ $Company['reyting_count'] }})</h2>
                                <form action="{{ route('superadmin_product_image_update') }}" method="post" enctype="multipart/form-data">
                                    @csrf 
                                    <input type="hidden" value="{{ $Company['id'] }}" name="id">
                                    <label for="image" class="mt-2">Firma yangi rasmini tanlang</label>
                                    <input type="file" name="image" class="form-control mt-2" required>
                                    <button class="btn btn-primary w-100 mt-3">Rasmni yangilash</button>
                                </form>
                            </div>
                        </div>
                        <div class="card p-3 mt-3">
                            <form action="{{ route('superadmin_product_form_update') }}" method="post">
                                @csrf 
                                <input type="hidden" value="{{ $Company['id'] }}" name="id">
                                <div class="row">
                                    <div class="col-6">
                                        <label for="name" class="mt-2">Firma nomi</label>
                                        <input type="text" name="name" value="{{ $Company['name'] }}" class="form-control" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="status" class="mt-2">Status</label>
                                        <input type="text" name="status" value="{{ $Company['status'] }}" class="form-control" required>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-6">
                                        <label for="phone" class="mt-2">Telefon raqami</label>
                                        <input type="text" name="phone" value="{{ $Company['phone'] }}" class="form-control" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="addres" class="mt-2">Firma manzili</label>
                                        <input type="text" name="addres" value="{{ $Company['addres'] }}" class="form-control" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <label for="price" class="mt-2">Xizmat narxi</label>
                                        <input type="text" name="price" value="{{ $Company['price'] }}" class="form-control" required>
                                    </div>
                                    <div class="col-6">
                                        <label for="work_time" class="mt-2">Ish vaqti</label>
                                        <input type="text" name="work_time" value="{{ $Company['work_time'] }}" class="form-control" required>
                                    </div>
                                </div>
                                <label for="discriotion" class="mt-2">Firma maxsulotlari haqida</label>
                                <textarea name="discriotion" class="form-control">{{ $Company['discriotion'] }}</textarea>
                                <div class="w-100 text-center">
                                    <button class="btn btn-primary w-50 mt-2">O'zgarishlarni saqlash</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title w-100 text-center">Xizmat ko'rsatish hududi</h5>
                        <table class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th class="bg-primary text-white text-center">#</th>
                                    <th class="bg-primary text-white text-center">Xizmat ko'rsatish hududi</th>
                                    <th class="bg-primary text-white text-center">Xizmat boshlangan vaqt</th>
                                    <th class="bg-primary text-white text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @forelse($Product as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item['town'] }}</td>
                                    <td>{{ $item['created_at'] }}</td>
                                    <td>
                                        <form action="{{ route('superadmin_product_delete') }}" method="post">
                                            @csrf  
                                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                                            <button type='submit' class="btn btn-danger p-0 px-1"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan=4>Hududlar mavjud emas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <hr>
                        <form action="{{ route('superadmin_product_new_addres') }}" method="post" class="row">
                            @csrf 
                            <input type="hidden" value="{{ $Company['id'] }}" name="company_id">
                            <h5 class="card-title w-100 text-center">Yangi hudud qo'shish</h5>
                            <div class="col-6">
                                <select name="town" class="form-control">
                                    <option value="town">Tanlang</option>
                                    <option value="Yakkabog' tumani">Yakkabog' tumani</option>
                                    <option value="Qarshi tumani">Qarshi tumani</option>
                                    <option value="Qarshi shahri">Qarshi shahri</option>
                                </select>
                            </div>
                            <div class="col-6">
                                <button type="submit" class="btn btn-primary w-100">Hududni saqlash</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-12 mt-2">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title w-100 text-center">Firma drektorlari</h5>
                        <table class="table table-striped table-bordered text-center">
                            <thead>
                                <tr>
                                    <th class="bg-primary text-white text-center">#</th>
                                    <th class="bg-primary text-white text-center">Drektor FIO</th>
                                    <th class="bg-primary text-white text-center">Telefon raqam</th>
                                    <th class="bg-primary text-white text-center">Yashash manzili</th>
                                    <th class="bg-primary text-white text-center">Login</th>
                                    <th class="bg-primary text-white text-center">Status</th>
                                    <th class="bg-primary text-white text-center">Status</th>
                                </tr>
                            </thead>
                            <tbody> 
                                @forelse($User as $item)
                                <tr>
                                    <td>{{ $loop->index+1 }}</td>
                                    <td>{{ $item['name'] }}</td>
                                    <td>{{ $item['phone'] }}</td>
                                    <td>{{ $item['addres'] }}</td>
                                    <td>{{ $item['email'] }}</td>
                                    <td>{{ $item['created_at'] }}</td>
                                    <td>
                                        <form action="{{ route('superadmin_product_create_delete') }}" method="post" style="display:inline">
                                            @csrf  
                                            <input type="hidden" name="id" value="{{ $item['id'] }}">
                                            <button class="btn btn-danger p-0 px-1"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </td>
                                </tr>
                                @empty
                                    <tr>
                                        <td class="text-center" colspan=7>Admin mavjud emas.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        <hr>
                        <form action="{{ route('superadmin_product_create_admin') }}" method="post" class="row">
                            @csrf 
                            <input type="hidden" name="company_id" value="{{ $Company['id'] }}">
                            <h5 class="card-title w-100 text-center">Yangi drektor qo'shish</h5>
                            <div class="col-lg-6">
                                <label for="name">Drektor FIO</label>
                                <input type="text" name="name" class="form-control" required>
                                <label for="phone" class="mt-2">Telefon raqami</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="addres">Yashash manzili</label>
                                <input type="text" name="addres" class="form-control" required>
                                <label for="email" class="mt-2">Login(email)</label>
                                <input type="text" name="email" class="form-control" required>
                            </div>
                            <div class="col-12 text-center">
                                <button class="btn btn-primary w-100 mt-2" type="submit">Drektorni saqlash</button>
                            </div>
                        </form>
                    </div>
                </div>
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