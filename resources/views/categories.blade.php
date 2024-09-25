@component('admin.layouts.content', ['title' => 'بخش دسته بندی ها'])
    @slot('breadcrumb')
        <li class="breadcrumb-item"><a href="/admin">پنل مدیریت</a></li>
        <li class="breadcrumb-item active">دسته بندی ها</li>
    @endslot

    @slot('head')
        <style>
            li.list-group-item>ul.list-group {
                margin-top: 30px;
            }
        </style>
    @endslot

    <div class="row mt-3">
        <div class="col-12">
            <div class="card">
                <div class="card-header  d-flex justify-content-end align-items-baseline">
                    <form>
                        <div class="card-tools">
                            <div class="input-group input-group-sm ">
                                <input type="text" name="search" class="form-control float-right" placeholder="جستجو"
                                    value="{{ request('search') }}">

                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-default"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>

                    @can('create-category')
                        <div class="m-1">
                            <a class="bg-success p-2 rounded" href="{{ route('categories.create') }}">ایجاد دسته بندی جدید</a>
                        </div>
                    @endcan
                </div>
                <!-- /.card-header -->
                <div class="card-body table-responsive p-0">
                    @include('admin.layouts.categories-group', ['categories' => $categories])
                </div>
                <!-- /.card-body -->

                {{ $categories->links('vendor.pagination.bootstrap-5') }}
            </div>
            <!-- /.card -->
        </div>
    </div><!-- /.row -->
@endcomponent
