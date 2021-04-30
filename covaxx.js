<script src="jQueryui/jquery-ui.js"></script>
var gaugePS = new RadialGauge({
    renderTo: 'gauge-ps',
    width: 210,
    height: 210,
    units: '',
    minValue: 0,
    maxValue: 100,
    majorTicks: [
    ],
    minorTicks: 0,
    ticksAngle: 270,
    startAngle: 42,
    strokeTicks: true,
    highlights  : [
            {
                from: 0,
                to: 33.33,
                color: 'green'
            },
            {
                "from": 33.33,
                "to": 66.67,
                "color": 'yellow'
            },
            {
                "from": 66.67,
                "to": 100,
                "color": 'red'
            }
    ],
    valueInt: 1,
    valueDec: 0,
    colorPlate: "#fff",
    colorMajorTicks: "#686868",
    colorMinorTicks: "#686868",
    colorTitle: "#000",
    colorUnits: "#000",
    colorNumbers: "#686868",
    valueBox: false,
    colorValueText: "#000",
    colorValueBoxRect: "#FF8433",
    colorValueBoxRectEnd: "#FF8433",
    colorValueBoxBackground: "#FF8433",
    colorValueBoxShadow: false,
    colorValueTextShadow: false,
    colorNeedleShadowUp: true,
    colorNeedleShadowDown: true,
    colorNeedle: "#FA7777",
    colorNeedleEnd: "#FA7777",
    colorNeedleCircleOuter: "rgba(200, 200, 200, 1)",
    colorNeedleCircleOuterEnd: "rgba(200, 200, 200, 1)",
    borderShadowWidth: 8,
    borders: true,
    borderInnerWidth: 0,
    borderMiddleWidth: 0,
    borderOuterWidth: 0,
    colorBorderOuter: "#000000",
    colorBorderOuterEnd: "#000000",
    needleType: "arrow",
    needleWidth: 3,
    needleCircleSize: 8,
    needleCircleOuter: true,
    needleCircleInner: false,
    animationDuration: 1500,
    animationRule: "dequint",
    fontNumbers: "Verdana",
    fontTitle: "Verdana",
    fontUnits: "Verdana",
    fontValue: "Led",
    fontValueStyle: 'italic',
    fontNumbersSize: 0,
    fontNumbersStyle: 'italic',
    fontNumbersWeight: 'bold',
    fontTitleSize: 20,
    fontUnitsSize: 15,
    fontValueSize: 45,
    animatedValue: true
});
gaugePS.draw();
var states=["Alabama","Alaska","Arizona","Arkansas","California","Colorado","Connecticut","Delaware","Florida","Georgia","Hawaii","Idaho","Illinois","Indiana","Iowa","Kansas","Kentucky","Louisiana","Maine","Maryland","Massachusetts","Michigan","Minnesota","Mississippi","Missouri","Montana","Nebraska","Nevada","New Hampshire","New Jersey","New Mexico","New York","North Carolina","North Dakota","Ohio","Oklahoma","Oregon","Pennsylvania","Rhode Island","South Carolina","South Dakota","Tennessee","Texas","Utah","Vermont","Virginia","Washington","West Virginia","Wisconsin","Wyoming"];
$('#state1').autocomplete(
    {   
        source: states
    },
    {
        autoFocus: true,
        delay: 150,
        minLength: 2

});
function vci(){
    var a =document.getElementById('age1').value;
    var b = document.querySelector('input[name="gender"]:checked');
    var d = document.getElementById('state1').value;
    var h = d.toLowerCase();
    var nb = Number(a);
    var ger = Number.isInteger(nb);
    var statecheck=["california","texas","florida","pennsylvania","georgia","alaska","arizona","michigan","washington","hawaii","massachusetts","nevada","wisconsin","ohio","colorado","north carolina","indiana","illinois","montana","new jersey","virginia","oregon","new york","minnesota","alabama","delaware","maryland","maine","louisiana","missouri","utah","kentucky","tennessee","south carolina","connecticut","wyoming","iowa","nebraska","kansas","mississippi","new mexico","arkansas","idaho","north dakota","vermont","rhode island","south dakota","new hampshire","west virginia","oklahoma"];
    var n = statecheck.includes(h);
    var ag= document.getElementById('age1').value;
    if((a=="")||(b==null)||(d=="")||(ag<=0)||(!ger)){
        if((a=="")||(ag<=0)||(ag>109)||(!ger)){
            f.css("border","2px solid red");
        }
        else{
            f.css("border-color","blue");
        }
        if(d==""){
            g.css("border","2px solid red");
        }else if(!n){
            g.css("border","2px solid red");
        }else{
            g.css("border-color","blue");
        }
    }else if(!n){
        g.css("border","2px solid red");        
    }else{        
        g.css("border-color","blue");
        f.css("border-color","blue");
        var name= document.getElementById('state1').value;
        var dataString = name;
        var name2= document.getElementById('age1').value;
        var dataString2 = name2;
        var name3;
        if(document.getElementById('gridCheck').checked){
           name3 = "Yes";
        }else{
           name3 = "No";
        }
        if(document.getElementById('gender1').checked){
            var name4="Male";
        }else{
            var name4 = "Female";
        }
       
        $.ajax({
            type:"post",
            url: "sample.php",
            data: {dataString,dataString2,name3,name4},
            cache: false,
            success: function(html){
                var abc=JSON.parse(html);
                var status2 = abc[2];
                var vciindex = abc[0];
                var siindex = abc[1];
                if(vciindex==100){
                    document.getElementById('vpercent').innerHTML = 9;
                }else {
                    document.getElementById('vpercent').innerHTML = vciindex;
                }
                if(siindex==100){
                    document.getElementById('spercent').innerHTML = 9;
                }  
                   else{ document.getElementById('spercent').innerHTML = siindex;
                }
                document.getElementById('status1').innerHTML = status2;
               if(status2=="soon"){
                $('#dis1').removeClass("display1").addClass("display2");                    
                      if((vciindex<50)&&(siindex<50)){
                          gaugePS.value = 10;
                      }else if(((vciindex<50)&&(siindex>50))||((vciindex>50)&&(siindex<50))){
                          gaugePS.value = 20;
                      }else {
                          gaugePS.value = 32;
                      }                      
                }else if(status2=="sooner"){
                    $('#dis1').removeClass("display1").addClass("display3");                    
                    if((vciindex<50)&&(siindex<50)){
                          gaugePS.value = 43;
                      }else if(((vciindex<50)&&(siindex>50))||((vciindex>50)&&(siindex<50))){
                          gaugePS.value = 53;
                      }else {
                          gaugePS.value = 62;
                      }
                }else {
                    $('#dis1').removeClass("display1").addClass("display4");                    
                    if((vciindex<50)&&(siindex<50)){
                          gaugePS.value = 72;
                      }else if(((vciindex<50)&&(siindex>50))||((vciindex>50)&&(siindex<50))){
                          gaugePS.value = 84;
                      }else {
                          gaugePS.value = 94;
                      }
                }

            }
        });  
        document.getElementById('vciform').reset();
        $('#loading').removeClass("invisible").addClass("visible");
        $('#viform').removeClass('visible').addClass('invisible');
        setTimeout(function() {
         $('#loading').removeClass('visible').addClass('invisible');
        },1000);
        setTimeout(function() {
              $('#result').removeClass('invisible').addClass('visible');
        },1000);
        }

}
function home(){
    $('#result').removeClass('visible').addClass('invisible');
     $('#viform').removeClass('invisible').addClass('visible');
     $('#dis1').removeClass("display2").addClass("display1");                    
     $('#dis1').removeClass("display3").addClass("display1");                    
     $('#dis1').removeClass("display4").addClass("display1");                    
    }
