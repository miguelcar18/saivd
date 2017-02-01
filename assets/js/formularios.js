//Para colocarle color a los input
$.validator.setDefaults({
    highlight: function(element) {
        $(element).closest('.form-group').removeClass('has-success has-feedback').addClass('has-error');
    },
    unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success has-feedback');
    },
    errorElement: 'span',
    errorClass: 'help-block',
    errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
            error.insertAfter(element.parent());
        } else {
            error.insertAfter(element);
        }
    }
});

$("form#loginForm").validate({
    rules: {
        usuario: {
            required: true
        },
        password: {
            required: true
        }
    },
    messages: {
        usuario: {
            required: "Ingrese un nombre de usuario"
        },
        password: {
            required: "Ingrese una contraseña"
        }
    },
    submitHandler: function () {
        $('div#result').html("<img src='assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({
            url:  $("form#loginForm").attr('action'),
            type: $("form#loginForm").attr('method'),
            data: $("form#loginForm").serialize(),
            success: function (html) {
                $('div#result').html(html);
            }
        });
        return false;
    }
});

$('#usuarioForm').validate({
	rules: {
        cedula: {
            required: true,
            number: true,
            min:1
        },
        nombre: {
            required: true
        },
        apellido: {
            required: true
        },
        cargo: {
            required: true,
        },
        fkdepartamento: {
            required: true
        },
        correo: {
            required: true,
            email: true
        },
        usuario: {
            required: true
        },
        password: {
            required: true
        },
        password_confirmar: {
            required: true,
            equalTo: "#password"
        },
        rol: {
            required: true,
        }
    },
    messages: {
        cedula: {
            required: 'Ingrese un número de cédula',
            number: 'Ingrese solo números',
            min: 'El número debe ser mayor a 0'
        },
        nombre: {
            required: 'Ingrese un nombre'
        },
        apellido: {
            required: 'Ingrese un apellido'
        },
        cargo: {
            required: 'Ingrese un cargo',
        },
        fkdepartamento: {
            required: 'Seleccione un departamento'
        },
        correo: {
            required: 'Ingrese un correo',
            email: 'Ingrese un correo válido'
        },
        usuario: {
            required: 'Ingrese un nombre de usuario'
        },
        password: {
            required: 'Ingrese una contraseña'
        },
        password_confirmar: {
            required: 'Repita la contraseña',
            equalTo: 'Las contraseñas deben de ser iguales'
        },
        rol: {
            required: 'Seleccione un rol de usuario',
        },
    },
    submitHandler: function () {
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({
            //url:  $("form#formUsuarios").attr('action'),
            type: $("form#usuarioForm").attr('method'),
            url: "/saivd/modulos/usuarios/crud.php?fun=c",
            data: $("form#usuarioForm").serialize(),
            success: function (html) {
                $('div#result').css("display", "block");
                //$('div#result').fadeOut(10000).html(html);
                $('div#result').html(html);
            }
        });
        return false;
    }
});

$('#usuarioEditForm').validate({
    rules: {
        cedula: {
            required: true,
            number: true,
            min:1
        },
        nombre: {
            required: true
        },
        apellido: {
            required: true
        },
        cargo: {
            required: true,
        },
        fkdepartamento: {
            required: true
        },
        correo: {
            required: true,
            email: true
        },
        usuario: {
            required: true
        },
        rol: {
            required: true,
        }
    },
    messages: {
        cedula: {
            required: 'Ingrese un número de cédula',
            number: 'Ingrese solo números',
            min: 'El número debe ser mayor a 0'
        },
        nombre: {
            required: 'Ingrese un nombre'
        },
        apellido: {
            required: 'Ingrese un apellido'
        },
        cargo: {
            required: 'Ingrese un cargo',
        },
        fkdepartamento: {
            required: 'Seleccione un departamento'
        },
        correo: {
            required: 'Ingrese un correo',
            email: 'Ingrese un correo válido'
        },
        usuario: {
            required: 'Ingrese un nombre de usuario'
        },
        rol: {
            required: 'Seleccione un rol de usuario',
        },
    },
    submitHandler: function () {
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({
            //url:  $("form#formUsuarios").attr('action'),
            type: $("form#usuarioEditForm").attr('method'),
            url: "/saivd/modulos/usuarios/crud.php?fun=u",
            data: $("form#usuarioEditForm").serialize(),
            success: function (html) {
                $('div#result').css("display", "block");
                //$('div#result').fadeOut(10000).html(html);
                $('div#result').html(html);
            }
        });
        return false;
    }
});

