<?php
    require "lib/site.php";

    ob_start();

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		if($id == 0) {
			$id = 1;
		}
		if(!is_numeric($id)) {
			$id = 1;
		}
		/*$exhibit = $exhibits->get($id);*/
        $location = $locations->get($id);
        $area = $areas->get($id);
        $loc_media = $locations->getMedia($id); // location id
		$area_media = $areas->getMedia($id);
	}else {
		header('Location: /placeSingle-Media.php');
	}
	
	$givenType = addslashes(strip_tags($_GET['type']));

	$placeType = "";
    if($location != null && $givenType == "L"){
        $placeType = "L";
    }
    else if($area != null && $givenType == "A"){
         $placeType = "A";
    }
?>

<?php
    if($placeType == "L"){
        $pagename = $location->getName();
    }
    else if($placeType == "A"){
        $pagename = $area->getName();
    }

	include('includes/head.php');
	include('includes/header.php');
?>

<!--===============================
Landing Image
================================-->
<!--<div id='landing' class="placeSub">
    <div id='landing-overlay-blend' class="placeSub"></div>
</div>-->

<div id='landing' class="placeSub" style="background: url('<?php
    if($placeType == "L") {
        echo $source.$location->getHeaderPath();
    }
    else if($placeType == "A") {
        echo $source.$area->getHeaderPath();
    }
    ?>') center center;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    position: absolute;
    overflow: hidden;
    width: 100%;">
    <div id='landing-overlay-blend' class="placeSub"></div>
</div>


<?php
if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) {
    $exploration = $explorations->get($_GET['expid']);
    $stops = $exploration->getStops();
    $stopsArry = array();

    for ($x = 0; $x < count($stops); $x++) {

        /*$stops[$x] = str_replace("A", "", $stops[$x]);*/

        if($locations->get($stops[$x]) != null){
            array_push($stopsArry,$stops[$x]);
        }

/*        if($areas->get($stops[$x]) != null){
            array_push($stopsArry, $stops[$x]);
        }*/

        if($areas->get(str_replace("A", "", $stops[$x])) != null){
            array_push($stopsArry, str_replace("A", "", $stops[$x]));
        }
    }
}
?>

<script>
$('header').css("background", "#082237");
</script>


