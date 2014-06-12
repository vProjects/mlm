<!-- footer starts here -->
    <div class="row-fluid footer">
        <div class="span3 footer_part">
            <p class="footer_part_heading">MOJLIFE</p>
            <ul>
                <?php $footer_1st = $manageContent->getFooterLinks("1st_column"); ?> 
            </ul>
        </div>
         <div class="span3 footer_part">
            <p class="footer_part_heading">SHOPPING</p>
            <ul>
                <?php $footer_2nd = $manageContent->getFooterLinks("2nd_column"); ?>
            </ul>
          </div>
          <div class="span3 footer_part">
            <p class="footer_part_heading">About MOJLIFE</p>
            <ul>
                <?php $footer_3rd = $manageContent->getFooterLinks("3rd_column"); ?>
            </ul>
          </div>
          <div class="span3 footer_part">
             <p class="footer_part_heading">Please Subscribe</p> 
             <ul>
                <li class="footerLinks">
                    <!-- Begin MailChimp Signup Form -->
                    <style type="text/css">
                        #mc_embed_signup{background:#1F1F1F; clear:left; }
                        /* Add your own MailChimp form style overrides in your site stylesheet or in this style block.
                           We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
                    </style>
                    <div id="mc_embed_signup">
                    <form action="http://mojlife.us3.list-manage.com/subscribe/post?u=f4cdad6d202eae03f76ebd11e&amp;id=42bdb321de" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                        <input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required>
                        <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                        <div style="position: absolute; left: -5000px;"><input type="text" name="b_f4cdad6d202eae03f76ebd11e_42bdb321de" value=""></div>
                        <div class="clear"><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                    </form>
                    </div>
                    
                    <!--End mc_embed_signup-->
                </li>
                <li class="footerLinks">
                    <a href="https://www.facebook.com/pages/Mojlife/1457112564516176" target="_blank"><img src="img/facebook.png" class="socialIcons" alt="facebook"></a>
                    <a href="https://twitter.com/MOJLIFE" target="_blank"><img src="img/twitter.png" class="socialIcons" alt="twitter"></a>
                    <a href="https://plus.google.com/u/0/117843110940465994546" target="_blank"><img src="img/googleplus.png" class="socialIcons" alt="googleplus"></a>
                </li>
                
             </ul>
          </div>
    </div>
    <div class="row-fluid footer_text_part">
        <div class="span10 offset1">
            <hr class="footer_hr" />
            <?php $footer_text = $manageContent->getFooterBottomText(); ?>
            
        </div>    
    </div>
    <div class="cookiealert">
        <div class="alert alert-block alert-success fade in">
            <button type="button" class="close" data-dismiss="alert">×</button>
            <h4 class="alert-heading">Ta stran uporablja piškotke za delo</h4>
            <p>Spletno stran MojLife uporablja t.i. piškotke za izboljšanje uporabniške izkušnje. Z obiskom in uporabo spletnega strani MojLife soglašate s piškotki...</p>
            <button class="btn btn-success" id="cookieAlertAccept" data-dismiss="alert">Omogočajo</button>
          </div>
    </div>
    <!-- footer ends here -->
</div>
<!-- body container ends here -->

<script src="http://code.jquery.com/ui/1.10.3/jquery-ui.js"></script>
<script type="text/javascript">
	$(function() {
	  $( "#calender_date" ).datepicker();
	  $( "#calender_date" ).datepicker("option", "dateFormat","yy-mm-dd");
	 });
</script>

<script type="text/javascript">
  $( document ).ready(function() {
   
    $('#myCarousel').carousel({
      interval: 3000
    });
  });
</script>

</body>
</html>
