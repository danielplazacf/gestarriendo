<html>
<head>
    <script language="JavaScript">
 
    /* Determinamos el tiempo total en segundos */
    var totalTiempo=5;
    /* Determinamos la url donde redireccionar */
    var url="http://www.lawebdelprogramador.com";
 
    function updateReloj(){
        $('#CuentaAtras').html("Redireccionando en "+totalTiempo+" segundos");
 
        if(totalTiempo==0){
            window.location=url;
        }else{
            /* Restamos un segundo al tiempo restante */
            totalTiempo-=1;
            /* Ejecutamos nuevamente la función al pasar 1000 milisegundos (1 segundo) */
            setTimeout("updateReloj()",1000);
        }
    }
 
    window.onload=updateReloj;
 
    </script>
</head>
 
<body>
 
<h1>Cuenta atras para redireccionar</h1>
<h2 id='CuentaAtras'></h2>
 
</body>
</html>