<!--===============================
Place on Exploration Controls (Only active when user has selected "start Exploration")
================================-->
<?php
$step = null;
$total = null;
$expid = null;
if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) {
	$step = $_GET['s'];
    $total = $_GET['t'];
    $expid = $_GET['expid']
?>


<?php
    $exploration = $explorations->get($_GET['expid']);
    $stops = $exploration->getStops();
    $stopsArry = array();

    for ($x = 0; $x < count($stops); $x++) {

        /*$stops[$x] = str_replace("A", "", $stops[$x]);*/

        if($locations->get($stops[$x]) != null){
            array_push($stopsArry,$stops[$x]);
        }

/*        if($areas->get($stops[$x]) != null){
            array_push($stopsArry, $stops[$x]);
        }*/

        if($areas->get(str_replace("A", "", $stops[$x])) != null){
            array_push($stopsArry, str_replace("A", "", $stops[$x]));
        }
    }
?>


<?php
    // ----- Building data structure to keep track of types of stops in an array
    if(isset($_GET['expid'])){
        $types = array();
        for ($x = 0; $x < count($stops); $x++) {

            /*$stops[$x] = str_replace("A", "", $stops[$x]);*/

            if($locations->get($stops[$x]) == null || $areas->get($stops[$x]) == null){
                if($locations->get($stops[$x]) != null){
                    $stop = $locations->get($stops[$x]);
                    array_push($types, "L");
                }

/*                if($areas->get($stops[$x]) != null){
                    $stop = $areas->get($stops[$x]);
                    array_push($types, "A");
                }*/

                if($areas->get(str_replace("A", "", $stops[$x])) != null){
                    $stop = $areas->get(str_replace("A", "", $stops[$x]));
                    array_push($types, "A");
                }
            }

            if($locations->get($stops[$x]) != null && $areas->get($stops[$x]) != null){
                if($locations->get($stops[$x]) != null){
                    $stop = $locations->get($stops[$x]);
                    array_push($types, "L");
                }

                if($areas->get(str_replace("A", "", $stops[$x])) != null){
                    $stop = $areas->get(str_replace("A", "", $stops[$x]));
                    array_push($types, "A");
                }
                $x++;
            }
        }
    }
    // ----- end
?>


<div class="onExploration sub">
    <a class="previousStop" href="placeSingle-Media.php?id=<?php
            if($step == "1"){
                echo $stopsArry[$total-1];
            }
            else {
                echo $stopsArry[$step - 2];
            }
        ?>&type=<?php
            if($step == "1"){
                echo $types[$total-1];
            }
            else {
                echo $types[$step - 2];
            }?>&s=<?php
            if($step == "1"){
                echo $total;
            }
            else {
                echo ($step - 1);
            }?>&t=<?php echo $total; ?>&expid=<?php echo $expid; ?>
                              "><img src="assets/svgs/arrow.svg"/></a>


    <a class="explorationTitle" href="explorationSingle.php?id=<?php echo $expid; ?>"><?php echo $explorations->get($expid)->getName(); ?></a>
    <p class="stopNumberOfNumber"><?php echo $step; ?> of <?php echo $total; ?></p>
    <a class="nextStop" href="placeSingle-Media.php?id=<?php
            if($step == $total){
                echo $stopsArry[0];
            }
            else{
                echo $stopsArry[$step];
            }
                              ?>&type=<?php
            if($step == $total){
                echo $types[0];
            }
            else {
                echo $types[$step];
            }
        ?>&s=<?php
            if($step == $total){
                echo "1";
            }
            else {
                echo ($step + 1);
            }?>&t=<?php echo $total; ?>&expid=<?php echo $expid; ?>
                              "><img src="assets/svgs/arrow.svg"/></a>
</div>

<?php } ?>


