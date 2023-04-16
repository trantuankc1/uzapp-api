@extends('admin::dashboard.base')
@section('title', 'Customer management')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3>Customer management</h3>
                <form class="form-inline" action="{{route('admin::users.search')}}" method="get">
                    <div class="form-group mx-sm-3">
                        <label for="customerId" class="sr-only">Customer ID</label>
                        <input type="text" class="form-control" name="customer_id" id="customerId" placeholder="Customer ID"
                               value="{{ old('customer_id') }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Search</button>
                </form>
            </div>
            <div class="sm-3 mt-4 d-flex justify-content-center">
                <a href="{{route('admin::users.exportCSV')}}" class="btn btn-danger">Download</a>
            </div>

            <div class="card-body">
                <table class="table table-striped table-bordered table-hover">
                    <thead style="text-align: center">
                    <tr>
                        <th scope="col">Customer ID</th>
                        <th scope="col">Customer name</th>
                        <th scope="col">Gender</th>
                        <th scope="col">Phone number</th>
                        <th scope="col">Birthday</th>
                        <th scope="col">Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $key => $item)
                        <tr style="text-align: center">
                            <td><a class="showDetail text-info text-decoration-underline cursor-pointer"
                                   href="{{ route('admin::product.edit', $item->id) }}">{{ $item->id }}</a></td>
                            <td>{{$item->person_name}}</td>
                            @switch($item->sex)
                                @case(\Modules\Admin\Constants\UserStatus::GENDER_MALE)
                                    <td>Male</td>
                                    @break
                                @case (\Modules\Admin\Constants\UserStatus::GENDER_FEMALE)
                                    <td>Female</td>
                                    @break
                                @case(\Modules\Admin\Constants\UserStatus::GENDER_OTHER)
                                    <td>Other</td>
                                    @break
                                @default
                                    <span>Other</span>
                            @endswitch
                            <td>{{$item->mobile_phone}}</td>
                            <td>{{date('d-m-Y', strtotime($item->birthday))}}</td>
                            <td>{{$item->email}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="d-flex justify-content-center">
                    {!! $users->links('pagination::bootstrap-4') !!}
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="detail_customer" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Customer Show</h5>
                    <button type="button" class="close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <table class="table table-striped table-bordered table-hover">
                        <thead style="text-align: center">
                        <tr>
                            <th scope="col">Customer ID</th>
                            <th scope="col" id="customer_id"></th>
                        </tr>
                        <tr>
                            <th scope="col">Customer Name</th>
                            <th scope="col" id="customer_name"></th>
                        </tr>
                        <tr>
                            <th scope="col">Gender</th>
                            <th scope="col" id="customer_gender"></th>
                        </tr>
                        <tr>
                            <th scope="col">Phone Number</th>
                            <th scope="col" id="customer_phone"></th>
                        </tr>
                        <tr>
                            <th scope="col">Birthday</th>
                            <th scope="col" id="customer_birthday"></th>
                        </tr>
                        <tr>
                            <th scope="col">Email</th>
                            <th scope="col" id="customer_email"></th>
                        </tr>
                        </thead>
                    </table>
                </div>

                <div class="modal-footer d-flex justify-content-center">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">
                        Cancer
                    </button>
                    <button type="button" id="button-edit" class="js-edit-customer btn btn-danger"
                            data-url-edit="{{route('admin::users.edit')}}">
                        Edit
                    </button>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('library-footer')
    <script>
        $(function () {
            $(document).on('click', '.js-show-customer', show);
            $(document).on('click', '.js-edit-customer', edit);
            $(document).on('click', '#button-update', updateCustomer);
        });

        function show() {
            const id = this.getAttribute('data-id');
            const url = this.getAttribute('data-url-show')

            $.ajax({
                url: url,
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {
                    "_token": "{{ csrf_token() }}",
                    'user_id': id
                },
                cache: false,
                success: function (data) {
                    const user = data.user;

                    let gender = '';
                    if (user.sex == 1) {
                        gender = 'Male';
                    } else if (user.sex == 2) {
                        gender = 'Female';
                    } else {
                        gender = 'Other';
                    }
                    date = new Date(user.birthday)

                    $('#customer_id,' +
                        '#customer_name,' +
                        '#customer_gender,' +
                        '#customer_phone,' +
                        '#customer_birthday,' +
                        '#customer_email').empty();

                    $('#customer_id').append(user.id);
                    $('#customer_name').append(user.person_name);
                    $('#customer_gender').append(gender);
                    $('#customer_phone').append(user.mobile_phone);

                    $('#customer_birthday').append(((date.getMonth() > 8) ?
                        (date.getMonth() + 1) : ('0' + (date.getMonth() + 1))) + '/' + ((date.getDate() > 9)
                        ? date.getDate() : ('0' + date.getDate())) + '/' + date.getFullYear());
                    $('#customer_email').append(user.email);

                    $('#button-edit').attr('data-id', user.id);
                },
                error: function (error) {
                    alert('Data does not exist!')
                }
            });
        }
    </script>
@endsection