$(".usuarioEliminar").click(function() { 
    if(confirm("¿Está realmente seguro de eliminar este usuario?")) {
        var nroFila = $(this).attr("data-fila");
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({  
            type: "POST",
            url: "/saivd/modulos/usuarios/crud.php?fun=d",
            data: { id: $(this).attr("data-id") },
            success: function (respuesta) {
                $("#fila" + nroFila).remove();
                //$("div#result").fadeOut(10000).html(respuesta);
                $("div#result").html(respuesta);
            }
        });
    }

    return false;
});

$('#moduloDistribucionForm').validate({
    rules: {
        nombre: {
            required: true
        },
        nivel_mod: {
            required: true,
            number: true,
            min:1
        },
        archivos: {
            required: true,
        }
    },
    messages: {
        nombre: {
            required: 'Ingrese un nombre'
        },
        nivel_mod: {
            required: 'Ingrese un nivel',
            number: 'Ingrese solo números',
            min: 'El número debe ser mayor a 0'
        },
        archivos: {
            required: 'Ingrese al menos un archivo'
        },
    },
    submitHandler: function () {
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({
            //url:  $("form#formUsuarios").attr('action'),
            type: $("form#moduloDistribucionForm").attr('method'),
            url: "/saivd/modulos/modulos-distribucion/crud.php?fun=c",
            data: new FormData($("form#moduloDistribucionForm")[0]),
            processData: false,
            contentType: false,
            success: function (html) {
                $('div#result').css("display", "block");
                //$('div#result').fadeOut(10000).html(html);
                $('div#result').html(html);
            }
        });
        return false;
    }
});

$('#moduloDistribucionEditForm').validate({
    rules: {
        nombre: {
            required: true
        },
        nivel_mod: {
            required: true,
            number: true,
            min:1
        }
    },
    messages: {
        nombre: {
            required: 'Ingrese un nombre'
        },
        nivel_mod: {
            required: 'Ingrese un nivel',
            number: 'Ingrese solo números',
            min: 'El número debe ser mayor a 0'
        }
    },
    submitHandler: function () {
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({
            //url:  $("form#formUsuarios").attr('action'),
            type: $("form#moduloDistribucionEditForm").attr('method'),
            url: "/saivd/modulos/modulos-distribucion/crud.php?fun=u",
            data: new FormData($("form#moduloDistribucionEditForm")[0]),
            processData: false,
            contentType: false,
            success: function (html) {
                $('div#result').css("display", "block");
                //$('div#result').fadeOut(10000).html(html);
                $('div#result').html(html);
            }
        });
        return false;
    }
});

$(".moduloDistribucionEliminar").click(function() { 
    if(confirm("¿Está realmente seguro de eliminar este módulo? Los archivos de este módulo también serán eliminados")) {
        var nroFila = $(this).attr("data-fila");
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({  
            type: "POST",
            url: "/saivd/modulos/modulos-distribucion/crud.php?fun=d",
            data: { id: $(this).attr("data-id") },
            success: function (respuesta) {
                $("#fila" + nroFila).remove();
                //$("div#result").fadeOut(10000).html(respuesta);
                $("div#result").html(respuesta);
            }
        });
    }

    return false;
});

$('#moduloVentasForm').validate({
    rules: {
        nombre: {
            required: true
        },
        nivel_mod: {
            required: true,
            number: true,
            min:1
        },
        archivos: {
            required: true,
        }
    },
    messages: {
        nombre: {
            required: 'Ingrese un nombre'
        },
        nivel_mod: {
            required: 'Ingrese un nivel',
            number: 'Ingrese solo números',
            min: 'El número debe ser mayor a 0'
        },
        archivos: {
            required: 'Ingrese al menos un archivo'
        },
    },
    submitHandler: function () {
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({
            //url:  $("form#formUsuarios").attr('action'),
            type: $("form#moduloVentasForm").attr('method'),
            url: "/saivd/modulos/modulos-ventas/crud.php?fun=c",
            data: new FormData($("form#moduloVentasForm")[0]),
            processData: false,
            contentType: false,
            success: function (html) {
                $('div#result').css("display", "block");
                //$('div#result').fadeOut(10000).html(html);
                $('div#result').html(html);
            }
        });
        return false;
    }
});

