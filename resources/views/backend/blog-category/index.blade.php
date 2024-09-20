@extends('backend.layouts.app')

@section('style')
    <link href="{{ asset('assets/backend/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">{{ $title ?? '' }}</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="{{ asset('#') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
                    <a class="breadcrumb-item" href="">{{ $title ?? '' }}</a>
                    <span class="breadcrumb-item active">{{ $subtitle ?? '' }}</span>
                </nav>
            </div>
        </div>
        @include('backend.components.message')
        <div class="card">
            <div class="card-body">
                <div class="row m-b-30">
                    <div class="col-lg-8">
                        <div class="d-md-flex">
                            <div class="m-b-10 m-r-15">
                                <select class="custom-select" style="min-width: 180px;">
                                    <option selected>Catergory</option>
                                    <option value="all">All</option>
                                    <option value="homeDeco">Home Decoration</option>
                                    <option value="eletronic">Eletronic</option>
                                    <option value="jewellery">Jewellery</option>
                                </select>
                            </div>
                            <div class="m-b-10">
                                <select name="status" class="custom-select" style="min-width: 180px;">
                                    <option selected>Status</option>
                                    <option value="0">Inactive</option>
                                    <option value="1">Active</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-right">
                        <button id="updateStatus" class="btn btn-secondary ">
                            <i class="anticon anticon-sync"></i>
                            <span>Cập nhật trạng thái</span>
                        </button>
                        <a href="{{ route('admin.blog-categories.create') }}" class="btn btn-primary">
                            <i class="anticon anticon-plus-circle m-r-5"></i>
                            <span>Thêm mới</span>
                        </a>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover e-commerce-table">
                        <thead>
                        <tr>
                            <th>
                                <div class="checkbox">
                                    <input id="checkAll" type="checkbox">
                                    <label for="checkAll" class="m-b-0"></label>
                                </div>
                            </th>
                            <th>ID</th>
                            <th>Tên danh mục</th>
                            <th>Hình ảnh</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhât</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($blogs as $item)
                            <tr>
                                <td>
                                    <div class="checkbox ">
                                        <input class="category-checkbox" value="{{ $item->id }}" id="check-item-1"
                                               type="checkbox">
                                        <label for="check-item-1" class="m-b-0"></label>
                                    </div>
                                </td>
                                <td>
                                    {{$item->id}}
                                </td>
                                <td>
                                    <h6 class="m-b-0 m-l-10">{{ $item->name }}</h6>
                                </td>
                                <td>
                                    @if(!empty($item->image))
                                        <img style="width: 200px;" src="{{ Storage::url($item->image) }}">
                                    @else
                                        'Đang cập nhật...'
                                    @endif
                                </td>
                                <td>
                                    {!!   $item->status ?
                                        '<span class="badge badge-success">Hoạt động</span>' :
                                        '<span class="badge badge-danger">Không hoạt động</span>' !!}
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>

                                <td class="text-right">

                                    <a href="{{ route('admin.blog-categories.edit', $item->id) }}"
                                       class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                        <i class="anticon anticon-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.blog-categories.destroy', $item->id) }}"
                                       class="btn btn-icon btn-hover btn-sm btn-rounded sweet-confirm">
                                        <i class="anticon anticon-delete"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/backend/vendors/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/backend/vendors/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/backend/js/pages/e-commerce-order-list.js')}}"></script>
    <script !src="">

        document.getElementById('updateStatus').addEventListener('click', function () {
            const selectedIds = Array.from(document.querySelectorAll('.category-checkbox:checked')).map(checkbox => checkbox.value);

            console.log(selectedIds);

            if (selectedIds.length === 0) {
                alert('Please select at least one category.');
                return;
            }

            // Get selected status
            const status = document.querySelector('select[name="status"]').value;
            if (status === 'Status') {
                alert('Please select a status.');
                return;
            }

            // Send AJAX request to update status
            fetch('{{ route('admin.categories.updateStatus') }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ ids: selectedIds, status: status })
            })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Failed to update status.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
        });
    </script>
@endsection
