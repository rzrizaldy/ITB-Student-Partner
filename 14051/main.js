//Fanni Ulfani/18214051
//Notification

//global variables
var score;
var startdate;

//time
var d = new Date();
var days = ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"];
var day = days[d.getDay()];
var date = d.getDate();
var month = d.getMonth();
var year = d.getFullYear();
var hour = d.getHours();
var minute = d.getMinutes();

function init() {
	score = 0;
	startdate = new Date();
}

var regulardayquotes = [
	'Aku harus belajar!',
	'Apakah semua tugas sudah aku kerjakan?',
	'Aku harus kerja kelompok, teman-temanku sudah menunggu',
	'Apakah besok ada kuis? Gawat, aku belum belajar',
	'Soal latihan ini sulit, aku harus belajar lebih banyak lagi'
]

var regularnightquotes = [
	'Aku harus belajar materi besok!',
	'Apakah malam ini ada deadline tugas?',
	'Tugas yang besok harus dikumpulkan jangan sampai ketinggalan',
	'Apakah besok ada kuis? Gawat, aku belum belajar',
	'Soal latihan ini sulit, aku harus belajar lebih banyak lagi'
]
var weekendquotes = [
	'Walaupun libur, aku harus tetap belajar!',
	'Lebih baik mencicil tugas',
	'Minggu depan ada presentasi, aku harus latihan!',
	'Hari ini ada kegiatan unit, aku harus ke kampus',
	'Hari ini ada kegiatan himpunan, aku harus ke kampus'
]

//var button etc
var curLevel = document.querySelector('.current-level');
var curLevelPara = document.querySelector('.progress p');

var mainImage = document.querySelector('.game img');
var backImage = document.querySelector('.bg img');
var curBg = 'day';
var curImage = 'sad'; 
var updateImage = 'sad'; 

var btnScore = document.querySelectorAll('.button-bar button');

var dates = document.querySelector('.game p');

//button
for(i = 0; i < btnScore.length; i++) {
  btnScore[i].onclick = function(e) {
    var scoreMod = e.target.getAttribute('data-score');
    var scoreNum = Number(scoreMod);
    score += scoreNum;
  };
}

//update current time
function updateTime(){
  	dates.textContent = day +" "+date+" "+month+" "+year+" "+hour+":"+minute;
  	document.getElementById("date").innerHTML = dates.textContent;
}

//update progress bar
function updateProgress() {
  if(score===0) {
	  curLevel.style.width = 0;
  } else {
	var percent = Math.floor((score/10000) * 100);
	curLevel.style.width = percent + '%';
  }
  curLevelPara.textContent = score + '/10000';
}

//update current image 
function updateDisplay() {
  if(score > 10000) {
    score = 10000;
  }

  if(score <= 5000) {
    curImage = 'sad';
  } else if(score > 5000 && score <= 8000) {
    curImage = 'smile';
  } else if(score > 8000) {
    curImage = 'happy';
  }

  if(updateImage !== curImage) {
    textIconNotificationTimeout('Keep it up!', 'img/' + curImage + '_head.png', 'She says', 4000);
    mainImage.src = 'img/' + curImage + '.png';
    updateImage = curImage;
  }
  
  if(hour>=6 && hour<18) {
	curBg = 'day';
	backImage.src =  'img/' + curBg + '.png';
  } else if (hour>=18 || hour<6) {
	curBg ='night';
	backImage.src =  'img/' + curBg + '.png';
  }
  
  updateProgress(); 
  updateTime();
  
}

//display

//randomnotification(quoteslist)
function randomNotification() {
  var randomQuote = quoteChooser();
  var icon ='img/' + curImage + '_head.png';
  textIconNotificationTimeout(randomQuote, icon, 'She says', 4000);
}

function quoteChooser() {
  var randomNumber = Math.floor(Math.random() * 5);
  if (day ==="Saturday" || day ==="Sunday") {
	quote = weekendquotes[randomNumber];
  } else if(hour>=6 && hour<18) {
    quote = regulardayquotes[randomNumber];
  } else if(hour<6 || hour>=18) {
    quote = regularnightquotes[randomNumber];
  }
  return quote;
}
//main loop
function mainLoop() {
  load();
  if (score === null) {
	init();
	mainGame();  
  } else {
	mainGame();
  }
  updateDisplay();
}
	
//load
function load() {
  score = JSON.parse(localStorage.getItem('score'));
}

//save
function save() {
  localStorage.setItem('score', JSON.stringify(score));
}

//scoring
function scoring(){
  score -=25;
  if(score <= 0) {
    score = 0;
  }
  updateDisplay();
}

//main game
function mainGame(){
  updateDisplay();
  if(score <= 0) {
    score = 0;
  }
  save();	  
  window.requestAnimationFrame(mainGame);
}
  
  
window.onload=function(){
	mainLoop();
	var timer1 = setInterval(scoring, 10000);
	var timer2 = setInterval(randomNotification, 10000);
}