$('#moduloVentasEditForm').validate({
    rules: {
        nombre: {
            required: true
        },
        nivel_mod: {
            required: true,
            number: true,
            min:1
        }
    },
    messages: {
        nombre: {
            required: 'Ingrese un nombre'
        },
        nivel_mod: {
            required: 'Ingrese un nivel',
            number: 'Ingrese solo números',
            min: 'El número debe ser mayor a 0'
        }
    },
    submitHandler: function () {
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({
            //url:  $("form#formUsuarios").attr('action'),
            type: $("form#moduloVentasEditForm").attr('method'),
            url: "/saivd/modulos/modulos-ventas/crud.php?fun=u",
            data: new FormData($("form#moduloVentasEditForm")[0]),
            processData: false,
            contentType: false,
            success: function (html) {
                $('div#result').css("display", "block");
                //$('div#result').fadeOut(10000).html(html);
                $('div#result').html(html);
            }
        });
        return false;
    }
});

$(".moduloVentasEliminar").click(function() { 
    if(confirm("¿Está realmente seguro de eliminar este módulo? Los archivos de este módulo también serán eliminados")) {
        var nroFila = $(this).attr("data-fila");
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({  
            type: "POST",
            url: "/saivd/modulos/modulos-ventas/crud.php?fun=d",
            data: { id: $(this).attr("data-id") },
            success: function (respuesta) {
                $("#fila" + nroFila).remove();
                //$("div#result").fadeOut(10000).html(respuesta);
                $("div#result").html(respuesta);
            }
        });
    }

    return false;
});

$('#moduloFranquiciasForm').validate({
    rules: {
        nombre: {
            required: true
        },
        nivel_mod: {
            required: true,
            number: true,
            min:1
        },
        archivos: {
            required: true,
        }
    },
    messages: {
        nombre: {
            required: 'Ingrese un nombre'
        },
        nivel_mod: {
            required: 'Ingrese un nivel',
            number: 'Ingrese solo números',
            min: 'El número debe ser mayor a 0'
        },
        archivos: {
            required: 'Ingrese al menos un archivo'
        },
    },
    submitHandler: function () {
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({
            //url:  $("form#formUsuarios").attr('action'),
            type: $("form#moduloFranquiciasForm").attr('method'),
            url: "/saivd/modulos/modulos-franquicias/crud.php?fun=c",
            data: new FormData($("form#moduloFranquiciasForm")[0]),
            processData: false,
            contentType: false,
            success: function (html) {
                $('div#result').css("display", "block");
                //$('div#result').fadeOut(10000).html(html);
                $('div#result').html(html);
            }
        });
        return false;
    }
});

$('#moduloFranquiciasEditForm').validate({
    rules: {
        nombre: {
            required: true
        },
        nivel_mod: {
            required: true,
            number: true,
            min:1
        }
    },
    messages: {
        nombre: {
            required: 'Ingrese un nombre'
        },
        nivel_mod: {
            required: 'Ingrese un nivel',
            number: 'Ingrese solo números',
            min: 'El número debe ser mayor a 0'
        }
    },
    submitHandler: function () {
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({
            //url:  $("form#formUsuarios").attr('action'),
            type: $("form#moduloFranquiciasEditForm").attr('method'),
            url: "/saivd/modulos/modulos-franquicias/crud.php?fun=u",
            data: new FormData($("form#moduloFranquiciasEditForm")[0]),
            processData: false,
            contentType: false,
            success: function (html) {
                $('div#result').css("display", "block");
                //$('div#result').fadeOut(10000).html(html);
                $('div#result').html(html);
            }
        });
        return false;
    }
});

$(".moduloFranquiciasEliminar").click(function() { 
    if(confirm("¿Está realmente seguro de eliminar este módulo? Los archivos de este módulo también serán eliminados")) {
        var nroFila = $(this).attr("data-fila");
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({  
            type: "POST",
            url: "/saivd/modulos/modulos-franquicias/crud.php?fun=d",
            data: { id: $(this).attr("data-id") },
            success: function (respuesta) {
                $("#fila" + nroFila).remove();
                //$("div#result").fadeOut(10000).html(respuesta);
                $("div#result").html(respuesta);
            }
        });
    }

    return false;
});

$('#moduloMercadeoForm').validate({
    rules: {
        nombre: {
            required: true
        },
        nivel_mod: {
            required: true,
            number: true,
            min:1
        },
        archivos: {
            required: true,
        }
    },
    messages: {
        nombre: {
            required: 'Ingrese un nombre'
        },
        nivel_mod: {
            required: 'Ingrese un nivel',
            number: 'Ingrese solo números',
            min: 'El número debe ser mayor a 0'
        },
        archivos: {
            required: 'Ingrese al menos un archivo'
        },
    },
    submitHandler: function () {
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({
            //url:  $("form#formUsuarios").attr('action'),
            type: $("form#moduloMercadeoForm").attr('method'),
            url: "/saivd/modulos/modulos-mercadeo/crud.php?fun=c",
            data: new FormData($("form#moduloMercadeoForm")[0]),
            processData: false,
            contentType: false,
            success: function (html) {
                $('div#result').css("display", "block");
                //$('div#result').fadeOut(10000).html(html);
                $('div#result').html(html);
            }
        });
        return false;
    }
});

$('#moduloMercadeoEditForm').validate({
    rules: {
        nombre: {
            required: true
        },
        nivel_mod: {
            required: true,
            number: true,
            min:1
        }
    },
    messages: {
        nombre: {
            required: 'Ingrese un nombre'
        },
        nivel_mod: {
            required: 'Ingrese un nivel',
            number: 'Ingrese solo números',
            min: 'El número debe ser mayor a 0'
        }
    },
    submitHandler: function () {
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({
            //url:  $("form#formUsuarios").attr('action'),
            type: $("form#moduloMercadeoEditForm").attr('method'),
            url: "/saivd/modulos/modulos-mercadeo/crud.php?fun=u",
            data: new FormData($("form#moduloMercadeoEditForm")[0]),
            processData: false,
            contentType: false,
            success: function (html) {
                $('div#result').css("display", "block");
                //$('div#result').fadeOut(10000).html(html);
                $('div#result').html(html);
            }
        });
        return false;
    }
});

$(".moduloMercadeoEliminar").click(function() { 
    if(confirm("¿Está realmente seguro de eliminar este módulo? Los archivos de este módulo también serán eliminados")) {
        var nroFila = $(this).attr("data-fila");
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({  
            type: "POST",
            url: "/saivd/modulos/modulos-mercadeo/crud.php?fun=d",
            data: { id: $(this).attr("data-id") },
            success: function (respuesta) {
                $("#fila" + nroFila).remove();
                //$("div#result").fadeOut(10000).html(respuesta);
                $("div#result").html(respuesta);
            }
        });
    }

    return false;
});

