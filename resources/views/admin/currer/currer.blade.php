@extends('layouts.app_admin')

@section('content')
    <div class="container">
        <div class="justify-content-center">
            <div class="card">        
                @if(session('success'))
                    <p class="w-100 p-3 bg-success text-white text-center">{{ session('success') }}</p>
                @endif
                <div class="card-header">Kurrerlar</div>
                <div class="card-body">
                    <table class="table table-bordered text-center">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>FIO</th>
                                <th>Telefon raqam</th>
                                <th>Reyting</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>2</td>
                                <td>3</td>
                                <td>4</td>
                                <td>4</td>
                            </tr>
                            <tr>
                                <td colspan=5 class="text-center">Kurrerlar mavjud emas.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <br>
            <div class="card">
                <div class="card-header">Yangi kurrer qo'shish</div>
                <div class="card-body">
                    <form action="{{ route('currer_create') }}" method="post">
                        @csrf 
                        <div class="row">
                            <div class="col-lg-6">
                                <label for="name" class="mt-3">FIO</label>
                                <input type="text" name="name" class="form-control" required>
                                <label for="phone" class="mt-3">Telefon raqam</label>
                                <input type="text" name="phone" class="form-control" required>
                            </div>
                            <div class="col-lg-6">
                                <label for="addres" class="mt-3">Yashash manzili</label>
                                <input type="text" name="addres" class="form-control" required>
                                <label for="email" class="mt-3">Email adress</label>
                                <input type="text" name="email" class="form-control" required>
                            </div>
                            <div class="col-12 text-center"><button class="btn btn-primary w-50 mt-3">Saqlash</button></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection