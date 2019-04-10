
<!--END .wrapper -->
</section>

    <footer class="footer-container wrapper">                                
        <div class="row-fluid">
            <section id="footer-widgets">

                <div class="span4 social">
                    <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer 1' ) ) ?>
                </div>                  

                <div class="span4">
                    <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer 2' ) ) ?>
                </div>        

                <div class="span4 copyright">
                    <?php /* Widgetised Area */ if ( !function_exists( 'dynamic_sidebar' ) || !dynamic_sidebar( 'Footer 3' ) ) ?>
                </div>            
            </section>            
        </div>

    </footer>

    <!-- Theme Hook -->
	<?php wp_footer(); ?>
<!--END body-->
</body>        
<!--END html-->
</html>