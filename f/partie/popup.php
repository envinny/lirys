<style>
    #div_epn, #div_rst, #div_cdl, #div_rso{
        /* border: 1px solid red; */
        vertical-align: center;
        position: fixed;
        z-index: 1000;
        padding: 3rem;
        top: -1000px;
    }
</style>
<script src="../../script/jquery-3.3.1.min.js"></script>
<script>
    $(document).ready(function(){
        // $("#div_epn, #div_rst, #div_cdl, #div_rso").fadeOut();
        $("#btn_frm_cdl, #btn_frm_rst, #btn_frm_rso, #btn_frm_epn").click(function(){
            $("#div_epn, #div_rst, #div_cdl, #div_rso").css("top", "-1000px");
        })
        $("#btn_cdl").click(function(){
            $("#div_cdl").css("top", "2%");
        })
        $("#btn_rst").click(function(){
            $("#div_rst").css("top", "2%");
        })
        $("#btn_epn").click(function(){
            $("#div_epn").css("top", "2%");
        })
        $("#btn_rso").click(function(){
            $("#div_rso").css("top", "2%");
        })
    });
    
</script>
<div class="container" id="div_rst">
    <div class="ui card">
    <div class="image">
        <img src="images/ristourne.png">
    </div>
    <div class="content">
        <div class="header">Likélémba</div>
        <div class="description">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque cupiditate soluta delectus et praesentium, quam labore, rem nihil doloribus ea at velit inventore dolorum itaque ipsa, facere ipsam fugit non!
        </div>
    </div>
    <div class="ui two bottom attached buttons">
        <div class="ui button" id="btn_frm_rst">
        <i class="fa-solid fa-rectangle-xmark"></i>
        Fermer
        </div>
        <a href="/lirys/f/ins"><div class="ui primary button">
        <i class="fa-solid fa-play"></i>
        Commencer
        </div></a>
    </div>
    </div>
</div>
<div class="container" id="div_epn">
    <div class="ui card">
    <div class="image">
        <img src="images/epargne.png">
    </div>
    <div class="content">
        <div class="header">Epargne</div>
        <div class="description">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque cupiditate soluta delectus et praesentium, quam labore, rem nihil doloribus ea at velit inventore dolorum itaque ipsa, facere ipsam fugit non!
        </div>
    </div>
    <div class="ui two bottom attached buttons">
        <div class="ui button" id="btn_frm_epn">
        <i class="fa-solid fa-rectangle-xmark"></i>
        Fermer
        </div>
        <a href="/lirys/f/ins"><div class="ui primary button">
        <i class="fa-solid fa-play"></i>
        Commencer
        </div></a>
    </div>
    </div>
</div>
<div class="container" id="div_rso">
    <div class="ui card">
    <div class="image">
        <img src="images/reseu.png">
    </div>
    <div class="content">
        <div class="header">Affiliation</div>
        <div class="description">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque cupiditate soluta delectus et praesentium, quam labore, rem nihil doloribus ea at velit inventore dolorum itaque ipsa, facere ipsam fugit non!
        </div>
    </div>
    <div class="ui two bottom attached buttons">
        <div class="ui button" id="btn_frm_rso">
        <i class="fa-solid fa-rectangle-xmark"></i>
        Fermer
        </div>
        <a href="/lirys/f/ins"><div class="ui primary button">
        <i class="fa-solid fa-play"></i>
        Commencer
        </div></a>
    </div>
    </div>
</div>
<div class="container" id="div_cdl">
    <div class="ui card">
    <div class="image">
        <img src="images/loyer.png">
    </div>
    <div class="content">
        <div class="header">Carnet de loyer</div>
        <div class="description">
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque cupiditate soluta delectus et praesentium, quam labore, rem nihil doloribus ea at velit inventore dolorum itaque ipsa, facere ipsam fugit non!
        </div>
    </div>
    <div class="ui two bottom attached buttons">
        <div class="ui button" id="btn_frm_cdl">
        <i class="fa-solid fa-rectangle-xmark"></i>
        Fermer
        </div>
        <a href="/lirys/f/ins"><div class="ui primary button">
        <i class="fa-solid fa-play"></i>
        Commencer
        </div></a>
    </div>
    </div>
</div>