$('#rootwizard').bootstrapWizard({
    onNext: function(tab, navigation, index) {
        var $current = index+1;
        if(index==1)
        {
            // Make sure we entered the name
            if(!$('.respuesta1').is(':checked'))
            {
                alert('Debes seleccionar al menos una respuesta');
                //$('#respuesta1').focus();
                return false;
            }
        }
        if(index==2)
        {
            // Make sure we entered the name
            if(!$('.respuesta2').is(':checked'))
            {
                alert('Debes seleccionar al menos una respuesta');
                //$('#respuesta2').focus();
                return false;
            }
        }
        if(index==3)
        {
            // Make sure we entered the name
            if(!$('.respuesta3').is(':checked'))
            {
                alert('Debes seleccionar al menos una respuesta');
                //$('#respuesta3').focus();
                return false;
            }
        }
        if(index==4)
        {
            // Make sure we entered the name
            if(!$('.respuesta4').is(':checked'))
            {
                alert('Debes seleccionar al menos una respuesta');
                //$('#respuesta4').focus();
                return false;
            }
        }
        if(index==5)
        {
            // Make sure we entered the name
            if(!$('.respuesta5').is(':checked'))
            {
                alert('Debes seleccionar al menos una respuesta');
                //$('#respuesta5').focus();
                return false;
            }
        }
        if(index==6)
        {
            // Make sure we entered the name
            if(!$('.respuesta6').is(':checked'))
            {
                alert('Debes seleccionar al menos una respuesta');
                //$('#respuesta6').focus();
                return false;
            }
        }
        if(index==7)
        {
            // Make sure we entered the name
            if(!$('.respuesta7').is(':checked'))
            {
                alert('Debes seleccionar al menos una respuesta');
                //$('#respuesta7').focus();
                return false;
            }
        }
        if(index==8)
        {
            // Make sure we entered the name
            if(!$('.respuesta8').is(':checked'))
            {
                alert('Debes seleccionar al menos una respuesta');
                //$('#respuesta8').focus();
                return false;
            }
        }
        if(index==9)
        {
            // Make sure we entered the name
            if(!$('.respuesta9').is(':checked'))
            {
                alert('Debes seleccionar al menos una respuesta');
                //$('#respuesta9').focus();
                return false;
            }
        }
        if(index==10)
        {
            // Make sure we entered the name
            if(!$('.respuesta10').is(':checked'))
            {
                alert('Debes seleccionar al menos una respuesta');
                //$('#respuesta10').focus();
                return false;
            }
        }
    }, 
    onTabShow: function(tab, navigation, index) {
        var $total = navigation.find('li').length;
        var $current = index+1;
        var $percent = ($current/$total) * 100;
        $('#rootwizard').find('.bar').css({width:$percent+'%'});
    }
});
$('#rootwizard .finish').click(function(tab, navigation, index) {
    if(!$('.respuesta2').is(':checked') || ($(".respuesta10").length && !$('.respuesta10').is(':checked')))
    {
        alert('Debes seleccionar al menos una respuesta');
        //$('#respuesta2').focus();
        return false;
    }
    else
    {
        /*
        alert('Finished!, Starting over!');
        $('#rootwizard').find("a[href*='tab1']").trigger('click');
        */
        $("#rootwizard").submit();
    }
});

$('#dataTables-example').dataTable({
    language: {
        lengthMenu:         "Mostrar _MENU_ resultados por página",
        zeroRecords:        "Sin resultados",
        info:               "Mostrando página _PAGE_ de _PAGES_",
        infoEmpty:          "Sin ninguna información",
        infoFiltered:       "(Filtrado de _MAX_ resultados totales)",
        search:             "Buscar:",
        paginate: {
            "first":        "Primero",
            "last":         "Último",
            "next":         "Siguiente",
            "previous":     "Anterior"
        }
    }
});

function agregarValor()
{
    var tabla = document.getElementById("respuestasTabla").tBodies[0];
    var respuesta = document.getElementById("respuesta").value;
    var opcion = document.getElementById("opcion").value;
    var combo = document.getElementById("opcion");
    var selected = combo.options[combo.selectedIndex].text;

    if(respuesta == "")
    {
        alert("Ingrese una respuesta");
    }
    else if(opcion == "")
    {
        alert("Seleccione una opción");
    }
    else
    {
        var fila = tabla.insertRow(-1);
        var celda0 = fila.insertCell(0);
        var celda1 = fila.insertCell(1);
        var celda2 = fila.insertCell(2);

        celda0.innerHTML = '<input type="hidden" name="respuestaA[]" id="respuestaA[]" value="'+respuesta+'" />'+respuesta;
        celda1.innerHTML = '<input type="hidden" name="opcionA[]" id="opcionA[]" value="'+opcion+'" />'+selected;
        celda2.innerHTML = '<button type="button" onclick="eliminarFila(this)" class="btn btn-danger"><i class="fa fa-trash"></i></button>';
        document.getElementById("respuesta").value = "";
        document.getElementById("opcion").value = "";
    }
}

function eliminarFila(fila)
{
    var valor = fila.parentNode.previousSibling.previousSibling.childNodes[0].value;
    fila.parentNode.parentNode.remove();
}

