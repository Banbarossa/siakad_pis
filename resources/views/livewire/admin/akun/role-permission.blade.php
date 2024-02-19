<div class="content">
    @slot('title')
        <h1 class="font-weight-bold">Role Permission</h1>
    @endslot


    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="px-3 py-2 widget-user-header bg-warning">
                    <h3 class="widget-user-username">Role : <strong>{{ $role->name }}</strong></h3>
                </div>
                <div class="card-body">

                    <div class="">
                        <h5>Role Ini Memiliki Akses sebagai Berikut:</h5>
                    </div>


                    <ul class="nav flex-column">
                        @forelse($role->permissions as $permission)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $permission->name }}
                            <span ><button class="btn btn-sm btn-warning" wire:confirm='Apakah Yakin Untuk nonaktikan hak akses dari role {{ $role->name }}' wire:click='removePermission({{ $permission->id }})'><i class="fas fa-toggle-off"></i>Non Aktifkan</button></span>
                        </li>
                        @empty
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Tidak Ada Data Permission yang ditemukan
                        </li>
                        @endforelse
                        
                    </ul>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6">
            <div class="card">
                <div class="px-3 py-2 widget-user-header bg-warning">
                    <h3 class="widget-user-username">Role : <strong>{{ $role->name }}</strong></h3>
                </div>
                <div class="card-body">
                    <div class="">
                        <h5>Tambahkan Hak Akses untuk role {{ $role->admin }}</h5>
                    </div>
                    <form action="" wire:submit.prevent='addPermissionToRole'>
                    <ul class="nav flex-column">
                        @forelse($permissions as $item)
                        <li class="list-group-item ">
                            <div class="form-check">
                                <input class="mr-4 form-control-input" type="checkbox" value="{{ $item->id }}"
                                    wire:model.live='selectedPermission' id="role-{{ $item->id }}">
                                <label class="form-check-label" for="role-{{ $item->id }}">
                                    {{ $item->name }}
                                </label>
                            </div>
                        </li>
                        @empty
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Tidak Ada Data Permission yang ditemukan
                        </li>
                        @endforelse
                        
                    </ul>

                    <div class="mt-4">
                        <button class="btn btn-primary" type="submit">Submit</button>
                    </div>
                    </form>
                </div>
            </div>
           
        </div>


    </div>
</div>
