<div class="row mb-4">
    <div class="col">
        <div class="card">
            <div class="card-header">
                <h3>Couleurs des voitures</h3>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-4">
        <form action="<?= base_url('/admin/car/createcolor') ?>" method="POST">
            <div class="card">
            <div class="card-header">
                <h5>Ajouter une couleur</h5>
            </div>
                <div class="card-body">
                    <label class="form-label">Nom de la couleur</label>
                    <input type="text" class="form-control" name="name">
                        <button type="submit" class="btn btn-primary mt-3">Valider</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h5>Liste des marques</h5>
            </div>
            <div class="card-body">
                <table class="table table-sm table-hover" id="tableColor">
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
<script>
    $(document).ready(function (){
    var baseUrl = "<?= base_url() ?>";
    var dataTable = $('#tableColor').DataTable({
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
            "data" : { 'model' : 'ColorModel'}
        },
        "columns": [
            {"data": "id"},
            {"data": "name"},
            {
                data : 'id',
                sortable : false,
                render : function(data) {
                    return `<a href="${baseUrl}admin/car/color/${data}"><i class="fa-solid fa-pencil"></i></a>`;
                }
            },
            {
                data : 'id',
                sortable : false,
                render : function(data) {
                    return `<a class="swal2-type" id="${data}" href="<?= base_url('/admin/color/deletecolor/');?>${data}"><i class="fa-solid fa-trash text-danger"></i></a>`;
                }
            }
            ]
        });
    });
</script>