$('#preguntaVentasForm').validate({
    rules: {
        pregunta: {
            required: true
        },
        tipo_respuesta: {
            required: true
        }
    },
    messages: {
        pregunta: {
            required: 'Ingrese una pregunta'
        },
        tipo_respuesta: {
            required: 'Seleccione un tipo de respuesta'
        }
    },
    submitHandler: function () {
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        var rows = document.getElementById('respuestasTabla').getElementsByTagName('tr').length;
        if(rows == 2)
        {
            alert("Debe de ingresar al menos una respuesta");
        }
        else
        {
            $.ajax({
                //url:  $("form#formUsuarios").attr('action'),
                type: $("form#preguntaVentasForm").attr('method'),
                url: "/saivd/modulos/test-ventas/crud.php?fun=c",
                data: new FormData($("form#preguntaVentasForm")[0]),
                processData: false,
                contentType: false,
                success: function (html) {
                    $('div#result').css("display", "block");
                    //$('div#result').fadeOut(10000).html(html);
                    $('div#result').html(html);
                }
            });
        }
        return false;
    }
});

$('#preguntaVentasEditForm').validate({
    rules: {
        pregunta: {
            required: true
        },
        tipo_respuesta: {
            required: true
        }
    },
    messages: {
        pregunta: {
            required: 'Ingrese una pregunta'
        },
        tipo_respuesta: {
            required: 'Seleccione un tipo de respuesta'
        }
    },
    submitHandler: function () {
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        var rows = document.getElementById('respuestasTabla').getElementsByTagName('tr').length;
        if(rows == 2)
        {
            alert("Debe de ingresar al menos una respuesta");
        }
        else
        {
            $.ajax({
                //url:  $("form#formUsuarios").attr('action'),
                type: $("form#preguntaVentasEditForm").attr('method'),
                url: "/saivd/modulos/test-ventas/crud.php?fun=u",
                data: new FormData($("form#preguntaVentasEditForm")[0]),
                processData: false,
                contentType: false,
                success: function (html) {
                    $('div#result').css("display", "block");
                    //$('div#result').fadeOut(10000).html(html);
                    $('div#result').html(html);
                }
            });
        }
        return false;
    }
});

$(".preguntaVentasEliminar").click(function() { 
    if(confirm("¿Está realmente seguro de eliminar esta pregunta? Las respuestas de esta pregunta también serán eliminadas")) {
        var nroFila = $(this).attr("data-fila");
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({  
            type: "POST",
            url: "/saivd/modulos/test-ventas/crud.php?fun=d",
            data: { id: $(this).attr("data-id") },
            success: function (respuesta) {
                $("#fila" + nroFila).remove();
                //$("div#result").fadeOut(10000).html(respuesta);
                $("div#result").html(respuesta);
            }
        });
    }

    return false;
});

$('#preguntaDistribucionForm').validate({
    rules: {
        pregunta: {
            required: true
        },
        tipo_respuesta: {
            required: true
        }
    },
    messages: {
        pregunta: {
            required: 'Ingrese una pregunta'
        },
        tipo_respuesta: {
            required: 'Seleccione un tipo de respuesta'
        }
    },
    submitHandler: function () {
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        var rows = document.getElementById('respuestasTabla').getElementsByTagName('tr').length;
        if(rows == 2)
        {
            alert("Debe de ingresar al menos una respuesta");
        }
        else
        {
            $.ajax({
                //url:  $("form#formUsuarios").attr('action'),
                type: $("form#preguntaDistribucionForm").attr('method'),
                url: "/saivd/modulos/test-distribucion/crud.php?fun=c",
                data: new FormData($("form#preguntaDistribucionForm")[0]),
                processData: false,
                contentType: false,
                success: function (html) {
                    $('div#result').css("display", "block");
                    //$('div#result').fadeOut(10000).html(html);
                    $('div#result').html(html);
                }
            });
        }
        return false;
    }
});

$('#preguntaDistribucionEditForm').validate({
    rules: {
        pregunta: {
            required: true
        },
        tipo_respuesta: {
            required: true
        }
    },
    messages: {
        pregunta: {
            required: 'Ingrese una pregunta'
        },
        tipo_respuesta: {
            required: 'Seleccione un tipo de respuesta'
        }
    },
    submitHandler: function () {
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        var rows = document.getElementById('respuestasTabla').getElementsByTagName('tr').length;
        if(rows == 2)
        {
            alert("Debe de ingresar al menos una respuesta");
        }
        else
        {
            $.ajax({
                //url:  $("form#formUsuarios").attr('action'),
                type: $("form#preguntaDistribucionEditForm").attr('method'),
                url: "/saivd/modulos/test-distribucion/crud.php?fun=u",
                data: new FormData($("form#preguntaDistribucionEditForm")[0]),
                processData: false,
                contentType: false,
                success: function (html) {
                    $('div#result').css("display", "block");
                    //$('div#result').fadeOut(10000).html(html);
                    $('div#result').html(html);
                }
            });
        }
        return false;
    }
});

