<?
require_once 'config/config.php';
$usuarios = new Usuarios();
$cli = new Clientes();

$user = $usuarios->perfil();

if(isset($_GET['ver'])){ $ver = $_GET['ver']; }else{ $ver = ""; }
if(isset($_GET['opc'])){ $opc = $_GET['opc']; }else{ $opc = ""; }
if(isset($_GET['id'])){ $id = $_GET['id']; }else{ $id = 0; }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>TIENDA | VENTAS</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="css/AdminLTE.min.css">
    <link rel="stylesheet" type="text/css" href="plugins/datatables/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="plugins/datepicker/datepicker3.css">
    <link rel="stylesheet" type="text/css" href="plugins/datatables/jquery.dataTables.css">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="css/_all-skins.min.css">
    <link rel="apple-touch-icon" href="img/apple-touch-icon.png">
    <!-- jQuery 2.1.4 -->
    <script src="js/jQuery-2.1.4.min.js"></script>
    <script type="text/javascript" src="plugins/datatables/dataTables.bootstrap.js"></script>
    <script type="text/javascript" src="plugins/datatables/jquery.dataTables.js"></script>
     <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <!-- Logo -->
        <a href="inicio.php" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini"><b>P</b>TILLA</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>VENTAS</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="dist/img/user2-160x160.jpg" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=$user->nombres?>  <?=$user->apellidos?> </span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header">
              <img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">

                <p>
                  <?=$user->nombres?>  <?=$user->apellidos?>
                  <small><strong>Nacio el :</strong> <?=$user->fecha_nac?></small>
                
                 
                  <small><strong>Direccion :</strong> <?=$user->direccion?></small>
                </p>
              </li>
              <!-- Menu Body -->
              
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="?ver=usuarios&opc=ver&id=<?=$user->idpersona?>" class="btn btn-default btn-flat">Perfil</a>
                </div>
                <div class="pull-right">
                    <button id="logout" class="btn btn-flat btn-danger">Salir del sistema</button>
                </div>
              </li>
            </ul>
          </li>
              
              
            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <li class="header"></li>

            <li class="treeview">
              <a href="#">
                <i class="fa fa-users"></i>
                <span>Usuarios</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?ver=usuarios"><i class="fa fa-circle-o"></i>Ver Usuarios</a></li>
                <li><a href="?ver=usuarios&opc=add"><i class="fa fa-circle-o"></i>Agregar Usuario</a></li>
              </ul>
            </li>

             <li class="treeview">
              <a href="#">
                <i class="fa fa-hand-paper-o" aria-hidden="true"></i>

                <span>Productos</span>
                <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?ver=productos"><i class="fa fa-circle-o"></i>Ver Productos</a></li>
                <li><a href="?ver=productos&opc=add"><i class="fa fa-circle-o"></i>Agregar Productos</a></li>
                <li><a href="?ver=productos&opc=addCat"><i class="fa fa-circle-o"></i>Agregar Categoria</a></li>
              </ul>
            </li>
            
            
             <li>
              <a href="?ver=ventas">
                <i class="fa fa-plus-square"></i> <span>Ventas</span>
                <small class="label pull-right bg-green">VER</small>
              </a>
            </li>

             <li class="treeview">
              <a href="#">
                <i class="fa fa-user"></i>
                <span>Clientes</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="?ver=clientes&opc=add"><i class="fa fa-circle-o"></i>Agregar Clientes</a></li>
                <li><a href="?ver=clientes"><i class="fa fa-circle-o"></i>Ver Clientes</a></li>
              </ul>
            </li>
                       
           
             <li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Imprimir</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
  
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>

      <!--Contenido TODO LO DE EL MEDIO -->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">      
        <!-- Main content -->
      <?
        switch($ver){
          case 'usuarios':
            require_once 'views/usuarios.php';
          break;
          case 'ventas':
            require_once 'views/ventas.php';
          break;
          case 'clientes';
            require_once 'views/clientes.php';
          break;
          case 'productos';
            require_once 'views/productos.php';
          break;
          default:
      ?>
      <?php 
      $cantidad = $usuarios->CantUsu();
      $clientesCantidad = $cli->CantUsu();
      ?>
          <section class="content">
            <div class="row">
              <div class="col-lg-3 col-xs-6">
                <div class="info-box">
               
                  <!-- Apply any bg-* class to to the icon to color it -->
                  <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Usuarios</span>
                    
                    <span class="info-box-number"><h1 class="text-center"><?=$cantidad?></h1></span>
                     
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
               
              </div>

              <div class="col-lg-3 col-xs-6">
                <div class="info-box">
               
                  <!-- Apply any bg-* class to to the icon to color it -->
                  <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>
                  <div class="info-box-content">
                    <span class="info-box-text">Clientes</span>
                    
                    <span class="info-box-number"><h1 class="text-center"><?=$clientesCantidad?></h1></span>
                     
                  </div><!-- /.info-box-content -->
                </div><!-- /.info-box -->
               
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="box">
                  <div class="box-header with-border">
                    <h3 class="box-title">Sistema </h3>
                    <div class="box-tools pull-right">
                      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>  
                      <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                    </div>
                  </div>
                  <!-- /.box-header -->
                  <div class="box-body">
                    <div class="row">
                      <div class="col-md-12">
                          <!--Contenido-->
                          <div id="chartdiv"></div> 
                           
                           </div><!--Fin Contenido-->
                          
                        </div>        
                      </div>

                    </div><!-- /.row -->
                  </div><!-- /.box-body -->
                </div><!-- /.box -->
              <!--</div>
            </div>--><!-- /.row -->
          </section><!-- /.content -->
        <?
            break;
        }//Switch
        ?>

      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Version</b> 2.3.0
        </div>
        <strong>Copyright &copy; .</strong> Leandro Ochoa
      </footer>

      
    <!-- Bootstrap 3.3.5 -->
    <script src="js/bootstrap.min.js"></script>
    <!-- AdminLTE App -->
    <script src="js/app.min.js"></script>
    <script src="js/funciones.js"></script>
    <script src="plugins/datepicker/bootstrap-datepicker.js"></script>
  </body>

  <script >
     $('#datepicker').datepicker({
      autoclose: true,
      lenguage: 'es'
    });
  </script>
