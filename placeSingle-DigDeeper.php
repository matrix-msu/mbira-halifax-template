<?php
    require "lib/site.php";
	
	if(isset($_GET['id'])) {
		$id = $_GET['id'];
		if($id == 0) {
			$id = 1;
		}
		$exhibit = $exhibits->get($id);
        $location = $locations->get($id);
        $area = $areas->get($id);
		
	}else {
		header('Location: /placeSingle-DigDeeper.php');
	}
	
	// "L" for location
    // "A" for area
    $placeType = "";

    if($location != null){
        $placeType = "L";
    }
    else if($area != null){
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


<div class="onExploration sub">
    <a class="previousStop" href="placeSingle-DigDeeper.php?id=<?php 
            if($step == "1"){
                echo $stopsArry[$total-1];
            }
            else {
                echo $stopsArry[$step - 2];
            }
        ?>&s=<?php
            if($step == "1"){
                echo $total;
            }
            else {
                echo ($step - 1);
            }?>&t=<?php echo $total; ?>&expid=<?php echo $expid; ?>
                              "><img src="assets/svgs/arrow.svg"/></a>
        
        
    <a class="explorationTitle" href="explorationSingle.php?id=<?php echo $expid; ?>"><?php echo $explorations->get($expid)->getName(); ?></a>
    <p class="stopNumberOfNumber"><?php echo $step; ?> of <?php echo $total; ?></p>
    <a class="nextStop" href="placeSingle-DigDeeper.php?id=<?php 
            if($step == $total){
                echo $stopsArry[0] ;
            }
            else{
                echo $stopsArry[$step] ;
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
		<a class="back" href="placeSingle.php?id=<?php echo $_GET['id'];?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>"><img class="backArrow" src="assets/svgs/arrow.svg"/><p class="backTitle"><?php echo $location->getName();?></p></a>
	<?php } ?>
	
	<?php if($placeType == "A") { ?>
		<a class="back" href="placeSingle.php?id=<?php echo $_GET['id'];?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>"><img class="backArrow" src="assets/svgs/arrow.svg"/><p class="backTitle"><?php echo $area->getName();?></p></a>
	<?php } ?>
	
	<div class="right">
		<a class="active" href="placeSingle-Map.php?id=<?php echo $_GET['id'];?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>">Map</a>
		<a href="placeSingle-Media.php?id=<?php echo $_GET['id'];?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>">Media</a>
		<a href="placeSingle-Conversations.php?id=<?php echo $_GET['id'];?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>">Conversations</a>
		<a href="placeSingle-DigDeeper.php?id=<?php echo $_GET['id'];?><?php if(isset($_GET['s']) && isset($_GET['t']) && isset($_GET['expid'])) { ?>&s=<?php echo $step;?>&t=<?php echo $total?>&expid=<?php echo $expid;?><?php } ?>">Dig Deeper</a></div>
</div>

<!--===============================
Dip Deeper
================================-->
<div class="placeSingleSubTitle"><h4>Dig Deeper</h4></div>
<section id='digDeeper'>
	<p>
        <?php 
		if($placeType == "L") { 
			echo $location->getDigDeeper();
		}
		else if($placeType == "A") {
			echo $area->getDigDeeper();
		}
		?>
    </p>
</section>

<!--===============================
Scripts & Footer
================================-->
	<script src='js/index.js'></script>
	<script src='js/modals.js'></script>
<?php
	include('includes/footer.php');
?>