$(".preguntaDistribucionEliminar").click(function() { 
    if(confirm("¿Está realmente seguro de eliminar esta pregunta? Las respuestas de esta pregunta también serán eliminadas")) {
        var nroFila = $(this).attr("data-fila");
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({  
            type: "POST",
            url: "/saivd/modulos/test-distribucion/crud.php?fun=d",
            data: { id: $(this).attr("data-id") },
            success: function (respuesta) {
                $("#fila" + nroFila).remove();
                //$("div#result").fadeOut(10000).html(respuesta);
                $("div#result").html(respuesta);
            }
        });
    }

    return false;
});

$('#preguntaFranquiciasForm').validate({
    rules: {
        pregunta: {
            required: true
        },
        tipo_respuesta: {
            required: true
        }
    },
    messages: {
        pregunta: {
            required: 'Ingrese una pregunta'
        },
        tipo_respuesta: {
            required: 'Seleccione un tipo de respuesta'
        }
    },
    submitHandler: function () {
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        var rows = document.getElementById('respuestasTabla').getElementsByTagName('tr').length;
        if(rows == 2)
        {
            alert("Debe de ingresar al menos una respuesta");
        }
        else
        {
            $.ajax({
                //url:  $("form#formUsuarios").attr('action'),
                type: $("form#preguntaFranquiciasForm").attr('method'),
                url: "/saivd/modulos/test-franquicias/crud.php?fun=c",
                data: new FormData($("form#preguntaFranquiciasForm")[0]),
                processData: false,
                contentType: false,
                success: function (html) {
                    $('div#result').css("display", "block");
                    //$('div#result').fadeOut(10000).html(html);
                    $('div#result').html(html);
                }
            });
        }
        return false;
    }
});

$('#preguntaFranquiciasEditForm').validate({
    rules: {
        pregunta: {
            required: true
        },
        tipo_respuesta: {
            required: true
        }
    },
    messages: {
        pregunta: {
            required: 'Ingrese una pregunta'
        },
        tipo_respuesta: {
            required: 'Seleccione un tipo de respuesta'
        }
    },
    submitHandler: function () {
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        var rows = document.getElementById('respuestasTabla').getElementsByTagName('tr').length;
        if(rows == 2)
        {
            alert("Debe de ingresar al menos una respuesta");
        }
        else
        {
            $.ajax({
                //url:  $("form#formUsuarios").attr('action'),
                type: $("form#preguntaFranquiciasEditForm").attr('method'),
                url: "/saivd/modulos/test-franquicias/crud.php?fun=u",
                data: new FormData($("form#preguntaFranquiciasEditForm")[0]),
                processData: false,
                contentType: false,
                success: function (html) {
                    $('div#result').css("display", "block");
                    //$('div#result').fadeOut(10000).html(html);
                    $('div#result').html(html);
                }
            });
        }
        return false;
    }
});

$(".preguntaFranquiciasEliminar").click(function() { 
    if(confirm("¿Está realmente seguro de eliminar esta pregunta? Las respuestas de esta pregunta también serán eliminadas")) {
        var nroFila = $(this).attr("data-fila");
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({  
            type: "POST",
            url: "/saivd/modulos/test-franquicias/crud.php?fun=d",
            data: { id: $(this).attr("data-id") },
            success: function (respuesta) {
                $("#fila" + nroFila).remove();
                //$("div#result").fadeOut(10000).html(respuesta);
                $("div#result").html(respuesta);
            }
        });
    }

    return false;
});

