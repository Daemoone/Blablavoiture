<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h4>Liste des voitures</h4>
    </div>
    <div class="card-body">
        <table class="table table-sm table-hover" id="tableCar">
            <thead>
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Model</th>
                <th>Color</th>
                <th>Brand</th>
                <th>update</th>
                <th>delete</th>
            </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>
</div>
<script>
    $(document).ready(function () {
        var baseUrl = "<?= base_url(); ?>";
        var dataTable = $('#tableCar').DataTable({
            "responsive": true,
            "processing": true,
            "serverSide": true,
            "pageLength": 10,
            "language": {
                url: baseUrl + 'js/datatable/datatable-2.1.4-fr-FR.json',
            },
            "ajax": {
                "url": baseUrl + "admin/car/searchdatatable",
                "type": "POST",
                "data" : { 'model' : 'CarModel'}
            },
            "columns": [
                {"data": "id"},
                {
                    data : 'username',
                    sortable : false,
                    render : function(data, type, row) {
                        return `<a class="link-underline link-underline-opacity-0" href="${baseUrl}admin/user/${row.id_user}">${row.username}</a>`;
                    }
                },
                {"data": "model"},
                {"data": "color"},
                {"data": "brand"},
                {
                    data : 'id',
                    sortable : false,
                    render : function(data) {
                        return `<a href="${baseUrl}admin/car/updatecar/${data}"><i class="fa-solid fa-pencil"></i></a>`;
                    }
                },
                {
                    data : 'id',
                    sortable : false,
                    render : function(data) {
                        return `<a href="${baseUrl}/admin/car/deletecar/${data}"><i class="fa-solid fa-trash text-danger"></i></a>`;
                    }
                },
            ]
        });
    });
</script>