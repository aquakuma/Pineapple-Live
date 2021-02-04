<?php session_start();?>
<?php include("./includes/header.php");?>
<title>Pineapple</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="./js/live_all.js"></script>
<?php include("./includes/navbar.php");?>

<main role="main">
    <div class="container">
    <div class="d-flex align-items-center">
        <i class="fa fa-video-camera fa-2x mr-3" aria-hidden="true"></i><h4 class="my-2">現在ライブ中</h4>
    </div>
    <hr>
        <div id = 'now_live'>
            
        </div>




    </div>


    <div class="row">
      <div>
        <a id="back-to-top" href="#" class="btn btn-light back-to-top btn-lg my-3 float-right" role="button"><i class="fa fa-chevron-up"></i></a>
      </div>
    </div>
</div>
  

</main>

<?php include("./includes/footer.php");?>
<script type="text/javascript">
    $(document).ready(function(){
            // scroll body to 0px on click
            $('#back-to-top').click(function () {
                $('body,html').animate({
                    scrollTop: 0
                }, 100);
                return false;
            });
    });
</script>
<?php include("./includes/script.php");?>
