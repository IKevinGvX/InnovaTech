$(document).ready(function () {
    var table = $('#productosTable').DataTable({
        responsive: true,
        language: {
            search: "Buscar:",
            lengthMenu: "Mostrar _MENU_ registros por página",
            info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
            paginate: {
                first: "Primero",
                last: "Último",
                next: "Siguiente",
                previous: "Anterior"
            }
        },
        paging: true,
        searching: true,
        pageLength: 10
    });


    $('#searchInput').on('keyup', function () {
        table.search(this.value).draw();
    });
});
