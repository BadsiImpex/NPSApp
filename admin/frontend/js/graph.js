class graph {
  constructor(dataArr, lblArr, canvasId) {
        this.dataArr = dataArr;
        this.lblArr = lblArr;
        this.canvasId = canvasId;
    }
    
  graphBckgrnd(c,ctx,height,width,stepsY,stepsX){
    console.log('width is ' + width + ' height is ' + height);
    ctx.beginPath();
    ctx.lineWidth = 1;
    ctx.strokeStyle = "#40434e";
    //draw Graph axis
    ctx.moveTo(20,20);
    ctx.lineTo(20,height-10);
    ctx.stroke();
    ctx.moveTo(20,height-10);
    ctx.lineTo(width-10,height-10);
    ctx.stroke();
    //y axis lines
    ctx.beginPath();
    ctx.strokeStyle = "#ebebeb";  
    var strt = height-10-stepsY;
    console.log(strt);
    for (var i=0;i<=10;i++) {
      ctx.moveTo(20,strt);
      ctx.lineTo(width-10,strt);
      ctx.stroke();
      ctx.fillStyle = "#40434e";
      ctx.font = "10px Arial";
      ctx.fillText(i*10, 0,strt+stepsY);
      strt = strt-stepsY;
    }
    //x axis lines
      strt = 20;
      var stepsX =(width-50)/(this.lblArr.length);
      console.log("steps X are "+ stepsX);
    for (var i=0; i<this.lblArr.length; i++){
        ctx.font = "10px Arial";
        ctx.fillText(this.lblArr[i],strt+stepsX,height+10);
        strt = strt+stepsX;
    }
  }
  line() {
    var c = document.getElementById(this.canvasId);
    console.log(c);
    var ctx = c.getContext("2d");
    var height = c.scrollHeight-10;
    var width = c.scrollWidth-10;
    var stepsY = (height-30)/10;
    var stepsX =(width-50)/(this.lblArr.length);  
    this.graphBckgrnd(c,ctx,height,width,stepsY,stepsX);
    //draw Graph
    ctx.beginPath();  
    ctx.strokeStyle = "#ff7062";
    ctx.lineWidth = 1;
    var oneStepsY = stepsY/10;
    var strtX = 20;
    var strtY = height-10;
    ctx.moveTo(20, height-10);
    console.log(this.dataArr[0][1]);
    for (var i=0;i<this.dataArr.length;i++){
        ctx.fillStyle = "#ff7062";
        ctx.fill();
        ctx.lineTo(strtX+stepsX,strtY-(oneStepsY*this.dataArr[i][1])); //draw line
        ctx.stroke();
        ctx.font = "10px Arial"; 
        ctx.fillText(this.dataArr[i][1],strtX+stepsX,strtY-10-(oneStepsY*this.dataArr[i][1])); //display value
        ctx.beginPath();
        ctx.arc(strtX+stepsX,strtY-(oneStepsY*this.dataArr[i][1]),3,0,2*Math.PI); //draw circle
        ctx.moveTo(strtX+stepsX,strtY-(oneStepsY*this.dataArr[i][1]));
        strtX += stepsX;
        //strtY -= oneStepsY*this.dataArr[i][1];
        console.log ("Y = "+ strtY + " and x = " + strtX);
    }
  }
}
