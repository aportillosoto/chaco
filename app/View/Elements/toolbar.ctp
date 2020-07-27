<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
<!--        <div class="user-panel">
            <div class="pull-left image">
                <img src="<?php if(!empty($usufoto)){ echo "/chaco/img/fotos/".$usuario.".jpg";}else{ echo "/chaco/img/no_disponible.jpg";}?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p><?php echo $usuario;?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>-->
        <!-- search form -->
        <!-- <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Buscar...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form> -->
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">Men&uacute; principal</li>
<!--            <li><a href="/sicoe">Inicio</a></li>-->
            <li><a href="/chaco"><span class="glyphicon glyphicon-home"></span> <strong>Inicio</strong></a></li>
            <?php foreach($interfaces as $interfaz):?>
            <li class="treeview">
                <a href="">
                    <i class="fa fa-list"></i><span><?php echo $interfaz[0][0]['mod_descri']?></span> <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <?php foreach($interfaz as $pag):?>
                    <li><a href="<?php echo "/chaco/".$pag[0]['pag_descri']?>"><i class="fa fa-circle-o text-aqua"></i> <?php echo $pag[0]['nomb_menu']?></a></li>
                    <?php endforeach;?>
                </ul>
            </li>
            <?php endforeach;?>
            <li>

            <a href="/chaco/" target="_blank" onclick="closeDoc();">
            <i class="fa fa-book text-yellow"></i>
            <span>Ayuda</span>
            </a>

            </li>            
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>