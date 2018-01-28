var blockArray = [];
var toCompleteArray = [];
var blockArrayX = [];
var blockArrayY = [];
var moves = -1;
var tileSize = 76;

initGame();

function initGame()
{
	number = 0;
    
    tileSize = document.getElementById('inset').offsetWidth/4
	
	//setUp the 4x4 playField
	for (var i = 0; i < 4; i++)
            {
            	for (var j = 0; j < 4; j++)
            	{
            			number++
//            			if (number == 16) { return;}
            		var blockDiv = document.createElement("div");
            		
            			if (number == 16) { blockDiv.id ="empty";}
            			else
            			{
            				blockDiv.id = "block_" +number;
            				blockDiv.innerHTML = number;
            				blockDiv.setAttribute("onclick","move(event)");
            				blockDiv.setAttribute("ontouchstart","move(event)");
            				blockDiv.className ="block";
            			}
            			
            			if(number % 2 == 0 && i % 2 == 0){blockDiv.className ="block red"};
            			if(number % 2 != 0 && i % 2 != 0){blockDiv.className ="block red"};
            			
            			blockDiv.style.left = tileSize * j + "px";
        				blockDiv.style.top = tileSize * i + "px";
            		
            		document.getElementById('inset').appendChild(blockDiv);
            		
            		blockArray.push(blockDiv);
                	toCompleteArray.push(blockDiv);
               	 	blockArrayY.push(blockDiv.offsetLeft);
                	blockArrayX.push(blockDiv.offsetTop);
            		
            	}
            }
}

function shuffle(event)
{
	//remove Empty
//	event.target.style.backgroundColor = "transparent";
//	event.target.style.backgroundColor = "none";
//	event.target.style.color = "transparent";
//	event.target.style.color = "none";
//	event.target.onclick = null;
	
	//randomize blockArray
	blockArray.sort(function() {return 0.5 - Math.random()})
		
	for ( var i = 0; i < blockArray.length; i++)
	{	
        document.getElementById(blockArray[i].id).style.left = blockArrayY[i] +"px";
    	document.getElementById(blockArray[i].id).style.top = blockArrayX[i] +"px";
	};
	
}

function move(event)
{	
    if(moves == -1)
    {
        moves = 0;
        this.shuffle();
        return;
    }
    
    tileSize = document.getElementById('inset').offsetWidth/4
    
		targetX = event.target.offsetLeft;
		targetY = event.target.offsetTop;
		
		emptyX=document.getElementById("empty").offsetLeft;
		emptyY=document.getElementById("empty").offsetTop;
		
		gotoY = emptyY - targetY
		gotoX = emptyX - targetX
 		// update position empty && target
 		if((gotoX ==0 || gotoY ==0)&&(gotoX == tileSize || gotoY == tileSize  || gotoX == -tileSize || gotoY == -tileSize))
 		{
 		
 		document.getElementById("empty").style.left = targetX +"px";
 		document.getElementById("empty").style.top = targetY +"px";
 		
 		event.target.style.left = emptyX +"px";
 		event.target.style.top = emptyY +"px";
 		
 		event.target.addEventListener( 'webkitTransitionEnd', moved, false );
 		event.target.addEventListener( 'transitionend', moved, false );
 		
 		count();
 		}
 	
 	function moved()
 	{
 		event.target.removeEventListener( 'webkitTransitionEnd', moved, false );
 		event.target.removeEventListener( 'transitionend', moved, false );
 		check();
 	}
}

function count()
{
	moves++;
	
	var digits = moves.toString().split('');
		digits.reverse();
	
	for ( var i = 0; i < digits.length;i++)
	{
		document.getElementById("digit_"+i).innerHTML = digits[i];
	};
}

function check()
{	
	for ( var i = 0; i < toCompleteArray.length; i++)
	{	
         if (toCompleteArray[i].offsetLeft == blockArrayY[i] && toCompleteArray[i].offsetTop == blockArrayX[i])
         {
			if(i==15){alert("Yay you solved the puzzle in "+moves+" moves");moves=0;}
         }
         else
         {
         	break;
         }
	};	
};