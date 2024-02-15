<!DOCTYPE html>
<html>
<title>Index</title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">



<style>
* {
  box-sizing: border-box;
}

.upper {
  column-count: 3;
  column-gap: 30px;
  column-rule-style: solid;
  column-rule-width: 1px;
  column-rule-color: lightblue;
  font-family: Times New Roman;
  font-size: 18px;
}

.topbtn {
  background-color: white;
  border: 2px solid black;
  color: black;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 4px 2px;
  cursor: pointer;
}

.topbtn:hover {
  background-color: #E67E22;
  border: none;
  color: white;
}

.topnav {
  overflow: hidden;
  background-color: #555;
  
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 18px 56px;
  text-decoration: none;
  font-size: 17px;
  border-top: 5px solid #555;

}

.topnav a:hover {
  color: white;
  border-top: 5px solid orange;
}

.topnav a.active {
  background-color: gray;
  color: white;
  border-top: 5px solid orange;
}

.topnav i{
  overflow: hidden;
  float: right;
  color:white;
  margin-right: 15px;
  text-align: center;
  padding-top: 18px;
  }

.topnav i:hover {
  color: orange;
}

.container {
  position: relative;
  color: black;
  font-family: Times New Roman;
  font-size: 20px;
}

.centered {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
}

/* Float four columns side by side */
.col {
  float: left;
  width: 33.33%;
  padding: 20px;
  margin-top: 60px;
}

/* Remove extra left and right margins, due to padding */
.rows {margin: 0 0px;}

/* Clear floats after the columns */
.rows:after {
  content: "";
  display: table;
  clear: both;
}

/* Style the counter cards */
.card {
  padding: 20px;
  text-align: center;
  background-color: white;
  color: black;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
}

.card i{
	background-color: gold;
	border-radius: 10px;
	font-size: 50px;
	color: white;
}

.columnss {
  float: left;
  width: 50%;
  display: flex;
  margin-top: 8%;
}

/* Clearfix (clear floats) */
.roo::after {
  content: "";
  clear: both;
  display: table;
}

.about {
  background-color: whitesmoke; 
  width: 100%;   
  text-align: justify;
  padding: 30px;
  height: 50%;
}

.notice{
  background-color: whitesmoke; 
  padding: 30px;
  margin-top: 5%;
}

.columnss img{
	margin-left: 100px;
	width: 50%;
  height: 50%;
}

/* Float four columns side by side */
.cols {
  float: left;
  width: 25%;
  border-left: 1px solid lightblue;
}

/* Remove extra left and right margins, due to padding */
.row {margin: 0 0px;}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Style the counter cards */
.cards {
  padding: 20px;
  text-align: left;
  background-color: white;
  color: black;
}

.cards i{
  color: orange;
}

.cards p {
	color: grey;
	font-family: Times New Roman;
}

.cards h3 {
	font-family: Arial;
	font-size: 19px;
	background-color: white;
}

.services {
  padding: 30px;
  margin-top: 4%;
  text-align: center;
}

.ro {
  display: flex;
  flex-wrap: wrap;
  padding: 0 4px;
}

/* Create four equal columns that sits next to each other */
.columnn {
  flex: 33.33%;
  max-width: 33.33%;
  padding: 0 4px;
}

.columnn img {
  margin-top: 8px;
  vertical-align: middle;
  width: 100%;
  transition: transform .2s; /* Animation */
}

.columnn img:hover {
  transform: scale(1.5);
}

.gallery {
  padding: 30px;
  margin-top: 3%;
  text-align: center;
}
</style>
<body>
	<div class="upper" id='home'>
<img src="img/logo.jpg" width="100px">
<p> <i class="fa fa-location-arrow" style="color:orange;"></i> Purano Sinamangal, Kathmandu </p>
<p> <i class="fa fa-envelope" style="color:orange"></i>  manankchildrenschool@gmail.com </p>
<p> <i class="fa fa-phone" style="color:orange"></i>  +977 1-4991040 </p>
<p> <i class="fa fa-clock-o" style="color:orange"></i> 9:00AM -5:00PM </p>
<a href="login.php"><button class="topbtn">Login</button></a>
<a href="NewStudent.php"><button class="topbtn">Register</button></a>
</div>

<div class="topnav">
  <a class="active" href="#home">Home</a>
  <a href="#about">About</a>
  <a href="#notice">Notice</a>
   <a href="#services">Services</a>
   <a href="#gallery">Gallery</a>
    <i class="fa fa-linkedin"></i>
    <i class="fa fa-twitter"></i>
   <i class="fa fa-facebook-official"></i>
    <i class="fa fa-instagram"></i> 

</div>

