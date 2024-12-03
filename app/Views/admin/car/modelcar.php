<div class="row mb-4">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3>Modèles</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <form action="<?= base_url('/admin/car/createmodelcar') ?>" method="POST">
            <div class="card">
                <div class="card-header">
                    <h5>Ajouter un modèle</h5>
                </div>
                <div class="card-body">
                    <label class="form-label">Nom du modèle</label>
                    <input type="text" class="form-control" name="name">
                    <button type="submit" class="btn btn-primary mt-3">Valider</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Liste des modèles</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm table-hover" id="tableModelCar">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nom</th>
                        <th>Modif.</th>
                        <th>Supp.</th>
                    </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
            <div class="card-footer">

            </div>
        </div>
    </div>
</div>
<div class="modal" tabindex="-1" id="modalModelCar">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Modifier le modèle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="<?= base_url('/admin/car/updatemodelcar'); ?>" id="formModal">
                <div class="modal-body">
                    <input type="hidden" name="id" value="">
                    <input type="text" name="name" class="form-control">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <input type="submit" class="btn btn-primary" value="Valider">
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function (){
        const modalType = new bootstrap.Modal('#modalModelCar')
        var baseUrl = "<?= base_url() ?>";
        var dataTable = $('#tableModelCar').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "language": {
                url: '<?= base_url("/js/datatable/datatable-2.1.4-fr-FR.json") ?>',
            },
            "ajax": {
                "url": "<?= base_url('/admin/car/searchdatatable'); ?>",
                "type": "POST",
                "data" : { 'model' : 'ModelCarModel'}
            },
            "columns": [
                {"data": "id"},
                {"data": "name"},
                {
                    data : 'id',
                    sortable : false,
                    render : function(data) {
                        return `<a class="swal2-modelcar-update" id="${data}" href="<?= base_url('/admin/car/updatemodelcar/');?>${data}"><i class="fa-solid fa-pencil text-success"></i></a>`;
                    }
                },
                {
                    data : 'id',
                    sortable : false,
                    render : function(data) {
                        return `<a class="swal2-modelcar" id="${data}" href="<?= base_url('/admin/car/deletemodelcar/');?>${data}"><i class="fa-solid fa-trash text-danger"></i></a>`;
                    }
                }
            ]
        });

        //event de mise à jour
        $("body").on('click', '.swal2-modelcar-update', function(event) {
            event.preventDefault();
            modalType.show();
            let id_modelcar = $(this).attr('id');
            let name = $(this).closest('tr').find(".name-modelcar").html();
            $('.modal input[name="id"]').val(id_modelcar);
            $('.modal input[name="name"]').val(name);
        });
    });
</script>