<!--===============================
Place NavBar
================================-->
<div class="placeNavBar" style="background: linear-gradient(
      rgba(10,38,61,.8),
      rgba(10,38,61,.8)
    ), url('<?php
    if($placeType == "L") {
        echo $source.$location->getHeaderPath();
    }
    else if($placeType == "A") {
        echo $source.$area->getHeaderPath();
    }
    ?>') center center;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center center;
    position: fixed;
    overflow: hidden;
    width: 100%;">

	<?php if($placeType == "L") { ?>
		<a class="back" href="placeSingle.php?id=<?php echo $id;?>&type=<?php echo $givenType?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>"><img class="backArrow" src="assets/svgs/arrow.svg"/><p class="backTitle"><?php echo $location->getName();?></p></a>
	<?php } ?>

	<?php if($placeType == "A") { ?>
        <a class="back" href="placeSingle.php?id=<?php echo $id;?>&type=<?php echo $givenType?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>"><img class="backArrow" src="assets/svgs/arrow.svg"/><p class="backTitle"><?php echo $area->getName();?></p></a>
	<?php } ?>

	<div class="right">
		<a href="placeSingle-Map.php?id=<?php echo $id;?>&type=<?php echo $givenType?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>">Map</a>



        <?php if ($placeType == "L") {
        foreach($locations->getMediaToggle($id)[0] as $val)
        {
            if($val == "true"){
                ?>
                <a class="active" href="placeSingle-Media.php?id=<?php echo $id;?>&type=<?php echo $givenType?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>">Media</a>
                <?php
                            break;
                        }
            }
        } ?>
        <?php if ($placeType == "A") {
        foreach($areas->getMediaToggle($id)[0] as $val)
        {
            if($val == "true"){
                ?>
                <a class="active" href="placeSingle-Media.php?id=<?php echo $id;?>&type=<?php echo $givenType?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>">Media</a>
                <?php
                    break;
                }
            }
        } ?>





        <?php if ($placeType == "L") {
        foreach($locations->getCommentsToggle($id)[0] as $val)
        {
            if($val == "true"){
            ?>
            <a href="placeSingle-Conversations.php?id=<?php echo $id;?>&type=<?php echo $givenType?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>">Conversations</a>
            <?php
                        break;
                    }
            }
        } ?>
        <?php if ($placeType == "A") {
        foreach($areas->getCommentsToggle($id)[0] as $val)
        {
            if($val == "true"){
                ?>
                <a href="placeSingle-Conversations.php?id=<?php echo $id;?>&type=<?php echo $givenType?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>">Conversations</a>
                <?php
                    break;
                }
            }
        } ?>





        <?php if ($placeType == "L") {
        foreach($locations->getDigDeeperToggle($id)[0] as $val)
        {
            if($val == "true"){
                ?>
                <a href="placeSingle-DigDeeper.php?id=<?php echo $id;?>&type=<?php echo $givenType?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>">Dig Deeper</a>
                <?php
                            break;
                        }
                    }
        } ?>
        <?php if ($placeType == "A") {
        foreach($areas->getDigDeeperToggle($id)[0] as $val)
        {
            if($val == "true"){
            ?>
            <a href="placeSingle-DigDeeper.php?id=<?php echo $id;?>&type=<?php echo $givenType?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>">Dig Deeper</a>
            <?php
                        break;
                    }
                }
        } ?>


    </div>
</div>

<!--===============================
Media
================================-->
<div class="placeSingleSubTitle"><h4>Media</h4></div>
<script>
$('.placeSingleSubTitle').css('position','relative');
</script>
<section id='media'>
	<div id='collections-layout' class='collections-grid'>
        <?php
            $modalTitle = "Title";
            $modalDesc = "Desc";

			if($placeType == "L") {
                for($x=0; $x<count($loc_media); $x++){
                    echo "<div class='collection-container' class='openComingSoon'>
                        <a href='#' class='openModalMedia'>
                            <div class='collection-image'>
                                <img src='".$source.$loc_media[$x]['file_path']."' />
                                <h3 id='locTitle' style='visibility: hidden;'>".$loc_media[$x]['title']."</h3>
                                <p id='locDesc' style='visibility: hidden;'>".$loc_media[$x]['description']."</p>
                            </div>
                        </a>
                    </div>";
				}
/*				foreach($loc_media as $val){
                    echo "<div class='collection-container' class='openComingSoon'>
                        <a href='#' class='openModalMedia'>
                            <div class='collection-image'>
                                <img src='".$source.$val."' />
                            </div>
                        </a>
                    </div>";
				} */
			}

			else if($placeType == "A") {
                for($x=0; $x<count($area_media); $x++){
                    echo "<div class='collection-container' class='openComingSoon'>
                        <a href='#' class='openModalMedia'>
                            <div class='collection-image'>
                                <img src='".$source.$area_media[$x]['file_path']."' />
                                <h3 id='areaTitle' style='visibility: hidden;'>".$area_media[$x]['title']."</h3>
                                <p id='areaDesc' style='visibility: hidden;'>".$area_media[$x]['description']."</p>
                            </div>
                        </a>
                    </div>";
				}
/*				foreach($area_media as $val){
					echo "<div class='collection-container' class='openComingSoon'>
						<a href='#' class='openModalMedia'>
							<div class='collection-image'>
								<img src='".$source.$val."' />
							</div>
						</a>
					</div>";
				} */
			}

        ?>
	</div>
</section>


<!--===============================
Modals Include
================================-->
<?php
	include('includes/modalMedia.php');
?>
<?php
	include('includes/modals.php');
?>

<!--===============================
Scripts & Footer
================================-->
	<script src='js/modals.js'></script>
	<script src='js/slider.js'></script>

<?php
	include('includes/footer.php');
?>
