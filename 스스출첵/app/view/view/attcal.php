<div class="attcal">
</div>
<a href="/"><button class="lbtn">돌아가기</button></a>
<script>
    var today = new Date();
    var tyear = today.getFullYear();
    var tmonth = today.getMonth()+1;
    var tdate = today.getDate();
    
    function showcal(){
        var start_week = new Date(tmonth+' 1 '+tyear).getDay();
        var last_day = (new Date(tyear,tmonth,0)).getDate();
        $(".attcal").empty();
        var day = 1;
        var con = false;
        
        var html = '<table width="320" cellpadding="0" cellspacing="1" bgcolor="#999999">';
        html+='<tr>';
        html+='<td height="50" align="center" bgcolor="#FFFFFF" colspan="7">';
        html+='<p id="prevMonth" class="month">◀</p>';
        html+=tyear+'년 '+tmonth+'월';
        html+='<p id="nextMonth" class="month">▶</p></td>';
        html+='</tr>';
        html+='<tr>';
        html+='<td height="30" align="center" bgcolor="#DDDDDD">일</td>';
        html+='<td align="center" bgcolor="#DDDDDD">월</td>';
        html+='<td align="center" bgcolor="#DDDDDD">화</td>';
        html+='<td align="center" bgcolor="#DDDDDD">수</td>';
        html+='<td align="center" bgcolor="#DDDDDD">목</td>';
        html+='<td align="center" bgcolor="#DDDDDD">금</td>';
        html+='<td align="center" bgcolor="#DDDDDD">토</td>';
        html+='</tr>';
        
        for(var i=0;;i++){
            html+='<tr>';
            for(var j=0; j<7; j++){
                days = day-start_week;
                html+='<td height="30" align="center" bgcolor="#FFFFFF">';
                if(new Date(tmonth+' '+days+' '+tyear).getDay()==0)
                    html+="<span class='sunday'>";
                else if(new Date(tmonth+' '+days+' '+tyear).getDay()==6)
                    html+="<span class='satday'>";
                else
                    html+="<span>";
                if(days==tdate)
                    html+='<b>';
                html+="<a href='/view/view/attdetail?year="+tyear+"&month="+tmonth+"&day="+days+"'>";
                if(day<=last_day+start_week&&days>=1)
                    html+=days;
                html+="</a>";
                if(days==tdate)
                    html+='</b>';
                html+="</span>";
                html+='</td>';
                day++;
                if(day>last_day+start_week)
                    con = true;
            }
            if(con)
                break;
            html+='</tr>';
        }
        html+="</table>";
        $(".attcal").html(html);
            $("#prevMonth").click(function(){
            tmonth-=1;
            if(tmonth<1){
                tmonth = 12;
                tyear-=1;
            }
            showcal();
        });
        $("#nextMonth").click(function(){
            tmonth+=1;
            if(tmonth>12){
                tmonth = 1;
                tyear+=1;
            }
            showcal();
        });
    }
    showcal();
</script>