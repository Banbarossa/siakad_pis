
<div class="card" style="position: relative; left: 0px; top: 0px;">
    <div class="border-0 card-header ui-sortable-handle" style="cursor: move;">
        <h3 class="card-title">
            <i class="mr-1 fas fa-user-alt"></i>
            Data Status Siswa per Rombel
        </h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool btn-sm" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">
        <div class="canvas">
            {!!$grafik->container()!!}
        </div>
    </div>
    <div class="bg-transparent card-footer">
    </div>
    <script src="{{ $grafik->cdn() }}"></script>
    {{ $grafik->script() }}
</div>