<div class="container">
	 <img src="img/rooms.jpg" style="width:100%;height:500px;opacity: 0.5;">
	  <div class="centered">
	  	<h4 style="text-align: center;color:darkorange;"><b>Welcome to MCPS Hostel</b></h4>
	  <h1 style="text-align: center;color: black;font-family: Algerian;">WE PROVIDE COMFORTABLE ACCOMODATION FOR YOU</h1>
	</div>
</div>

<div id='notice' class="notice">
  <h3>NOTICE & NEWS <hr></h3>
<p> - Students are requested to bring the required materials like bedsheet, pillowsheet, etc themselves as only a bed is made available in the room. They will be responsible for their material themselves. Hostel will not bear any responsibility for students' material. </p>
<p> - We will soon announce a physical examination date for the hostel students. </p>
  </div>

  <div class="rows">
  <div class="col">
    <div class="card">
    	<i class='fa fa-road'></i>
      <h3>Map and Directions</h3>
      <hr>
	  <p>Our hostel is located in the downtown and not too far from airport and bus station so it is quite easy to find us wherever you come from. </p>
    </div>
  </div>
  
  <div class="col">
    <div class="card">
       <i class='fa fa-home'></i>
      <h3>Accomodation Services</h3>
       <hr>
	  <p>Our hostel provides high-quality accommodation services to the students that come to our city from all over the country throughout the year.</p>
    </div>
  </div>
  
  <div class="col">
    <div class="card">
    	<i class='fa fa-star'></i>
      <h3>Great Experience</h3>
       <hr>
	  <p>With qualified and friendly staff and high level of comfort, we are sure you will have a great experience of staying at our hostel.</p>
    </div>
  </div>
  
  </div>

  <div class="roo">
        <div class="columnss">
           <img src="img/girls.jpg">
           </div>

        <div class="columnss">
        	<div class='about' id='about'>
           <h3>ABOUT US</h3>
      <p> We aim to provide housing solutions to people who are away from their home for studies. We are reputed for providing multiple hostel accomodation facilities on daily and monthly basis. We make sure to avail the utmost comfort by providing spacious rooms with personal warddrobe facilities for storage. We strive to serve the students with the best of our ability and
	facilities for their peaceful and safe stay at our hostel.</p>
	 </div>
     </div>
    </div>

 <div id="services" class="services">
<h3>OUR SERVICES: What We Offer</h3>
  <div class="row">
  <div class="cols">
    <div class="cards">
      <i class='fa fa-bed'> </i>
      <h3>Spacious Rooms</h3>
	  <p>We provide spacious rooms with comfortable beds and storages. </p>
    </div>
  </div>
  
  <div class="cols">
    <div class="cards">
      <i class='fa fa-money'></i>
      <h3>On booking payments</h3>
	  <p>We offer easy and reliable online room booking payment services. </p>
    </div>
  </div>
  
  <div class="cols">
    <div class="cards">
      <i class='fa fa-lock'></i>
      <h3> Security</h3>
	  <p>We have reliable wardens and security guards for everday service.</p>
    </div>
  </div>
  
  <div class="cols">
    <div class="cards">
      <i class='fa fa-apple'></i>
      <h3> Hygenic Food</h3>
	  <p>We offer wide range of best and hygenic food. </p>
    </div>
  </div>

   <div class="cols">
    <div class="cards">
      <i class='fa fa-stethoscope'></i>
      <h3>Health</h3>
    <p>We offer health checkup facility once a month. </p>
    </div>
  </div>

   <div class="cols">
    <div class="cards">
     <i class='fa fa-graduation-cap'></i>
      <h3>Tution</h3>
    <p>We offer tution facility for math and science subject. </p>
    </div>
  </div>

  <div class="cols">
    <div class="cards">
      <i class='fa fa-h-square'></i>
      <h3>Councelling</h3>
    <p>We offer councelling services for those students who suffers from pressure and anxiety of studies. </p>
    </div>
  </div>
</div>

<div id="gallery" class="gallery">
<h3>Gallery</h3>
<div class="ro"> 
  <div class="columnn">
    <img src="img/bed.jpg" style="width:100%">
    <img src="img/dormi.jpg" style="width:100%">
    <img src="img/study.jpg" style="width:100%">  
  </div>
  <div class="columnn">
    <img src="img/canteen.jpg" style="width:100%">
    <img src="img/kitchen.jpg" style="width:100%">
    <img src="img/people.jpg" style="width:100%">
  </div>  

  <div class="columnn">
    <img src="img/single.jpg" style="width:100%">
    <img src="img/double.jpg" style="width:100%">
    <img src="img/triple.jpg" style="width:100%">
  </div>  
  </div> 
 </div> 
<a href="#home"><button class="topbtn"><i class="fa fa-arrow-up"></i> To the top</button></a>
</body>
</html>

