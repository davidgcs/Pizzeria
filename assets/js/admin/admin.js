/**
 * Created by duni on 13/06/17.
 */
$(document).ready(function() {
    $(document).ready(function () {
        var data = [
            { 'Nombre': 'Duni', 'E-Mail': 'duni@kk.kk', 'Alias' : 'duni', 'Acción' : 'kk' },
            { 'Nombre': 'Pepe', 'E-Mail': 'pepe@pp.p', 'Alias' : 'ppp', 'Acción' : 'kk' },
            { 'Nombre': 'Pepe', 'E-Mail': 'pepe@pp.p', 'Alias' : 'ppp', 'Acción' : 'kk' },
            { 'Nombre': 'Pepe', 'E-Mail': 'pepe@pp.p', 'Alias' : 'ppp', 'Acción' : 'kk' },
            { 'Nombre': 'Hristo Stoichkov', 'E-Mail': 'Plovdiv, Bulgaria', 'Alias' : 'alias', 'Acción' : 'kk' }
        ];

        var grid = $('#grid').grid({
            dataSource: data,
            columns: [
                { field: 'Nombre', width: 100 },
                { field: 'E-Mail', sortable: true },
                { field: 'Alias', title: 'Alias', sortable: true },
                { field: 'Accion', title: 'Accion', width: 120 }
            ],
            pager: { limit: 5 }
        });
    });

});