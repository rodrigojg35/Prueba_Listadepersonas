
var datos = document.getElementById("body");

sobreescribir();

function sobreescribir(){

    $.ajax({
        url: 'sobreescribir.php',
        type: 'POST',
        data: {},
        success: function(result){
            datos.innerHTML = `${result}`;          
            
            $(document).ready( function () {
                $('#tabla').DataTable({

                    responsive: "true",
                    dom: '<"top"fB>rt<"bottom"lip><"clear">',
                    buttons: [
                        {
                            extend: 'excel',
                            text: '<i class="fa-solid fa-file-csv"></i>',
                            TitleAttr: 'Exportar a Excel',
                            className: 'btn btn-success'
                            /*exportOptions: {
                                modifier: {
                                    page: 'current'
                                }
                            }*/
                        },
                        {
                            text: '<i class="fa-solid fa-envelope"></i>',
                            TitleAttr: 'Exportar y enviar por correo',
                            className: 'btn btn-primary',
                            action: function ( e, dt, node, config ) {      
                                enviarPorCorreo();
                            }
                            /*exportOptions: {
                                modifier: {
                                    page: 'current'
                                }
                            }*/
                        }     

                    ]

                });
                
                
                /*
                $('#tabla tbody').on( 'click', 'tr', function () {
                    console.log(datos.body[6][3]);
                } );
                */
                
            } );                     
        }
    });

}

function enviarPorCorreo(){
    var data = $('#tabla').DataTable().buttons.exportData();
    
    var header = data.header;
    var body = data.body[0];
    var filas = data.body.length;
    if(filas > 1){
        for(var i=1; i<filas; i++){
            body = body.concat(data.body[i]);
        }
    }
 
    $.ajax({
        url: 'enviarcorreo.php',
        type: 'POST',
        data: {header: JSON.stringify(header),body: JSON.stringify(body)},
        success: function(result){
            alert(`${result}`);
        }
    });
    

}



                            



                  

