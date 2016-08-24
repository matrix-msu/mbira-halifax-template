<?php
    require "lib/site.php";
	
    ob_start();		 

	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		if($id == 0) {
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
	
	$placeType = "";
    if($location != null && $_GET['type'] == "L"){
        $placeType = "L";
    }
    else if($area != null && $_GET['type'] == "A"){
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
    ?>') center center">
    <div id='landing-overlay-blend' class="placeSub"></div>
</div>


<?php
if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) {
    $exploration = $explorations->get($_GET['expid']);
    $stops = $exploration->getStops();
    $stopsArry = array();

    for ($x = 0; $x < count($stops); $x++) {

        $stops[$x] = str_replace("A", "", $stops[$x]);

        if($locations->get($stops[$x]) != null){
            array_push($stopsArry,$stops[$x]);
        }

        if($areas->get($stops[$x]) != null){
            array_push($stopsArry, $stops[$x]);
        }
    }
}
?>

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

        $stops[$x] = str_replace("A", "", $stops[$x]);

        if($locations->get($stops[$x]) != null){
            array_push($stopsArry,$stops[$x]);
        }

        if($areas->get($stops[$x]) != null){
            array_push($stopsArry, $stops[$x]);
        }
    }
?>


<?php
    // ----- Building data structure to keep track of types of stops in an array  
    if(isset($_GET['expid'])){
        $types = array();
        for ($x = 0; $x < count($stops); $x++) {

            $stops[$x] = str_replace("A", "", $stops[$x]);

            
            if($locations->get($stops[$x]) == null || $areas->get($stops[$x]) == null){ 
                if($locations->get($stops[$x]) != null){
                    $stop = $locations->get($stops[$x]);
                    array_push($types, "L");
                }

                if($areas->get($stops[$x]) != null){
                    $stop = $areas->get($stops[$x]);
                    array_push($types, "A");
                }
            }
            
            if($locations->get($stops[$x]) != null && $areas->get($stops[$x]) != null){ 
                if($locations->get($stops[$x]) != null){
                    $stop = $locations->get($stops[$x]);
                    array_push($types, "L");
                }

                if($areas->get($stops[$x]) != null){
                    $stop = $areas->get($stops[$x]);
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
                echo $stopsArry[0] ;
            }
            else{
                echo $stopsArry[$step] ;
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
<div class="placeNavBar">
	<?php if($placeType == "L") { ?>
		<a class="back" href="placeSingle.php?id=<?php echo $_GET['id'];?>&type=<?php echo $_GET['type']?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>"><img class="backArrow" src="assets/svgs/arrow.svg"/><p class="backTitle"><?php echo $location->getName();?></p></a>
	<?php } ?>
	
	<?php if($placeType == "A") { ?>
        <a class="back" href="placeSingle.php?id=<?php echo $_GET['id'];?>&type=<?php echo $_GET['type']?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>"><img class="backArrow" src="assets/svgs/arrow.svg"/><p class="backTitle"><?php echo $area->getName();?></p></a>
	<?php } ?>
	
	<div class="right">
		<a class="active" href="placeSingle-Map.php?id=<?php echo $_GET['id'];?>&type=<?php echo $_GET['type']?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>">Map</a>
		<a href="placeSingle-Media.php?id=<?php echo $_GET['id'];?>&type=<?php echo $_GET['type']?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>">Media</a>
		<a href="placeSingle-Conversations.php?id=<?php echo $_GET['id'];?>&type=<?php echo $_GET['type']?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>">Conversations</a>
		<a href="placeSingle-DigDeeper.php?id=<?php echo $_GET['id'];?>&type=<?php echo $_GET['type']?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>">Dig Deeper</a></div>
</div>

<!--===============================
Media
================================-->
<div class="placeSingleSubTitle"><h4>Media</h4></div>
<section id='media'>
	<div id='collections-layout' class='collections-grid'>
        <?php
			if($placeType == "L") {
				foreach($loc_media as $val){
                    echo "<div class='collection-container' class='openComingSoon'>
                        <a href='#' class='openModalMedia'>
                            <div class='collection-image'>
                                <img src='".$source.$val."' />
                            </div>
                        </a>
                    </div>";
				} 
			}			
			
			else if($placeType == "A") {
				foreach($area_media as $val){
					echo "<div class='collection-container' class='openComingSoon'>
						<a href='#' class='openModalMedia'>
							<div class='collection-image'>
								<img src='".$source.$val."' />
							</div>
						</a>
					</div>";
				} 
			}
        ?>
	</div>
</section>

<a href="#" class="bottomButton openModal">Contribute Media </a>

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