</html>

<!-- Styles -->
<style>
#chartdiv {
  width: 100%;
  height: 500px;
}

.amcharts-export-menu-top-right {
  top: 10px;
  right: 0;
}
</style>

<!-- Resources -->
<script src="https://www.amcharts.com/lib/3/amcharts.js"></script>
<script src="https://www.amcharts.com/lib/3/serial.js"></script>
<script src="https://www.amcharts.com/lib/3/plugins/export/export.min.js"></script>
<link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />
<script src="https://www.amcharts.com/lib/3/themes/light.js"></script>
<script
  src="http://code.jquery.com/ui/1.8.23/jquery-ui.js"
  integrity="sha256-lFA8dPmfmR4AQorTbla7C2W0aborhztLt0IQFLAVBTQ="
  crossorigin="anonymous"></script>

<!-- Chart code -->
<script>
var chart = AmCharts.makeChart("chartdiv", {
  "type": "serial",
  "theme": "light",
  "marginRight": 70,
  "dataProvider": [{
    "country": "Clientes",
    "visits": 5,
    "color": "#2033E1"
  }, {
    "country": "Usuarios",
    "visits": 2,
    "color": "#FF6600"
  }],
  "valueAxes": [{
    "axisAlpha": 0,
    "position": "left",
    "title": "Visitors from country"
  }],
  "startDuration": 1,
  "graphs": [{
    "balloonText": "<b>[[category]]: [[value]]</b>",
    "fillColorsField": "color",
    "fillAlphas": 0.9,
    "lineAlpha": 0.2,
    "type": "column",
    "valueField": "visits"
  }],
  "chartCursor": {
    "categoryBalloonEnabled": false,
    "cursorAlpha": 0,
    "zoomable": false
  },
  "categoryField": "country",
  "categoryAxis": {
    "gridPosition": "start",
    "labelRotation": 45
  },
  "export": {
    "enabled": true
  }

});
</script>

<!-- HTML -->

