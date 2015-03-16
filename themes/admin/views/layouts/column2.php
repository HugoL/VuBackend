<?php $this->beginContent('//layouts/main'); ?>
 <div id="wrapper">
       <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <?php $this->widget('UserMenu'); ?>   

        <div id="page-wrapper">

            <div class="container-fluid">
                <?php echo $content ?>
              
            </div>
            <!-- /.container-fluid -->

        </div><!-- /#page-wrapper -->
</div><!-- /#wrapper -->
<?php $this->endContent(); ?>
