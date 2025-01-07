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
        pageLength: 10,
        createdRow: function (row, data) {
            var price = parseFloat(data[3]);
            if (price > 0 && price <= 300) {
                $('td', row).eq(3).css('background-color', '#E6F7E6');
                $('td', row).eq(3).css('color', '#006400');
            } else if (price > 500 && price <= 1500) {
                $('td', row).eq(3).css('background-color', '#FFF9E6');
                $('td', row).eq(3).css('color', '#8B8000');
            } else if (price > 1500 && price <= 50000) {
                $('td', row).eq(3).css('background-color', '#FDEEE6');
                $('td', row).eq(3).css('color', '#A94400');
            }
            var stock = parseInt(data[4]);
            if (stock > 0 && stock <= 30) {
                $('td', row).eq(4).css('background-color', '#FEECEC');
                $('td', row).eq(4).css('color', '#8B0000');
            } else if (stock > 30 && stock <= 100) {
                $('td', row).eq(4).css('background-color', '#FFF9E6');
                $('td', row).eq(4).css('color', '#8B8000');
            } else if (stock > 100 && stock <= 1000) {
                $('td', row).eq(4).css('background-color', '#E6F7E6');
                $('td', row).eq(4).css('color', '#006400');
            }
        }
    });
    $('#filter-button').on('click', function () {
        let priceLow = 0, priceMid = 0, priceHigh = 0;
        let stockLow = 0, stockMid = 0, stockHigh = 0;

        table.rows().every(function () {
            var data = this.data();
            var price = parseFloat(data[3]);
            var stock = parseInt(data[4]);
            if (price > 0 && price <= 300) {
                priceLow++;
            } else if (price > 500 && price <= 1500) {
                priceMid++;
            } else if (price > 1500 && price <= 50000) {
                priceHigh++;
            }
            if (stock > 0 && stock <= 30) {
                stockLow++;
            } else if (stock > 30 && stock <= 100) {
                stockMid++;
            } else if (stock > 100 && stock <= 1000) {
                stockHigh++;
            }
        });
        $('#price-low').text(priceLow);
        $('#price-mid').text(priceMid);
        $('#price-high').text(priceHigh);
        $('#stock-low').text(stockLow);
        $('#stock-mid').text(stockMid);
        $('#stock-high').text(stockHigh);

        $('#filter-card').fadeIn();
    });
    $('#close-filter-card').on('click', function () {
        $('#filter-card').fadeOut();
    });
            <? php if ($success): ?>
        Swal.fire({
            icon: 'success',
            title: '¡Éxito!',
            text: '<?= $success ?>',
            confirmButtonText: 'Aceptar'
        });
            <? php endif; ?>

            <? php if ($error): ?>
        Swal.fire({
            icon: 'error',
            title: '¡Error!',
            text: '<?= $error ?>',
            confirmButtonText: 'Aceptar'
        });
            <? php endif; ?>
        });