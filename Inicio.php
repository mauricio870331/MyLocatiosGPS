<?php
session_start();
require_once './Clases/BD.class.php';
$con = new BD("localhost", "test", "root", "PpY8lfp838Et3716");
$resultado = $con->findAll2("SELECT * FROM dispositivos_usuario "
        . "WHERE documento = '" . $_SESSION['obj_user'][0]['documento'] . "'");

$rs = $con->findAll2("select foto from usuarios where documento ='" . $_SESSION['obj_user'][0]['documento'] . "'");
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta charset="utf-8" />
        <title>Inicio</title>
        <meta name="description" content="" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
        <!-- bootstrap & fontawesome -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
        <link rel="stylesheet" href="assets/font-awesome/4.5.0/css/font-awesome.min.css" />
        <!-- page specific plugin styles -->
        <!-- text fonts -->
        <link rel="stylesheet" href="assets/css/fonts.googleapis.com.css" />
        <!-- ace styles -->
        <link rel="stylesheet" href="assets/css/ace.min.css" class="ace-main-stylesheet" id="main-ace-style" />
        <!--[if lte IE 9]>
                <link rel="stylesheet" href="assets/css/ace-part2.min.css" class="ace-main-stylesheet" />
        <![endif]-->
        <link rel="stylesheet" href="assets/css/ace-skins.min.css" />
        <link rel="stylesheet" href="assets/css/ace-rtl.min.css" />
        <link href="CSS/Estilos.css" rel="stylesheet" type="text/css"/>
        <!--[if lte IE 9]>
          <link rel="stylesheet" href="assets/css/ace-ie.min.css" />
        <![endif]-->
        <!-- inline styles related to this page -->
        <!-- ace settings handler -->
        <script src="assets/js/ace-extra.min.js"></script>
        <!-- HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries -->
        <!--[if lte IE 8]>
        <script src="assets/js/html5shiv.min.js"></script>
        <script src="assets/js/respond.min.js"></script>
        <![endif]-->        
    </head>

    <body class="no-skin">
        <!-- header -->
        <?php include_once './Header.php'; ?>
        <!-- fin header -->

        <div class="main-container ace-save-state" id="main-container">
            <script type="text/javascript">
                try {
                    ace.settings.loadState('main-container')
                } catch (e) {
                }
            </script>

            <?php include_once './MenuLeft.php'; ?>

            <div class="main-content">
                <div class="main-content-inner">
                    <!-- navegacion -->
                    <div class="breadcrumbs ace-save-state" id="breadcrumbs">
                        <ul class="breadcrumb">
                            <li>
                                <i class="ace-icon fa fa-android" style="color:#a4c739"></i>
                                <span><b>Mis Dispositivos</b></span>
                            </li>
                        </ul><!-- /.breadcrumb -->

                    </div>

                    <div class="page-content">
                        <div class="ace-settings-container" id="ace-settings-container">                            

                            <div class="ace-settings-box clearfix" id="ace-settings-box">
                                <div class="pull-left width-50">
                                    <div class="ace-settings-item">
                                        <div class="pull-left">
                                            <select id="skin-colorpicker" class="hide">
                                                <option data-skin="no-skin" value="#438EB9">#438EB9</option>
                                                <option data-skin="skin-1" value="#222A2D">#222A2D</option>
                                                <option data-skin="skin-2" value="#C6487E">#C6487E</option>
                                                <option data-skin="skin-3" value="#D0D0D0">#D0D0D0</option>
                                            </select>
                                        </div>
                                        <span>&nbsp; Choose Skin</span>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-navbar" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-navbar"> Fixed Navbar</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-sidebar" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-sidebar"> Fixed Sidebar</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-breadcrumbs" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-breadcrumbs"> Fixed Breadcrumbs</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-rtl" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-rtl"> Right To Left (rtl)</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2 ace-save-state" id="ace-settings-add-container" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-add-container">
                                            Inside
                                            <b>.container</b>
                                        </label>
                                    </div>
                                </div><!-- /.pull-left -->

                                <div class="pull-left width-50">
                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-hover" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-hover"> Submenu on Hover</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-compact" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-compact"> Compact Sidebar</label>
                                    </div>

                                    <div class="ace-settings-item">
                                        <input type="checkbox" class="ace ace-checkbox-2" id="ace-settings-highlight" autocomplete="off" />
                                        <label class="lbl" for="ace-settings-highlight"> Alt. Active Item</label>
                                    </div>
                                </div><!-- /.pull-left -->
                            </div><!-- /.ace-settings-box -->
                        </div><!-- /.ace-settings-container -->

                        <div class="row">
                            <div class="col-xs-12">
                                <!-- PAGE CONTENT BEGINS -->                               
                                <div id="signup-box" class="signup-box widget-box no-border small-form">
                                    <div class="widget-body">
                                        <div class="widget-main">
                                            <h4 class="header green lighter bigger">
                                                <i class="ace-icon fa fa-android green"></i>
                                                <b>Registrar Dispositivos, Máximo 2</b>
                                            </h4>                            
                                            <form>
                                                <fieldset>
                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" class="form-control" placeholder="Imei de su dispositivo" />
                                                            <i class="ace-icon fa fa-mobile"></i>
                                                        </span>
                                                    </label>                                                    

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <input type="text" class="form-control" placeholder="No Sim Card" />
                                                            <i class="ace-icon fa fa-hashtag"></i>
                                                        </span>
                                                    </label>

                                                    <label class="block clearfix">
                                                        <span class="block input-icon input-icon-right">
                                                            <select class="form-control">
                                                                <option value="">Seleccione Tipo</option>
                                                                <option value="Celular">Celular</option>
                                                                <option value="Tablet">Tablet</option>
                                                            </select>
                                                            <!--<i class="ace-icon fa fa-user"></i>-->
                                                        </span>
                                                    </label>                                                                          

                                                    <div class="space-12"></div>

                                                    <div class="clearfix">
                                                        <button type="reset" class="width-30 pull-left btn btn-sm">
                                                            <i class="ace-icon fa fa-refresh"></i>
                                                            <span class="bigger-110">Limpiar</span>
                                                        </button>

                                                        <button type="button" class="width-65 pull-right btn btn-sm btn-success">
                                                            <span class="bigger-110">Registrar</span>

                                                            <i class="ace-icon fa fa-arrow-right icon-on-right"></i>
                                                        </button>
                                                    </div>
                                                </fieldset>
                                            </form>
                                        </div>                                           
                                    </div><!-- /.widget-body -->                                    
                                </div>

                                <div class="row table-overflow">
                                    <div class="col-xs-10">
                                        <table id="simple-table" class="table  table-bordered table-hover">
                                            <thead>
                                                <tr>                                                                                                      
                                                    <th>Imei</th>
                                                    <th>No Sim Card</th>
                                                    <th class="hidden-480">Tipo</th>                                               
                                                    <th>Acciones</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php foreach ($resultado as $value) : ?>
                                                    <tr> 
                                                        <td><?php echo $value['imei'] ?></td>
                                                        <td><?php echo $value['numero_sim'] ?></td>
                                                        <td class="hidden-480"><?php echo $value['tipo'] ?></td>                                  

                                                        <td>
                                                            <div class="hidden-sm hidden-xs btn-group">                                                            

                                                                <button class="btn btn-xs btn-info">
                                                                    <i class="ace-icon fa fa-pencil bigger-120"></i>
                                                                </button>

                                                                <button class="btn btn-xs btn-danger">
                                                                    <i class="ace-icon fa fa-trash-o bigger-120"></i>
                                                                </button>

                                                                <button class="btn btn-xs btn-warning" id="findMe" data-id="<?php echo $value['imei'] ?>" data-rel="tooltip2" title="Ubicación">
                                                                    <i class="ace-icon fa fa-map-marker bigger-120" ></i> 
                                                                </button>

                                                            </div>

                                                            <div class="hidden-md hidden-lg">
                                                                <div class="inline pos-rel">
                                                                    <button class="btn btn-minier btn-primary dropdown-toggle" data-toggle="dropdown" data-position="auto">
                                                                        <i class="ace-icon fa fa-cog icon-only bigger-110"></i>
                                                                    </button>

                                                                    <ul class="dropdown-menu dropdown-only-icon dropdown-yellow dropdown-menu-right dropdown-caret dropdown-close">
                                                                        <li>
                                                                            <a href="#" class="tooltip-info" data-rel="tooltip" title="View">
                                                                                <span class="blue">
                                                                                    <i class="ace-icon fa fa-search-plus bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-success" data-rel="tooltip" title="Edit">
                                                                                <span class="green">
                                                                                    <i class="ace-icon fa fa-pencil-square-o bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="tooltip-error" data-rel="tooltip" title="Delete">
                                                                                <span class="red">
                                                                                    <i class="ace-icon fa fa-map-marker bigger-120"></i>
                                                                                </span>
                                                                            </a>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>   

                                                <?php endforeach; ?>
                                            </tbody>
                                        </table>
                                    </div><!-- /.span -->
                                </div><!-- /.row -->

                                <!-- PAGE CONTENT ENDS -->
                            </div><!-- /.col -->
                        </div><!-- /.row -->
                    </div><!-- /.page-content -->
                </div>
            </div><!-- /.main-content -->
            <form id="viewLocations" style="display: none" method="POST" action="MyTrips.php" >
                <input id="imei" name="imei" type="hidden">
                <input type="submit">
            </form>
            <!-- Footer -->
            <?php include_once './Footer.php' ?>
            <!-- Footer -->

            <a href="#" id="btn-scroll-up" class="btn-scroll-up btn btn-sm btn-inverse">
                <i class="ace-icon fa fa-angle-double-up icon-only bigger-110"></i>
            </a>
        </div><!-- /.main-container -->

        <!-- basic scripts -->

        <!--[if !IE]> -->
        <script src="assets/js/jquery-2.1.4.min.js"></script>  
        <script src="JS/funciones.js"></script> 

        <!-- <![endif]-->

        <!--[if IE]>
<script src="assets/js/jquery-1.11.3.min.js"></script>
<![endif]-->
        <script type="text/javascript">
                if ('ontouchstart' in document.documentElement)
                    document.write("<script src='assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
        </script>
        <script src="assets/js/bootstrap.min.js"></script>       
        <!-- ace scripts -->
        <script src="assets/js/ace-elements.min.js"></script>
        <script src="assets/js/ace.min.js"></script>   
        <script>
                jQuery(function ($) {
                    //add tooltip for small view action buttons in dropdown menu
                    $('[data-rel="tooltip"]').tooltip({placement: tooltip_placement});

                    $('[data-rel="tooltip2"]').tooltip({placement: tooltip_placement2});
                    //tooltip placement on right or left
                    function tooltip_placement(context, source) {
                        var $source = $(source);
                        var $parent = $source.closest('table')
                        var off1 = $parent.offset();
                        var w1 = $parent.width();

                        var off2 = $source.offset();
                        //var w2 = $source.width();

                        if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2))
                            return 'right';
                        return 'left';
                    }


                    function tooltip_placement2(context, source) {
                        var $source = $(source);
                        return 'right';
                    }
                });
        </script>
    </body>
</html>
