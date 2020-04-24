alert("hi");
var p1button=document.querySelector("#p1");
var p2button=document.querySelector("#p2");
var p1score=0;
var h1=document.querySelector("h1");
var one=document.querySelector("#one");
var two=document.querySelector("#two");
var p2score=0;
var gameover=false;
var winningScore=5;
var rbutton=document.querySelector("#reset");
var numinput=document.querySelector("input");
var score=document.querySelector("#score");
console.log(p2button);

p1button.addEventListener("click",function()
	
{
	if(!gameover){
	p1score++;
	if(p1score >= winningScore){
		gameover=true;
		one.classList.add("winner");

	}
	one.textContent=p1score;}
});
p2button.addEventListener("click",function()
{
	if(!gameover){
	p2score++;
	if(p2score >= winningScore){
		gameover=true;
		two.classList.add("winner")
	}
	two.textContent=p2score;}
});
rbutton.addEventListener("click",function(){
	p1score=0;
	p2score=0;
	one.textContent=p1score;
	two.textContent=p2score;
	one.classList.remove("winner");
	two.classList.remove("winner");
	gameover=false;


});
numinput.addEventListener("change",function(){
	
	score.textContent=numinput.value; 
	winningScore=number(numinput.value);


});