$('#preguntaMercadeoForm').validate({
    rules: {
        pregunta: {
            required: true
        },
        tipo_respuesta: {
            required: true
        }
    },
    messages: {
        pregunta: {
            required: 'Ingrese una pregunta'
        },
        tipo_respuesta: {
            required: 'Seleccione un tipo de respuesta'
        }
    },
    submitHandler: function () {
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        var rows = document.getElementById('respuestasTabla').getElementsByTagName('tr').length;
        if(rows == 2)
        {
            alert("Debe de ingresar al menos una respuesta");
        }
        else
        {
            $.ajax({
                //url:  $("form#formUsuarios").attr('action'),
                type: $("form#preguntaMercadeoForm").attr('method'),
                url: "/saivd/modulos/test-mercadeo/crud.php?fun=c",
                data: new FormData($("form#preguntaMercadeoForm")[0]),
                processData: false,
                contentType: false,
                success: function (html) {
                    $('div#result').css("display", "block");
                    //$('div#result').fadeOut(10000).html(html);
                    $('div#result').html(html);
                }
            });
        }
        return false;
    }
});

$('#preguntaMercadeoEditForm').validate({
    rules: {
        pregunta: {
            required: true
        },
        tipo_respuesta: {
            required: true
        }
    },
    messages: {
        pregunta: {
            required: 'Ingrese una pregunta'
        },
        tipo_respuesta: {
            required: 'Seleccione un tipo de respuesta'
        }
    },
    submitHandler: function () {
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        var rows = document.getElementById('respuestasTabla').getElementsByTagName('tr').length;
        if(rows == 2)
        {
            alert("Debe de ingresar al menos una respuesta");
        }
        else
        {
            $.ajax({
                //url:  $("form#formUsuarios").attr('action'),
                type: $("form#preguntaMercadeoEditForm").attr('method'),
                url: "/saivd/modulos/test-mercadeo/crud.php?fun=u",
                data: new FormData($("form#preguntaMercadeoEditForm")[0]),
                processData: false,
                contentType: false,
                success: function (html) {
                    $('div#result').css("display", "block");
                    //$('div#result').fadeOut(10000).html(html);
                    $('div#result').html(html);
                }
            });
        }
        return false;
    }
});

$(".preguntaMercadeoEliminar").click(function() { 
    if(confirm("¿Está realmente seguro de eliminar esta pregunta? Las respuestas de esta pregunta también serán eliminadas")) {
        var nroFila = $(this).attr("data-fila");
        $('div#result').html("<img src='../../assets/img/loading.gif' width='32px' height='32px'/>");
        $.ajax({  
            type: "POST",
            url: "/saivd/modulos/test-mercadeo/crud.php?fun=d",
            data: { id: $(this).attr("data-id") },
            success: function (respuesta) {
                $("#fila" + nroFila).remove();
                //$("div#result").fadeOut(10000).html(respuesta);
                $("div#result").html(respuesta);
            }
        });
    }

    return false;
});

$(".consultaDistribucion").click(function (e) { 
    e.preventDefault();
    $.ajax({  
        type: "POST",
        url: "/saivd/modulos/distribucion/estadisticabd.php",
        data: { id: $(this).attr("data-id") },
        success: function (respuesta) {
            $("#resultadosEstadisticas").empty();
            $("#resultadosEstadisticas").html(respuesta);
        }
    });

    return false;
});
$(".consultaVentas").click(function (e) { 
    e.preventDefault();
    $.ajax({  
        type: "POST",
        url: "/saivd/modulos/ventas/estadisticabd.php",
        data: str,
        success: function (respuesta) {
            $("#resultadosEstadisticas").empty();
            $("#resultadosEstadisticas").html(respuesta);
        }
    });

    return false;
});
$(".consultaFranquicias").click(function (e) { 
    e.preventDefault();
    $.ajax({  
        type: "POST",
        url: "/saivd/modulos/franquicias/estadisticabd.php",
        data: str,
        success: function (respuesta) {
            $("#resultadosEstadisticas").empty();
            $("#resultadosEstadisticas").html(respuesta);
        }
    });

    return false;
});
$(".consultaMercadeo").click(function (e) { 
    e.preventDefault();
    $.ajax({  
        type: "POST",
        url: "/saivd/modulos/mercadeo/estadisticabd.php",
        data: str,
        success: function (respuesta) {
            $("#resultadosEstadisticas").empty();
            $("#resultadosEstadisticas").html(respuesta);
        }
    });

    return false;
});